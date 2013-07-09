<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class photosAction extends spacebaseAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'info',
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		//应用所需 mod
		$this->user_mod = D('user');
		$this->album_mod = D('user_photo_album');
		$this->photo_mod = D('user_photo');
		$this->comment_mod = D('user_photo_comment');
	}
	//相册首页
	public function index(){
		$userid = $this->_get('id','trim,intval');
		$userid > 0 && $user = $this->user_mod->getOneUser($userid);
		if(!empty($user)){
			$title = $user['username'].'的相册';
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
		//获取相册列表
		$arrAlbum = $this->album_mod->getAlbums(array('userid'=>$userid));
		//获取最新评论
		$arrNewComment = $this->comment_mod->getNewComment($userid,8);
		$this->assign('arrNewComment',$arrNewComment);
		
		$this->assign('arrAlbum',$arrAlbum);
		$this->assign('user',$user);
		
		
		$this->_config_seo ( array (
				'title' => $title,
				'subtitle'=> '_相册_'.C('ik_site_title'),
				'keywords' => '网络相册,免费相册,相片,照片,相册',
				'description'=> '分享生活中的照片，爱客相册，留住青春，珍藏您一生的记忆！',
		) );		
		$this->display();
	}
	//相册
	public function album(){
		$type = $this->_get ( 'd', 'trim' );

		if(empty($type)){
			//相册显示页面
			$albumid = $this->_get ( 'id', 'trim,intval','0');
			$strAlbum = $this->album_mod->getOneAlbum($albumid);
			if($strAlbum){
				$this->albumList($albumid);
			}else{
				$this->error('呃...你想访问的相册不存在');
			}
		}else{
			switch ($type) {
				case "create" :
					$this->create();
					break;
				case "upload" :
					$this->uploadPhoto();
					break;
				case "ajaxupload" :
					$this->ajaxupload();
					break;	
				case "info" :
					$this->info();
					break;
				case "edit" :
					$this->editalbum();
					break;	
				default:
					$this->error('呃...你想访问的页面不存在');
			}			
		}
	}
	//创建相册
	public function create(){
		if(! $this->visitor->is_login ) $this->redirect ( 'public/user/login' );
		if(IS_POST){
			$data['userid'] = $this->userid;
			$data['albumname'] = $this->_post('albumname','trim','');
			$data['albumdesc'] = $this->_post('albumdesc','trim','');
			$data['orderid'] = $this->_post('orderid','trim','');
			$data['privacy'] = $this->_post('privacy','intval','');
			$data['isreply'] = $this->_post('isreply','trim','1'); // 1表示允许回复
			//录入检查
			if( mb_strlen($data ['albumname'],'utf8')>20)
			{
				$this->error ('相册名太长啦，最多20个字...^_^！');
				
			}else if( mb_strlen($data ['albumdesc'],'utf8')>120){
				
				$this->error ('相册描述太多了，最多120个字...^_^！');
			}
			
			//开始创建
			if (false === $this->album_mod->create ($data)) {
				$this->error ( $this->album_mod->getError () );
			}
			// 保存当前数据对象
			$albumid = $this->album_mod->add ();
			if ($albumid !== false) { // 保存成功
				$this->redirect('space/photos/album',array('d'=>'upload','id'=>$albumid));
			} else {
				// 失败提示
				$this->error ( '创建相册失败!' );
			}
			
		}else{

			$this->_config_seo ( array (
				'title' => '创建新相册',
				'subtitle'=> '相册_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
			) );
			$this->display('create');
		}	
	}
	public function editalbum(){
		$albumid = $this->_get('id','trim,intval');
		$strAlbum = $this->album_mod->getOneAlbum($albumid);
		if($strAlbum['userid']==$this->userid){
			if(IS_POST){
				
				$data['albumname'] = $this->_post('albumname','trim','');
				$data['albumdesc'] = $this->_post('albumdesc','trim','');
				$data['orderid'] = $this->_post('orderid','trim','');
				$data['privacy'] = $this->_post('privacy','intval','');
				$data['isreply'] = $this->_post('isreply','trim','1'); // 1表示允许回复
				//录入检查
				if( mb_strlen($data ['albumname'],'utf8')>20)
				{
					$this->error ('相册名太长啦，最多20个字...^_^！');
				
				}else if( mb_strlen($data ['albumdesc'],'utf8')>120){
				
					$this->error ('相册描述太多了，最多120个字...^_^！');
				}
				
				//开始保存
				if (false === $this->album_mod->where(array('albumid'=>$albumid))->save($data)) {
					$this->error ( $this->album_mod->getError () );
				}else{
					$this->redirect('space/photos/album',array('id'=>$albumid));
				}
				
			}else{
				$this->_config_seo ( array (
						'title' => '修改相册属性 - '.$strAlbum['albumname'],
						'subtitle'=> '相册_'.C('ik_site_title'),
						'keywords' => '',
						'description'=> '',
				) );
				$this->assign('strAlbum',$strAlbum);
				$this->display('editalbum');
			}
			
		}else{
			$this->error('你没有权限更新！');
		}
	}
	//上传照片
	public function uploadPhoto(){
		if(! $this->visitor->is_login ) $this->redirect ( 'public/user/login' );
		$albumid = $this->_get('id','trim,intval');
		$type = $this->_get('type','trim','');
		if(!empty($albumid)){
			//获取相册信息
			$strAlbum = $this->album_mod->getOneAlbum($albumid);
			if($strAlbum['userid']==$this->userid){
				
				if(IS_POST){
					$smalltime = $this->_get('t','trim');
					//上传
					$arrUpload = $this->photo_mod->addPhoto($_FILES['picfile'],$this->userid,$albumid);
					
					if($arrUpload){
					
						$arrData = array(
								'userid'	=> $this->userid,
								'albumid'	=> $albumid,
								'photopath' => $arrUpload['path'],
								'photoname' => $arrUpload['filename']
						);

						if(!false == $this->photo_mod->create ($arrData)){
							$photoid = $this->photo_mod->add();
							$this->redirect('space/photos/album',array('d'=>'info','id'=>$albumid,'t'=>$smalltime));
						}
					}
					
				}else{
					$this->assign('type',$type);
					$this->assign('smalltime',time());
					$this->assign('strAlbum',$strAlbum);
					$this->_config_seo ( array (
							'title' => '上传照片 - '.$strAlbum['albumname']
					) );
					
					$this->_config_seo ( array (
						'title' => '上传照片 - '.$strAlbum['albumname'],
						'subtitle'=> '相册_'.C('ik_site_title'),
						'keywords' => '',
						'description'=> '',
					) );
					$this->display('upload');
				}
				
			}else{
				$this->error('你没有权限更新照片！');
			}
		}
	}
	//ajax上传照片
	public function ajaxupload(){
		if(IS_POST){
			$userid = $this->_post('userid','intval');
			if(empty($userid)) exit;
			
			$albumid = $this->_post('albumid','intval');
			
			//上传
			$arrUpload = $this->photo_mod->addPhoto($_FILES['Filedata'],$userid,$albumid);
			if($arrUpload){
				
				$arrData = array(
						'userid'	=> $userid,
						'albumid'	=> $albumid,
						'photopath' => $arrUpload['filepath'],
						'photoname' => $arrUpload['filename']
				);
				
				if(!false === $this->photo_mod->create ($arrData)){
					$photoid = $this->photo_mod->add();
				}	
			}
			
		}else{
			$this->error('非法操作');
		}
	}
	//上传完成
	public function info(){
		$albumid = $this->_get('id','intval');
		$userid = $this->userid;
		
		!empty($albumid) && $strAlbum = $this->album_mod->getOneAlbum($albumid);
		
		if($strAlbum && $strAlbum['userid'] == $userid){
			if(IS_POST){
				$pid = $this->_post('albumface','trim,intval','0');
				$arrphotoid = $this->_post('photoid');
				$arrphotodesc = $this->_post('photodesc');

				
				foreach($arrphotodesc as $key => $item){
					if($item){
						$photoid = $arrphotoid[$key];
						$this->photo_mod->where(array('photoid'=>$photoid))->setField('photodesc',h($item));
					}	
				}
				
				if($pid>0){
					$albumface = $this->photo_mod->getOnePhoto($pid);
					
					$this->album_mod->where(array('albumid'=>$albumid))->setField(array('path'=>$albumface['photopath'],'albumface'=>$albumface['photoname']));
				}
				$this->redirect('space/photos/album',array('id'=>$albumid));
				
			}else{
				$smalltime = $this->_get('t','trim');
				if(!empty($smalltime)){
					$map['addtime'] = array('gt',$smalltime);
					$map['userid'] = $userid;
					$map['albumid'] = $albumid;
					$arrPhoto = $this->photo_mod->getPhotos($map);
					empty($arrPhoto) && $this->error('呃...你想访问的页面不存在');
					$title = '完成上传！添加描述 - '.$strAlbum['albumname'];
				}else{
					$arrPhoto = $this->photo_mod->getPhotos(array('userid'=>$userid,'albumid'=>$albumid));
					$title = '批量修改 - '.$strAlbum['albumname'];
				}
				$this->assign('strAlbum',$strAlbum);
				$this->assign('arrPhoto',$arrPhoto);
				
				$this->_config_seo ( array (
						'title' => $title,
						'subtitle'=> '相册_'.C('ik_site_title'),
						'keywords' => '',
						'description'=> '',
				) );
				$this->display('complete');
			}
		}else{
			$this->error('呃...你无权访问此页面');
		}
	}
	//相册显示
	public function albumList($albumid){
		$strAlbum = $this->album_mod->getOneAlbum($albumid);
		$user = $this->user_mod->getOneUser($strAlbum['userid']);
		
		$page_max = 100; //发现页面最多显示页数
		$where = array('albumid'=>$albumid);
		$this->waterfall($where, 'photoid DESC', $page_max);
		
		//获取最新评论
		$arrNewComment = $this->comment_mod->getNewComment($strAlbum['userid'],8);
		$this->assign('arrNewComment',$arrNewComment);
		
		$this->assign('strAlbum',$strAlbum);
		$this->assign('user',$user);

		$this->_config_seo ( array (
				'title' => $user['username'].'的相册',
				'subtitle'=> $strAlbum['albumname'].'_相册_'.C('ik_site_title'),
				'keywords' => ikscws($strAlbum['albumname']),
				'description'=> $strAlbum['albumdesc'],
		) );
		$this->display('album');
	}
	public function index_ajax() {
		$albumid = $this->_get('albumid','intval');
		$where = array('albumid'=>$albumid);
		$this->wall_ajax($where);
	}
	//照片显示
	public function show(){
		$pid = $this->_get('id','trim,intval');
		!empty($pid) && $strPhoto = $this->photo_mod->getOnePhoto($pid);
		if($strPhoto){
			$strAlbum = $this->album_mod->field('albumname,orderid')->where(array('albumid'=>$strPhoto['albumid']))->find();
			$order = 'addtime '.$strAlbum['orderid'];
			$arrPhotoIds = $this->photo_mod->field('photoid')->where(array('albumid'=>$strPhoto['albumid']))->order($order)->select();
			
			foreach($arrPhotoIds as $item){
				$arrPhotoId[] = $item['photoid'];
			}
			rsort($arrPhotoId);
			$nowkey = array_search($pid,$arrPhotoId);
			$nowPage =  $nowkey+1 ;
			$countPage = count($arrPhotoId);
			$prev = $arrPhotoId[$nowkey - 1];
			$next = $arrPhotoId[$nowkey +1];

			$strPhoto['nexturl'] = U('space/photos/show',array('id'=>$next));
			$strPhoto['prevturl'] = U('space/photos/show',array('id'=>$prev));
			$strPhoto['nowPage'] = $nowPage;
			$strPhoto['countPage'] = $countPage;
			
			$user = $this->user_mod->getOneUser($strPhoto['userid']);
			
			//获取评论
			$page = $this->_get('p','intval',1);
			$sc = $this->_get('sc','trim','asc');
			$isauthor = $this->_get('isauthor','trim','0');
			
			//查询条件 是否显示
			$map['photoid'] = $strPhoto ['photoid'];
			if($isauthor){
				$map['userid']  = $strPhoto ['userid'];
				$author = array('isauthor'=>0,'text'=>'查看所有回应');
			}else{
				$author = array('isauthor'=>1,'text'=>'只看楼主');
			}
			//显示列表
			$pagesize = 30;
			$count = $this->comment_mod->where($map)->order('addtime '.$sc)->count();
			$pager = $this->_pager($count, $pagesize);
			$arrComment =  $this->comment_mod->where($map)->order('addtime '.$sc)->limit($pager->firstRow.','.$pager->listRows)->select();
			foreach($arrComment as $key=>$item){
				$commentList[] = $item;
				$commentList[$key]['user'] = $this->user_mod->getOneUser($item['userid']);
				$commentList[$key]['content'] = h($item['content']);
				if($item['referid']>0){
					$recomment = $this->comment_mod->recomment($item['referid']);
					$commentList[$key]['recomment'] = $recomment;
				}
			}
			$this->assign('pageUrl', $pager->fshow());
			$this->assign('page', $page);
			$this->assign('commentList', $commentList);
			$this->assign ( 'sc', $sc );
			$this->assign ( 'author', $author );
			$this->assign ( 'isauthor', $isauthor );
			//评论list结束					
			
			//我的相册
			$map['privacy'] = 1; //公开
			$map['userid'] = $user['userid'];
			$arrAlbum = $this->album_mod->getAlbums($map,'uptime desc',4);
			$this->assign('arrAlbum',$arrAlbum);
			
			
			$this->assign('strPhoto',$strPhoto);
			if($this->userid == $strPhoto['userid']){
				$title = '我的相册 - '.$strAlbum['albumname'];
			}else{
				//浏览量+1
				$this->photo_mod->where(array('photoid'=>$pid))->setInc('count_view',1);
				$title = $user['username'].'的相册 - '.$strAlbum['albumname'];
			}
			$this->_config_seo ( array (
					'title' => $title,
					'subtitle'=> '_相册_'.C('ik_site_title'),
					'keywords' => ikscws($strAlbum['albumname']),
					'description'=> $strPhoto['photodesc'],
			) );
			$this->display();
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
	}
	
	//编辑照片描述
	public function editphoto(){
		$pid = $this->_post('photoid','intval');
		$pinfo = $this->_post('photodesc','trim,t');
		$userid = $this->userid;
		!empty($pid) && $strPhoto = $this->photo_mod->getOnePhoto($pid);
		if($userid>0 || $strPhoto['userid'] ==$userid){
			$this->photo_mod->where(array('photoid'=>$pid))->setField('photodesc', $pinfo);
			$this->ajaxReturn(array('r'=>1,'html'=>$pinfo));
		}else{
			$this->ajaxReturn(array('r'=>0,'error'=>'无权更新'));
		}
	}
	//删除照片
	public function delphoto(){
		$pid = $this->_get('id','trim,intval');
		$userid = $this->userid;
		!empty($pid) && $strPhoto = $this->photo_mod->getOnePhoto($pid);
		if($userid>0 || $strPhoto['userid'] ==$userid){
			if(!false == $this->photo_mod->delPhoto($pid)){
				$this->redirect('space/photos/album',array('id'=>$strPhoto['albumid']));
			}else{
				$this->error($this->photo_mod->getError());
			}
			
		}else{
			$this->error('你没有删除权限');
		}
	}
	//添加评论
	public function addcomment(){
		$photoid	= $this->_post('photoid','intval');
		$content	= $this->_post('content','trim');
		$page	= $this->_post('p','intval','1');
		if(empty($content)){
			
			$this->error('没有任何内容是不允许你通过滴^_^');
				
		}elseif(mb_strlen($content,'utf8')>10000){
				
			$this->error('发这么多内容干啥,最多只能写10000千个字^_^,回去重写哇！');
				
		}else{ 
			//执行添加
			$data = array(
					'photoid'	=> $photoid,
					'userid'	=> $this->userid,
					'content'	=> ikwords($content),
					'addtime'	=> time(),
			);
			if (false !== $this->comment_mod->create ( $data )) {
				$commentid = $this->comment_mod->add ();
				$this->redirect ( 'space/photos/show', array (
						'id' => $photoid,
						'p'  => $page,
				) );
			}
		}
		
	}
	
	// 回复评论
	public function recomment(){
		$objid = $this->_post('objid');
		$referid = $this->_post('referid');
		$content = $this->_post('content');		
		//安全性检查
		if( mb_strlen($content, 'utf8') > 10000)
		{
			echo 1;
			exit ();
		}
		//执行添加
		$data = array(
				'photoid'	=> $objid,
				'userid'	=> $this->userid,
				'referid'	=> $referid,
				'content'	=> ikwords($content), // ajax 提交过来数据的转一下
				'addtime'	=> time(),
		);
		if (false !== $this->comment_mod->create ( $data )) {
			$commentid = $this->comment_mod->add ();
			echo 0;
		}
	}
	// 删除某条评论
	public function delcomment(){
		$commentid = $this->_get('commentid','intval');
		$userid = $this->userid;
		$strComment = $this->comment_mod->where(array('commentid'=>$commentid))->find();
		$strPhoto = $this->photo_mod->getOnePhoto(array('photoid'=>$strComment['photoid']));
				
		// 只有应用发布人 可以删除 其他权限不允许删除
		if($strPhoto['userid']==$userid || $strComment['userid']==$userid){
			$this->comment_mod->delComment($commentid);
			$this->redirect ( 'space/photos/show', array (
					'id' => $strComment['photoid'],
			) );			
		}else{
			$this->error('你没有删除权限或找不到要访问的页面');
		}

	}
	
}