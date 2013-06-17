<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'add',
				'delete',
				'edit',
				'publish',
				'addcomment',
				'recomment'.
				'delcomment',
				
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->mod = D ( 'article' );
		$this->cate_mod = D ( 'article_cate' );
		$this->item_mod = M ( 'article_item' );
		$this->channel_mod = D ( 'article_channel' );
		$this->comment_mod = D ( 'article_comment' );
		$this->user_mod = D ( 'user' );
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	
}