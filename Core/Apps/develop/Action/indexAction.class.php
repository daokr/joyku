<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 * 前端应用管理
 */
class indexAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'add',
				'ajax_upload',
				'add_upload',
				'ajax_del_file',
				'ajax_upload',
				'delcomment',
				'down',
				'editapp',
				'recomment',
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->user_mod = D ( 'user' );
		$this->images_mod = D('images');
		$this->dev_mod = D('develop');
		$this->dev_cate_mod = D('develop_cate');
		$this->dev_comments_mod = D('develop_comments');
		$this->deve_down_mod = M('develop_down');
		
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	protected  function _nav(){
		// 导航
		if($this->visitor->info['userid']){
			$arrNav['myapp'] = array('name'=>'我的应用', 'url'=>U('develop/index/userapp',array('id'=>$this->userid)));
		}
		$arrNav['applist'] = array('name'=>'发现应用', 'url'=>U('develop/index/applist'));
		return $arrNav;
	}
	
	public function add(){
		$userid = $this->userid;
		if(IS_POST){			
			if (false === $this->dev_mod->create ()) {
				$this->error ( $this->dev_mod->getError () );
			}
			// 保存当前数据对象
			$appid = $this->dev_mod->add ();
			if ($appid !== false) { // 保存成功
				$this->redirect('develop/index/add_upload',array('id'=>$appid));
			} else {
				// 失败提示
				$this->error ( '发布新应用失败!' );
			}
		}else{
			$cateList = $this->dev_cate_mod->getCateList();
			$this->assign('cateList',$cateList); //获取分类
			$this->assign('userid',$userid);
			$this->_config_seo (array('title'=>'发布新应用','subtitle'=>'应用商店'));
			$this->display();
		}
		
	}
	public function add_upload(){
		$appid = $this->_get('id','trim,intval','0');
		$userid = $this->userid;
		!empty($appid) && $strApp = $this->dev_mod->getOneApp(array('appid'=>$appid,'userid'=>$userid));
		if($strApp){
			if(IS_POST){
				$this->redirect('develop/index/preview',array('id'=>$appid));
			}else{
				$arrPhoto = D('images')->getImagesByMap(array('type'=>'screenshot','typeid'=>$appid,'userid'=>$userid));
				$this->assign('arrPhoto',$arrPhoto);
				$this->assign('strApp',$strApp);
				$this->_config_seo (array('title'=>'上传应用图片','subtitle'=>'应用商店'));
				$this->display('upload');
			}
		}else{
			$this->error ( '你无权执行该操作！' );
		}
	}
	// 我的应用
	public function userapp() {
		$userid = $this->_get('id','trim,intval');
		
		empty($userid) && $this->redirect('public/user/login');

		if($userid == $this->userid){
			//查询
			$map['userid'] = $userid; 
			$this->_config_seo (array('title'=>'我的应用','subtitle'=>'应用商店'));
			
		}else{
			//查询
			$map['userid'] = $userid; 
			$map['isaudit'] = 1;//通过审核
			
			$user = $this->user_mod->getOneUser($userid);
			if(empty($user['username'])){
				$this->redirect('develop/index/index');
			}
			$this->_config_seo (array('title'=>$user['username'].'发布的应用','subtitle'=>'应用商店'));
		}
		//显示列表
		$pagesize = 20;
		$count = $this->dev_mod->where($map)->order('addtime DESC')->count('appid');
		$pager = $this->_pager($count, $pagesize);
		$arrApps = $this->dev_mod->where($map)->order('addtime DESC')->limit($pager->firstRow.','.$pager->listRows)->select();
		if($arrApps){
			foreach($arrApps as $item){
				$arrApp[] = $this->dev_mod->getOneApp(array('appid'=>$item['appid']));
			}
		}
		$this->assign('pageUrl', $pager->fshow());
		
		$this->assign('count',$count);
		$this->assign('arrApp',$arrApp);
		$this->display('myapp');
	}
	public function index() {
		
		$this->_config_seo (array('title'=>'发布/管理应用','subtitle'=>'应用商店'));
		$this->display();
	}
	// 应用列表
	public function applist() {
		$apptype = $this->_get('type','trim,intval','0');
		$cateid = $this->_get('cateid','trim,intval','0');
		//类型
		$typeList = $this->dev_mod->getTypeList();
		
		if(!empty($apptype)){
			$map['apptype'] = $apptype; 
		}
		if(!empty($cateid)){
			$map['cateid'] = $cateid; 
		}
		//查询
		$map['isaudit'] = 1; //通过审核
		//显示列表
		$pagesize = 40;
		$count = $this->dev_mod->where($map)->order('addtime DESC')->count('appid');
		$pager = $this->_pager($count, $pagesize);
		$arrApps = $this->dev_mod->where($map)->order('addtime DESC')->limit($pager->firstRow.','.$pager->listRows)->select();
		if($arrApps){
			foreach($arrApps as $key=>$item){
				$arrApp[] = $this->dev_mod->getOneApp(array('appid'=>$item['appid']));
				$arrApp[$key]['cate'] = $this->dev_cate_mod->getOneCate($item['cateid']);
				$comment = $this->dev_comments_mod->getCommentByAppid($item['appid']);
				$islike =  M('develop_vote')->where(array('userid'=>$this->userid, 'appid'=>$item['appid']))->count('*');
				$arrApp[$key]['comment'] = $comment[0];
				$arrApp[$key]['digged'] = $islike > 0 ? 'digged' : '';
			}
		}
		$this->assign('pageUrl', $pager->fshow());
		
		//获取下载最多的；最流行的
		$arrpopApp = $this->dev_mod->getPopApp(10);
		//获取全部分类
		$cateList = $this->dev_cate_mod->getCateList();
				
		$this->assign('arrApp',$arrApp);
		$this->assign('apptype',$apptype);
		$this->assign('typeList',$typeList);
		$this->assign('cateList',$cateList);
		$this->assign('arrpopApp',$arrpopApp);
		$this->_config_seo (array('title'=>'发现感兴趣的应用','subtitle'=>'应用商店'));
		$this->display();		
	}	
	//编辑应用
	public function editapp(){
		$userid = $this->userid;
		$appid = $this->_get('id','trim,intval','0');
		if($appid>0){
			if(IS_POST){
				
				// 更新应用数据操作
				$map = array ();
				$map ['appid'] = $_GET['id'];
				unset ( $_GET['id'] );
				$this->dev_mod->where ( $map )->save ( $_POST );
				$this->redirect('develop/index/add_upload',array('id'=>$appid));
				
			}else{
				$strApp = $this->dev_mod->getOneApp(array('appid'=>$appid,'userid'=>$userid));
				$cateList = $this->dev_cate_mod->getCateList();
				$this->assign('cateList',$cateList); //获取分类
				$this->assign('strApp', $strApp);
				$this->assign('userid',$userid);
				$this->_config_seo (array('title'=>'编辑应用','subtitle'=>'应用商店'));
				$this->display();
			}
		}else{
			$this->error('您访问的应用不存在哦！');
		}
	}
	//审核
	public function preview(){
		$appid = $this->_get('id','trim,intval','0');
		$strApp = $this->dev_mod->getOneApp(array('appid'=>$appid));
		//判断是否是创建者
		if($strApp['userid'] != $this->userid){
			$this->error('你没有权限访问这个页面');
		}
		$this->assign('appid',$appid);
		$this->_config_seo (array('title'=>'成功发布应用','subtitle'=>'应用商店'));
		$this->display();
	}
	//显示
	public function show(){
		$user = $this->visitor->get ();
		$id = $this->_get ( 'id', 'intval');
		// 根据id获取内容
		!empty($id) && $strApp = $this->dev_mod->getOneApp ( array('appid'=>$id) );
		! $strApp && $this->error ( '呃...你想要的东西不在这儿' );
		
		// 下载过这个应用的人
		$downuserList = $this->dev_mod->getDownUser(array('appid'=>$id),'downtime desc',10);
		
		// 应用截图
		$strApp['screenshotList'] = D('images')->getImagesByMap(array('type'=>'screenshot','typeid'=>$id,'userid'=>$strApp['userid']));
		// 浏览量加 +1
		if($strApp ['userid']!=$user['userid']){
			$this->dev_mod->where(array('appid'=>$id))->setInc('count_view');
		}
		//获取评论
		$page = $this->_get('p','intval',1);
		$sc = $this->_get('sc','trim','asc');
		$isauthor = $this->_get('isauthor','trim','0');
		
		//查询条件 是否显示
		$map['appid'] = $strApp ['appid'];
		if($isauthor){
			$map['userid']  = $strApp ['userid'];
			$author = array('isauthor'=>0,'text'=>'查看所有回应');
		}else{
			$author = array('isauthor'=>1,'text'=>'只看楼主');
		}
		//显示列表
		$pagesize = 30;
		$count = $this->dev_comments_mod->where($map)->order('addtime '.$sc)->count('appid');
		$pager = $this->_pager($count, $pagesize);
		$arrComment =  $this->dev_comments_mod->where($map)->order('addtime '.$sc)->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrComment as $key=>$item){
			$commentList[] = $item;
			$commentList[$key]['user'] = $this->user_mod->getOneUser($item['userid']); 
			$commentList[$key]['content'] = h($item['content']);
			if($item['referid']>0){
				$recomment = $this->dev_comments_mod->recomment($item['referid']);
				$commentList[$key]['recomment'] = $recomment;
			}
		}
		$this->assign('pageUrl', $pager->fshow());
		$this->assign('commentList', $commentList);
		$this->assign ( 'sc', $sc );
		$this->assign ( 'author', $author );
		$this->assign ( 'isauthor', $isauthor );
		//评论list结束

		$this->assign ( 'strApp', $strApp );
		$this->assign ( 'page', $page );
		$this->assign('downuserList',$downuserList);
		$this->_config_seo ( array (
				'title' => $strApp ['title'],
				'subtitle' => '应用商店'
		) );
		$this->display ();
	}
	//ajax上传文件
	public function ajax_upload(){
		$userid = $this->_get('userid','intval','0');
		$appid = $this->_get('appid','intval','0');
		
		if(empty($appid) || empty($userid)){
			return;
		}
		
		$applogo = $_FILES ['applogo_file'];
		$screenshot = $_FILES ['screenshot_file'];
		$appfile = $_FILES ['appfile_file'];
		
		if(!empty($applogo['name'])){
			//传logo
			$result = savelocalfile($applogo,'develop/'.$appid.'/applogo',
					array('width'=>'64,100','height'=>'64,100'),
					array('jpg','jpeg','png','gif'),md5($appid));
			if (!$result ['error']) {
				$arrJson = array(
						'photo_url'=>  attach($result['img_100_100']),
						'photo_path'=> $result['img_100_100'],
				);
				$this->dev_mod->where(array('appid'=>$appid))->setField('applogo', $result['img_100_100']);
				echo json_encode($arrJson);
				return ;
			}else{
				$arrJson = array('r'=>0, 'html'=> $result ['error']);
				echo json_encode($arrJson);
				return ;
			}
						

		}elseif(!empty($screenshot['name'])){
			
			//判断是否已经大于6张图片了
			$countimg = D('images')->countImagesByMap(array('type'=>'screenshot','typeid'=>$appid,'userid'=>$userid));
			if($countimg>=6){
				$arrJson = array('r'=>0, 'html'=> '截图只能上传6张');
				echo json_encode($arrJson);
				return;
			}
			
			//传截图
			$result = savelocalfile($screenshot,'develop/'.$appid.'/screenshot',
					array (
							'width'=>C('ik_simg.width').','.C('ik_mimg.width').','.C('ik_bimg.width'),
							'height'=>C('ik_simg.height').','.C('ik_mimg.height').','.C('ik_bimg.height')
					),
					array('jpg','jpeg','png','gif'));
			if (!$result ['error']) {
				$name = $result ['filename'];
				$path = 'develop/'.$appid.'/screenshot/';
				$size = $result ['size'];
				$title = $result ['name'];
				$photoid = D('images')->addImage($name,$path,$size,$title,'screenshot',$appid,$userid);
				$arrPhoto = D('images')->getImageById($photoid);
				$arrJson = array(
						'photo_url'=> $arrPhoto['simg'],
						'delurl' => U('develop/index/ajax_del_file', array('id'=>$photoid)),
				);
				echo json_encode($arrJson);
				return ;
			}else{
				$arrJson = array('r'=>0, 'html'=> $result ['error']);
				echo json_encode($arrJson);
				return ;
			}
				
		}elseif(!empty($appfile['name'])){
			//安全性后缀检查
			//debug 传入参数
			$filename = strip_tags($appfile['name']);
			$tmpname = str_replace('\\', '\\\\', $appfile['tmp_name']);
			
			//debug 文件后缀
			$ext = fileext($filename);
			if(in_array($ext, array('zip','rar'))){
				$filesize = $appfile['size']/(1024*1024);
				if($filesize<=5){
					$dir = 'develop/'.$appid.'/appfile/';
					$result = $this->_upload($appfile, $dir);
					if ($result['error']) {
						$arrJson = array('r'=>0, 'html'=> $result['info']);	
					}else{
						
						$arrJson = array(
								'savename'=>$appfile['name'],
								'filesize'=> intval($appfile['size']/1024),
						);
						$this->dev_mod->where(array('appid'=>$appid))->setField('appfile', $dir.$result['info'][0]['savename']);
					}
					
				}else{
					$arrJson = array('r'=>0, 'html'=> '附件已经超过5M了；请重新压缩！' );
				}
			}else{
				$arrJson = array('r'=>0, 'html'=> '请上传rar或者zip压缩包上传！');	
			}
			echo json_encode($arrJson);
			return;
		}else{
			$arrJson = array('r'=>0, 'html'=> '请选择图片再上传！');
			echo json_encode($arrJson);
			return;
		}
		
	}	
	public function ajax_del_file(){
		$id = $this->_get('id');
		$userid = $this->userid;
		if(!empty($id) && $userid>0){
			$isdel = D('images')->delImage($id);
			$isdel && $arrJson = array('r'=>1, 'html'=> '删除成功！');
			echo json_encode($arrJson); 
		}
	}
	
	// 添加评论
	public function addcomment(){
		$appid	= $this->_post('appid','intval');
		$content	= $this->_post('content','trim');
		$page	= $this->_post('p','intval','1');
		if(empty($content)){
			
			$this->error('没有任何内容是不允许你通过滴^_^');
				
		}elseif(mb_strlen($content,'utf8')>10000){
				
			$this->error('发这么多内容干啥,最多只能写10000千个字^_^,回去重写哇！');
				
		}else{ 
			//执行添加
			$data = array(
					'appid'	=> $appid,
					'userid'	=> $this->userid,
					'content'	=> ikwords($content),
					'addtime'	=> time(),
			);
			if (false !== $this->dev_comments_mod->create ( $data )) {
				$commentid = $this->dev_comments_mod->add ();
				$this->redirect ( 'develop/index/show', array (
						'id' => $appid,
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
				'appid'	=> $objid,
				'userid'	=> $this->userid,
				'referid'	=> $referid,
				'content'	=> ikwords($content), // ajax 提交过来数据的转一下
				'addtime'	=> time(),
		);
		if (false !== $this->dev_comments_mod->create ( $data )) {
			$commentid = $this->dev_comments_mod->add ();
			echo 0;
		}
	}
	// 删除某条评论
	public function delcomment(){
		$commentid = $this->_get('commentid','intval');
		$userid = $this->userid;
		$strComment = $this->dev_comments_mod->where(array('commentid'=>$commentid))->find();
		$strApp = $this->dev_mod->getOneApp(array('appid'=>$strComment['appid']));
				
		// 只有应用发布人 可以删除 其他权限不允许删除
		if($strApp['userid']==$userid || $strComment['userid']==$userid){
			$this->dev_comments_mod->delComment($commentid);
			$this->redirect ( 'develop/index/show', array (
					'id' => $strComment['appid'],
			) );			
		}

	}
	// 下载
	public function down(){
		$userid = $this->userid;
		$appid = $this->_get('id');
		// 根据id获取内容
		!empty($appid) && $strApp = $this->dev_mod->getOneApp ( array('appid'=>$appid) );
		! $strApp && $this->error ( '呃...你想要的东西不在这儿' );
		// 判断积分是否大于指定规则
		
		$data = array(
					'userid'=>$userid,
					'appid' =>$appid,
					'downtime'=>time(),
				);
		//防止重复下载
		$isdown = $this->deve_down_mod->where(array('userid'=>$userid,'appid' =>$appid))->find();
		if(empty($isdown)){
			if(!false == $this->deve_down_mod->create($data)){
				$this->deve_down_mod->add();
			}			
		}else{
			$this->deve_down_mod->where(array('userid'=>$userid,'appid' =>$appid))->setField('downtime',time());
		}
		//下载+1
		$this->dev_mod->where(array('appid'=>$appid))->setInc('count_down');
		header('Location: '.attach($strApp['appfile']));
	}
	
	// 投票
	public function vote(){
		$userid = $this->userid;
		$appid = $this->_get('id');
		if(!empty($appid) && $userid>0){
			
			$arrJson = $this->dev_mod->appVote ( $userid, $appid );
			header ( "Content-Type: application/json", true );
			echo json_encode ( $arrJson );
			
		}else{
			echo 3;
		}
		exit();
	}

		
	
}