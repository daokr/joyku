<?php

class mallbaseAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
       $this->item_mod = D ( 'mall_item' );
       //生成导航
       $this->assign('arrNav',$this->_nav());
    }
	protected  function _nav(){
		// 导航
		if($this->visitor->info['userid']){
			$arrNav['mine'] = array('name'=>'我的淘客', 'url'=>U('mall/mine/index',array('id'=>$this->visitor->info['doname'])));
		}
		$arrNav['explore_goods'] = array('name'=>'发现宝贝', 'url'=>U('mall/index/explore_goods'));
		$arrNav['explore_album'] = array('name'=>'发现专辑', 'url'=>U('mall/index/explore_album'));
		$arrNav['share'] = array('name'=>'分享宝贝', 'url'=>U('mall/item/fetch_item'));
		return $arrNav;
	}
	/**
	 * 瀑布显示
	 */
	public function waterfall($where = array(), $order = 'id DESC', $field = '', $page_max = '', $target = '') {
		$spage_size = 10; //每次加载个数
		$spage_max = 10; //每页加载次数
		$page_size = $spage_size * $spage_max; //每页显示个数
	
		$item_mod = $this->item_mod;
		$where_init = array('status'=>'1');
		$where = $where ? array_merge($where_init, $where) : $where_init;
		$count = $item_mod->where($where)->count('id'); 
		//控制最多显示多少页
		if ($page_max && $count > $page_max * $page_size) {
			//$count = $page_max * $page_size;
		}
		//查询字段
		$field == '' && $field = 'id,userid,title,intro,img,price,likes,comments';
		//分页
		$pager = $this->_pager($count, $page_size);
		$target && $pager->path = $target;
		$item_list = $item_mod->field($field)->where($where)->order($order)->limit($pager->firstRow.','.$spage_size)->select();
		foreach ($item_list as $key=>$val) {
			isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);			
			$item_list[$key]['user'] = D('user')->getOneUser($val['userid']);
			$item_list[$key]['sharenum'] = $item_mod->where(array('userid'=>$val['userid']))->count('id');//分享数
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
	
		$spage_size = 10; //每次加载个数
		$spage_max = 10; //加载次数
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
			$item_list[$key]['user'] = D('user')->getOneUser($val['userid']);
			$item_list[$key]['sharenum'] = $item_mod->where(array('userid'=>$val['userid']))->count('id');//分享数
		}
		$this->assign('item_list', $item_list);
		$resp = $this->fetch('public:waterfall');
		$data = array(
				'isfull' => 1,
				'html' => $resp
		);
		$count <= $start + $spage_size && $data['isfull'] = 0;
		$this->ajaxReturn(array(
				'status' => 1,
				'msg' => '',
				'data' => $data
		));
		
	}

}