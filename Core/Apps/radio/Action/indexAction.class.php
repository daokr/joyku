<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends frontendAction {
	protected  function _nav(){
		$arrNav = array ();
		$arrNav['index'] = array('name'=>'首页', 'url'=>C('ik_site_url'));
		$arrNav['group'] = array('name'=>'小组', 'url'=>U('group/index/index'));
		$arrNav['radio'] = array('name'=>'电台', 'url'=>U('radio/index/index'));
		return $arrNav;
	}
	public function index() {
		
		$type = (isset($_GET['id'])) ? abs(intval($_GET ['id'])) :(($_COOKIE['radio_type'])?$_COOKIE['radio_type']:0);
		$result = include APPS_PATH.'/radio/type.php';
		$openArray= array();
		foreach ($result as $k=>$v){
			($v['isopen'] == 1) ? $openArray[$k] = $v : "";
		}
		$arrAllType = $result = $openArray;
		if(empty($result[$type])){
			$type = array_rand($result);
		}
		$curType = $result[$type];
		if(isset($_GET['id']))	setcookie('radio_type',$type,time()+60*60*24*30);
		$title = (empty ( $curType )) ? '电台' : $curType ['title'];

		$this->assign('arrAllType',$arrAllType);
		$this->assign('curType',$curType);
				
		$this->_config_seo ( array (
				'title' => $title,
				'subtitle' => '爱客电台' 
		) );
		$this->display ();
	}
}