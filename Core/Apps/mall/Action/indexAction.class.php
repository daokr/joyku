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
		$sort = $this->_get('sort', 'trim', 'hot'); //排序
		$tag = $this->_get('tag', 'trim'); //当前标签
		$page_max = 10; //发现页面最多显示页数
		 
		$where = array();
	    $tag && $where['intro'] = array('like', '%' . $tag . '%');
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
		
		$this->assign('tag', $tag);
        $this->assign('sort', $sort);

		$this->_config_seo (array('title'=>'发现宝贝','subtitle'=>'爱客商城'));
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
        $tag && $where['intro'] = array('like', '%' . $tag . '%');
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

	/**
     * 瀑布显示
     */
    public function waterfall($where = array(), $order = 'id DESC', $field = '', $page_max = '', $target = '') {
        $spage_size = 6; //每次加载个数
        $spage_max = 3; //每页加载次数
        $page_size = $spage_size * $spage_max; //每页显示个数
        
        $item_mod = $this->item_mod;
        $where_init = array('status'=>'1');
        $where = $where ? array_merge($where_init, $where) : $where_init;
        $count = $item_mod->where($where)->count('id');
        //控制最多显示多少页
        if ($page_max && $count > $page_max * $page_size) {
            $count = $page_max * $page_size;
        }
        //查询字段
        $field == '' && $field = 'id,userid,title,intro,img,price,likes,comments';
        //分页
        $pager = $this->_pager($count, $page_size);
        $target && $pager->path = $target;
        $item_list = $item_mod->field($field)->where($where)->order($order)->limit($pager->firstRow.','.$spage_size)->select();
        foreach ($item_list as $key=>$val) {
            isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);
        }
        $this->assign('item_list', $item_list);
        //当前页码
        $p = $this->_get('p', 'intval', 1);
        $this->assign('p', $p);
        //当前页面总数大于单次加载数才会执行动态加载
        if (($count - ($p-1) * $page_size) > $spage_size) {
            $this->assign('show_load', 1);
        }
        //总数大于单页数才显示分页
        $count > $page_size && $this->assign('page_bar', $pager->fshow());
        //最后一页分页处理
        if ((count($item_list) + $page_size * ($p-1)) == $count) {
            $this->assign('show_page', 1);
        }
    }   
 	/**
     * 瀑布加载
     */
    public function wall_ajax($where = array(), $order = 'id DESC', $field = '') {
        $spage_size = 6; //每次加载个数
        $spage_max = 3; //加载次数
        $p = $this->_get('p', 'intval', 1); //页码
        $sp = $this->_get('sp', 'intval', 1); //子页

        //条件
        $where_init = array('status'=>'1');
        $where = array_merge($where_init, $where);
        //计算开始
        $start = $spage_size * ($spage_max * ($p - 1) + $sp);
        $item_mod = $this->item_mod;
        $count = $item_mod->where($where)->count('id');
        $field == '' && $field = 'id,userid,title,intro,img,price,likes,comments,comments_cache';
        $item_list = $item_mod->field($field)->where($where)->order($order)->limit($start.','.$spage_size)->select();
        foreach ($item_list as $key=>$val) {
            //解析评论
            isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);
        }
        $this->assign('item_list', $item_list);
        $resp = $this->fetch('public:waterfall');
        $data = array(
            'isfull' => 1,
            'html' => $resp
        );
        $count <= $start + $spage_size && $data['isfull'] = 0;
        $this->ajaxReturn(1, '', $data);
    }
    /**
     * AJAX返回数据标准
     *
     * @param int $status
     * @param string $msg
     * @param mixed $data
     * @param string $dialog
     */
    protected function ajaxReturn($status=1, $msg='', $data='', $dialog='') {
        parent::ajaxReturn(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'dialog' => $dialog,
        ));
    }
}