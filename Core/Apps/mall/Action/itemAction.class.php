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
    	empty($url) && $this->ajaxReturn();
    	
    	$itemcollect = new itemcollect();
    	!$itemcollect->url_parse($url) && $this->ajaxReturn(array('r'=>1, 'html'=> '请输入正确的商品地址！'));
    	//取商品信息
    	$info = $itemcollect->fetch();
    	if (!$info = $itemcollect->fetch()) {
    		$this->ajaxReturn(array('r'=>1, 'html'=> '获取商品数据失败！'));
    	}else{
    		$tag_list = D('tag')->get_tags_by_title($info['item']['title'],6);
    		$tags = implode(' ', $tag_list);
    		$info['item']['tags'] = $tags;
    		$data = $info['item'];
    		$this->ajaxReturn(array('r'=>0, 'html'=> $data));
    	}
    }
    //发布商品
    public function publish_item() {
    	$item = unserialize($this->_post('item', 'trim'));
    	!$item['key_id'] && $this->ajaxReturn(0, L('publish_item_failed'));
    	$album_id = $this->_post('album_id', 'intval', 0);
    	$ac_id = $this->_post('ac_id', 'intval', 0);
    	$item['intro'] = $this->_post('intro', 'trim');
    	$item['info'] = Input::deleteHtmlTags($item['info']);
    	$item['uid'] = $this->visitor->info['id'];
    	$item['uname'] = $this->visitor->info['username'];
    	$item['status'] = C('pin_item_check') ? 0 : 1;
    	//添加商品
    	$item_mod = D('item');
    	$result = $item_mod->publish($item, $album_id, $ac_id);
    	if ($result) {
    		//发布商品钩子
    		$tag_arg = array('uid' => $item['uid'], 'uname' => $item['uname'], 'action' => 'pubitem');
    		tag('pubitem_end', $tag_arg);
    		$this->ajaxReturn(1, L('publish_item_success'));
    	} else {
    		$this->ajaxReturn(0, $item_mod->getError());
    	}
    }

}