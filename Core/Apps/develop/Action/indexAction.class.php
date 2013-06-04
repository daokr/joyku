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
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->user_mod = D ( 'user' );
		$this->images_mod = D('images');
		$this->dev_mod = D('develop');
		
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	protected  function _nav(){
		// 导航
		if($this->visitor->info['userid']){
			$arrNav['myapp'] = array('name'=>'我的应用', 'url'=>U('develop/index/myapp'));
		}
		$arrNav['applist'] = array('name'=>'发现应用', 'url'=>U('develop/index/applist'));
		return $arrNav;
	}
	
	public function add(){
		$userid = $this->userid;
		if(IS_POST){
			$applogo = $_FILES ['applogo'];
			$appfile = $_FILES ['appfile'];
			
			empty($applogo['name']) && $this->error('请上传logo图片');
			empty($appfile['name']) && $this->error('请上传附件包');
			
			if (false === $this->dev_mod->create ()) {
				$this->error ( $this->dev_mod->getError () );
			}
			// 保存当前数据对象
			$appid = $this->dev_mod->add ();
			if ($appid !== false) { // 保存成功
				//执行更新图片
				$this->images_mod->updateImage(array('typeid'=>$appid),array('typeid'=>0,'type'=>'appscreen','userid'=>$userid));
				
				//传logo
				$result = savelocalfile($applogo,'develop/apps',
						array('width'=>'48,100','height'=>'48,100'),
						array('jpg','jpeg','png','gif'),
						md5($appid));
				if (!$result ['error']) {
					$data ['applogo'] = $result['img_100_100'];
					//更新
					$this->dev_mod->where ( 'appid=' . $appid )->setField ( 'applogo', $data ['applogo'] );
				}else{
					$this->error($result['info'],U('develop/index/add',array('id'=>$appid)));
				}
				//传附件
				$dir = date('ym/d/');
				$rarresult = $this->_upload($_FILES['appfile'], 'develop/appsrar/'. $dir);
				if ($rarresult['error']) {
					$this->error($rarresult['info'],U('develop/index/add',array('id'=>$appid)));
				} else {
					$savename = 'develop/appsrar/'.$dir . $rarresult['info'][0]['savename'];
					//更新
					$this->dev_mod->where ( 'appid=' . $appid )->setField ( 'appfile', $savename );
				}
				
				$this->success ( '恭喜您，发布成功了；请等待管理员审核!', U('develop/index/myapp'));
			} else {
				// 失败提示
				$this->error ( '发布新应用失败!' );
			}
		}else{
			$appid = $this->_get('id','trim,intval','0');

			//查看该用户的图片
			$arrImages = $this->images_mod->getImagesByMap(array('type'=>'appscreen','typeid'=>$appid,'userid'=>$userid),
					'addtime asc');
			if(!empty($arrImages)){
				$this->assign('arrPhotos', $arrImages);
			}
			$this->assign('appid',$appid);
			$this->assign('userid',$userid);
			$this->_config_seo (array('title'=>'发布新应用','subtitle'=>'应用商店'));
			$this->display();
		}
		
	}
	// 我的应用
	public function myapp() {
		$userid = $this->userid;
		
		//获取我发布的应用
		$arrApp = $this->dev_mod->getAppByMap(array('userid'=>$userid),'addtime desc');
		$this->assign('arrApp',$arrApp);
		
		$this->_config_seo (array('title'=>'我的应用','subtitle'=>'应用商店'));
		$this->display();
	}
	public function index() {
		
		$this->_config_seo (array('title'=>'发布/管理应用','subtitle'=>'应用商店'));
		$this->display();
	}
	// 应用列表
	public function applist() {
		$this->_config_seo (array('title'=>'发现感兴趣的移动应用','subtitle'=>'应用商店'));
		$this->display();		
	}	
	//编辑应用
	public function editapp(){
		$userid = $this->userid;
		$appid = $this->_get('id','trim,intval','0');
		if($appid>0){
			$strApp = $this->dev_mod->getOneApp(array('appid'=>$appid,'userid'=>$userid));
			$this->assign('strApp', $strApp);
		}else{
			$this->error('您访问的应用不存在哦！');
		}
			
		//查看该用户的图片
		$arrImages = $this->images_mod->getImagesByMap(array('type'=>'appscreen','typeid'=>$appid,'userid'=>$userid),'addtime asc');
		if(!empty($arrImages)){
			$this->assign('arrPhotos', $arrImages);
		}
		$this->assign('appid',$appid);
		$this->assign('userid',$userid);
		$this->_config_seo (array('title'=>'编辑应用','subtitle'=>'应用商店'));	
		$this->display();
	}
	//显示
	public function show(){
		$user = $this->visitor->get ();
		$id = $this->_get ( 'id', 'intval');
		// 根据id获取内容
		!empty($id) && $strApp = $this->dev_mod->getOneApp ( array('appid'=>$id) );
		! $strApp && $this->error ( '呃...你想要的东西不在这儿' );
		
		// 浏览量加 +1
		if($strApp ['userid']!=$user['userid']){
			$this->dev_mod->where(array('appid'=>$id))->setInc('count_view');
		}

		$this->assign ( 'strApp', $strApp );

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
		
		$applogo = $_FILES ['applogo_file'];
		$screenshot = $_FILES ['screenshot_file'];
		$appfile = $_FILES ['appfile_file'];
		
		if(!empty($applogo['name'])){
			//传logo
			$result = savelocalfile($applogo,'develop/'.$userid.'/applogo',
					array('width'=>'48,100','height'=>'48,100'),
					array('jpg','jpeg','png','gif'),
					md5($appid));
			if (!$result ['error']) {
				$arrJson = array(
						'small_photo_url'=>  attach($result['img_100_100']),
						'small_photo_path'=> $result['img_100_100'],
						'delurl' => U('develop/index/ajax_del_file'),
				);
				echo json_encode($arrJson);
				return ;
			}else{
				$arrJson = array('r'=>0, 'html'=> $result ['error']);
				echo json_encode($arrJson);
				return ;
			}
						

		}elseif(!empty($screenshot['name'])){
			$arrJson = array('r'=>1, 'html'=> '请选择图片再上传！');
			echo json_encode($arrJson);
			return ;
		}else{
			$arrJson = array('r'=>0, 'html'=> '请选择图片再上传！');
			echo json_encode($arrJson);
			return;
		}
		
	}	
		
	
}