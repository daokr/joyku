<?php

class itemAction extends mallbaseAction {

    public function _initialize() {
        parent::_initialize();
    		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
       $this->user_mod = D ( 'user' );
       $this->item_mod = D ( 'mall_item' );
       $this->item_orig = D( 'mall_item_orig' );
       $this->item_img = D('mall_item_img');
       $this->item_col = D('mall_item_collects');

    }

    //获取商品信息
    public function fetch_item() {
    	
    	$url = $this->_post('url','trim','');
    	empty($url) && $this->ajaxReturn(array('r'=>1, 'html'=> '商品地址不能为空'));
    	
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
    	$userid = $this->visitor->info ['userid'];
    	if(empty($userid)){
    		$this->ajaxReturn(array('r'=>2, 'html'=> '还没有登录呢？请先登录吧 !'));
    	}
    	//单品发布
    	$item['userid'] = $userid;
    	$item['intro'] = $this->_post('intro', 'trim');
    	$item['title'] = $this->_post('title', 'trim');
    	$item['tags'] = $this->_post('tags', 'trim');
    	$item['status'] = C('ik_mall_item_check') ? 0 : 1;
    	
    	$itemid = $this->item_mod->publish($item);
    	if ($itemid) {
    		//发布商品钩子
    		$html = '分享商品成功！<a href="'.U('mall/item/index',array('id'=>$itemid)).'">查看我的分享</a>&nbsp;&nbsp;<a href="'.U('mall/mine/item',array('id'=>$this->visitor->info['doname'])).'">去我的淘客</a>';
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
    	$user = $this->visitor->get ();
    	//来源
    	$orig = $this->item_orig->field('name,img')->find($item['orig_id']);
    	$item['user'] = $this->user_mod->getOneUser($item['userid']);
    	$item['user']['isfollow'] = $this->user_mod->isFollow($this->userid, $item['userid']);//是否关注

		// 喜欢收藏的人数
		$likenum = $this->item_col->countLike ( $id );
		$is_Like = $this->item_col->isLike ( $user ['userid'], $id );
		$item ['islike'] = $is_Like;
		$item ['likenum'] = $likenum;
		

		
		
    	//商品相册
    	$img_list = $this->item_img->field('url')->where(array('item_id' => $id))->order('ordid')->select();
		// 喜欢该商品的用户
		$arrCollectUser = $this->item_col->likeItemUser ( $id );
    	

    	$this->assign('strItem', $item);
    	$this->assign('orig', $orig);
    	$this->assign('img_list', $img_list);
		$this->assign ( 'arrCollectUser', $arrCollectUser );
		
    	$this->_config_seo (array('title'=>$item['title'],'subtitle'=>'爱客商城'));
    	$this->display();
    }
    //喜欢该商品
    public function like(){
		$itemid = $this->_post ( 'tid' );
		if (empty ( $itemid )) {
			$this->error ( "非法操作！" );
		}
		$arrJson = $this->item_col->collectItem ( $this->userid, $itemid );
		$this->ajaxReturn($arrJson);
    }
    /**
     * 点击去购买
     */
    public function buy() {
        $url = $this->_get('url', 'base64_decode');
        redirect($url);
    }

}