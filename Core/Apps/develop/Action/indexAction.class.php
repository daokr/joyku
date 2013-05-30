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
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->user_mod = D ( 'user' );
		$this->images_mod = D('images');
		$this->dev_mod = D('develop');
	}
	public function add(){
		$userid = $this->userid;
		if(IS_POST){
			
			if (false === $this->dev_mod->create ()) {
				$this->error ( $this->dev_mod->getError () );
			}
			// 保存当前数据对象
			$list = $this->dev_mod->add ();
			if ($list !== false) { // 保存成功
				$this->success ( '新增成功!');
			} else {
				// 失败提示
				$this->error ( '新增失败!' );
			}
		}else{
			//查看该用户的图片
			$arrImages = $this->images_mod->getImagesByMap(array('type'=>'appscreen','typeid'=>0,'userid'=>$userid),
					'addtime asc');
			if(!empty($arrImages)){
				$this->assign('arrPhotos', $arrImages);
			}
			$this->_config_seo (array('title'=>'发布新应用','subtitle'=>'应用商店'));
			$this->display();
		}
		
	}
	public function index() {
		
		$this->_config_seo (array('title'=>'发布/管理应用','subtitle'=>'应用商店'));
		$this->display();
	}		
		
	
}