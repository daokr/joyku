<?php

class itemAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
        //访问者控制
/*         if (!$this->visitor->is_login && in_array(ACTION_NAME, array('share_item', 'fetch_item', 'publish_item', 'like', 'unlike', 'delete', 'comment'))) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'));
            $this->redirect('user/login');
        } */
    }

    //获取商品信息
    public function fetch_item() {
    	
    	$url = $this->_post('url','trim','');
    	empty($url) && $this->ajaxReturn(array('r'=>1, 'html'=> '请填写商品地址！'));
    	//$this->ajaxReturn(array('r'=>0, 'html'=> '抓取ok'));
    	
    	
/*     	$url = $this->_get('url', 'trim');
    	$url == '' && $this->ajaxReturn(0, L('please_input') . L('correct_itemurl'));
    	$aid = $this->_get('aid', 'intval');
    	//获取商品信息
    	$itemcollect = new itemcollect();
    	!$itemcollect->url_parse($url) && $this->ajaxReturn(0, '请输入正确的商品地址');
    	$info = $itemcollect->fetch(); */
    }

}