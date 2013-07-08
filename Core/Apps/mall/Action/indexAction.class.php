<?php
/*
 * IKPHP爱客网 爱客商城 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends mallbaseAction {
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
       $this->user_mod = D ( 'user' );
       $this->item_mod = D ( 'mall_item' );
       $this->item_orig = D( 'mall_item_orig' );
       $this->item_img = D('mall_item_img');

	}
	public function index() {

		$this->redirect('mall/index/explore_goods');
		
	}		

	public function explore_goods() {
		$sort = $this->_get('sort', 'trim', 'hot'); //排序
		$tag = $this->_get('tag', 'trim'); //当前标签
		$page_max = 100; //发现页面最多显示页数
		 
		$where = array();
	    $tag && $where['intro|title'] = array('like', '%' . $tag . '%');
        //排序：最热(hot)，最新(new)
        switch ($sort) {
            case 'hot':
                $order = 'hits DESC,id DESC';
                break;
            case 'new':
                $order = 'id DESC';
                break;
        } 
		$this->waterfall($where, $order, '', $page_max);
		
		//$hot_tags = explode(',', C('ik_mall_item_hot_tags')); //热门标签
		//$hot_tags = explode(',', C('ik_mall_item_hot_tags')); //热门标签
		
		$this->assign('hot_tags', $hot_tags);
		$this->assign('tag', $tag);
        $this->assign('sort', $sort);
        

		$this->_config_seo ( array (
				'title' => '发现宝贝',
				'subtitle'=> '爱客商城_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display();
	}	
    public function index_ajax() {
        $tag = $this->_get('tag', 'trim'); //标签
        $sort = $this->_get('sort', 'trim', 'hot'); //排序
        switch ($sort) {
            case 'hot':
                $order = 'hits DESC,id DESC';
                break;
            case 'new':
                $order = 'id DESC';
                break;
        }
        $where = array();
        $tag && $where['intro|title'] = array('like', '%' . $tag . '%');
        $this->wall_ajax($where, $order);
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

	
}