<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class notesAction extends spacebaseAction {
	public function _initialize() {
		parent::_initialize ();
		
		//应用所需 mod
		$this->user_mod = D('user');
	}
	//日记首页
	public function index(){
		$userid = $this->_get('id','trim,intval');
		$userid > 0 && $user = $this->user_mod->getOneUser($userid);
		if(!empty($user)){
			$title = $user['username'].'的日记';
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
		
		$this->_config_seo ( array (
				'title' => $title,
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => '网络日记,记事本,日记,日志,相册',
				'description'=> '把生活中的点点滴滴都记录下来吧；分享生活中有意义的事情，留住青春，珍藏您一生的记忆！',
		) );		
		$this->display();
	}
	//新加日记
	public function create(){
		
		$this->_config_seo ( array (
				'title' => '新加日记',
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display();
	}
	
	
}