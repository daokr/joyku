<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class spacebaseAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();		
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	protected  function _nav(){
		$arrNav = array ();
		$arrNav['index'] = array('name'=>'首页', 'url'=>C('ik_site_url'));
		if($this->visitor->info['userid'] > 0){
			$arrNav['update'] = array('name'=>'友邻广播', 'url'=>U('space/update/index'));
			$arrNav['mine'] = array('name'=>'我的空间', 'url'=>U('space/mine/index'));
		}
		$arrNav['explore'] = array('name'=>'浏览发现', 'url'=>U('space/explore/index'));
		$arrNav['neighborhood'] = array('name'=>'周边生活', 'url'=>U('space/neighborhood/index'));
		return $arrNav;
	}
	
}