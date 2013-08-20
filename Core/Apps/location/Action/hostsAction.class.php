<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class hostsAction extends locationbaseAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'create',
	
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->area_mod = D ( 'area' );
		$this->user_mod = D ( 'user' );
	}
		
	public  function explore(){
		$this->error('该模块还在策划中开发中！');
		$this->display();
	}
	
	
}