<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com 单独调整url 个人空间
 */
class mineAction extends spacebaseAction {
	public function _initialize() {
		parent::_initialize ();
		$this->user_mod = D ( 'user' );
	}
	public function index() {
		$userid = $this->visitor->info ['userid'];
		if($userid>0){
			$doname = $this->user_mod->where ( array (
					'userid' => $userid 
			) )->getField ( 'doname' );
			$this->redirect('space/index/index',array('id'=>$doname));
		}else{
			$this->redirect('public/user/login');
		}
	}
}