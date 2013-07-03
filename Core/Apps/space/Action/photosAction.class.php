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
	}
	//相册首页
	public function index(){
		$userid = $this->_get('id','trim,intval');
		$userid > 0 && $username = $this->user_mod->field('username')->where(array('userid'=>$userid))->getField('username');
		if(!empty($username)){
			$title = $username.'的相册';
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
		//获取相册列表
		$arrAlbum = $this->album_mod->getAlbums(array('userid'=>$userid));
		
		$this->assign('arrAlbum',$arrAlbum);
		
		$this->_config_seo ( array (
				'title' => $title
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
					'title' => '创建新相册'
			) );
			$this->display('create');
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
						'title' => $title
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
		
		$this->assign('strAlbum',$strAlbum);
		$this->assign('user',$user);
		$this->_config_seo ( array (
				'title' => $user['username'].'的相册 - '.$strAlbum['albumname']
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
			$albumname = $this->album_mod->field('albumname')->where(array('albumid'=>$strPhoto['albumid']))->getField('albumname');
			$user = $this->user_mod->getOneUser($strPhoto['userid']);
			
			
			
			$this->assign('strPhoto',$strPhoto);
			if($this->userid == $strPhoto['userid']){
				$title = '我的相册 - '.$albumname;
			}else{
				$title = $user['username'].'的相册 - '.$albumname;
			}
			$this->_config_seo ( array (
					'title' => $title
			) );
			$this->display();
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
	}
	
	
}