<?php
/*
 * IKPHP爱客网 爱客商城 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'create',
		) )) {
			$this->redirect ( 'user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->user_mod = D ( 'user' );
		
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	protected  function _nav(){
		// 导航
		if($this->visitor->info['userid']){
			$arrNav['mine'] = array('name'=>'我的淘客', 'url'=>U('mall/index/mine'));
		}
		$arrNav['explore_goods'] = array('name'=>'发现宝贝', 'url'=>U('mall/index/explore_goods'));
		$arrNav['explore_album'] = array('name'=>'发现专辑', 'url'=>U('mall/index/explore_album'));
		$arrNav['share'] = array('name'=>'分享宝贝', 'url'=>U('mall/item/fetch_item'));
		return $arrNav;
	}
	public function index() {
		$userid = $this->userid;
		if($userid>0){
			$this->redirect('mall/index/mine');
		}else{
			$this->redirect('mall/index/explore_goods');
		}
	}		
	public function mine() {
		
		$this->_config_seo (array('title'=>'小猫女的淘客','subtitle'=>'爱客商城'));
		$this->display();
	}
	
	public function explore_goods() {

		
		$this->_config_seo (array('title'=>'发现宝贝','subtitle'=>'爱客商城'));
		$this->display();
	}	
	public function explore_album() {
	
		
		$this->_config_seo (array('title'=>'发现专辑','subtitle'=>'爱客商城'));
		$this->display();
	}
	
	public function album() {
	
	
		$this->_config_seo (array('title'=>'发现专辑','subtitle'=>'爱客商城'));
		$this->display('explore_album');
	}
	//创建专辑
	public function create_album(){
		
		$this->_config_seo (array('title'=>'创建新专辑','subtitle'=>'爱客商城'));
		$this->display();
	}	
	public function test(){
		$tag_list = D('tag')->get_tags_by_title('安真美 正品 2013夏季新款女包 最新流行笑脸包包 明星女包 包邮');
		$tags = implode(' ', $tag_list);
		dump($tags);
		$this->display();
	}	
}