<?php

class itemAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
    		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'fetch_item',
				'publish_item',
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
       $this->user_mod = D ( 'user' );
       $this->item_mod = D ( 'mall_item' );
       $this->item_orig = D( 'mall_item_orig' );
       $this->item_img = D('mall_item_img');
       
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
    		$info['item']['itemobj'] = serialize($info['item']);
    		$data = $info['item'];
    		$this->ajaxReturn(array('r'=>0, 'html'=> $data));
    	}
    }
    //发布商品
    public function publish_item() {
    	$item = unserialize($this->_post('item', 'trim'));
    	!$item['key_id'] && $this->ajaxReturn(array('r'=>1, 'html'=> '发布商品失败！'));
    	
    	//单品发布
    	$userid = $this->visitor->info ['userid'];
    	$item['userid'] = $userid;
    	$item['intro'] = $this->_post('intro', 'trim');
    	$item['title'] = $this->_post('title', 'trim');
    	$item['tags'] = $this->_post('tags', 'trim');
    	$item['status'] = C('ik_mall_item_check') ? 0 : 1;
    	
    	$itemid = $this->item_mod->publish($item);
    	if ($itemid) {
    		//发布商品钩子
    		$html = '分享商品成功！<a href="'.U('mall/item/index',array('id'=>$itemid)).'">查看我的分享</a>&nbsp;&nbsp;<a href="'.U('mall/index/mine',array('ik'=>'myshare')).'">去我的淘客</a>';
    		$this->ajaxReturn(array('r'=>0, 'html'=> $html));
    	} else {
    		$this->ajaxReturn(array('r'=>1, 'html'=> $this->item_mod->getError()));
    	}

    }
    //详情页面
    public function index(){
    	$id = $this->_get('id', 'intval');
    	!$id && $this->_404();
    	$item_mod = $this->item_mod;
    	$item = $item_mod->field('id,title,userid,intro,price,url,likes,comments,tag_cache,seo_title,seo_keys,seo_desc,add_time')->where(array('id' => $id, 'status' => 1))->find();
    	!$item && $this->_404();
    	
    	//来源
    	$orig = $this->item_orig->field('name,img')->find($item['orig_id']);
    	//商品相册
    	$img_list = $this->item_img->field('url')->where(array('item_id' => $id))->order('ordid')->select();
    	
    	$this->assign('strItem', $item);
    	$this->assign('orig', $orig);
    	$this->assign('img_list', $img_list);

    	$this->_config_seo (array('title'=>$item['title'],'subtitle'=>'爱客商城'));
    	$this->display();
    }

}