<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com 个人空间 基础action
 */
class spacebaseAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();		
		$this->item_mod = D('user_photo');
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	protected  function _nav(){
		$arrNav = array ();
		$arrNav['index'] = array('name'=>'首页', 'url'=>C('ik_site_url'));
		if($this->visitor->info['userid'] > 0){
			$arrNav['update'] = array('name'=>'动态广播', 'url'=>U('space/update/index'));
			$arrNav['mine'] = array('name'=>'我的空间', 'url'=>U('space/mine/index'));
		}
		$arrNav['explore'] = array('name'=>'浏览发现', 'url'=>U('space/explore/index'));
		$arrNav['neighborhood'] = array('name'=>'周边生活', 'url'=>U('space/neighborhood/index'));
		return $arrNav;
	}
	/**
	 * 瀑布显示
	 */
	public function waterfall($where = array(), $order = 'photoid DESC', $page_max = '') {
		$spage_size = 10; //每次加载个数
		$spage_max = 10; //每页加载次数
		$page_size = $spage_size * $spage_max; //每页显示个数
	
		$item_mod = $this->item_mod;
		$count = $item_mod->where($where)->count('photoid'); 
		//控制最多显示多少页
		if ($page_max && $count > $page_max * $page_size) {
			$count = $page_max * $page_size;
		}
		//分页
		$pager = $this->_pager($count, $page_size);
		$arrphoto = $item_mod->field('photoid')->where($where)->order($order)->limit($pager->firstRow.','.$spage_size)->select();
		
		foreach ($arrphoto as $val) {
			$item_list[] = $item_mod->getOnePhoto($val['photoid']);
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
	public function wall_ajax($where = array(), $order = 'photoid DESC') {
	
		$spage_size = 10; //每次加载个数
		$spage_max = 10; //加载次数
		$p = $this->_get('p', 'intval', 1); //页码
		$sp = $this->_get('sp', 'intval', 1); //子页
	
		//条件
		//计算开始
		$start = $spage_size * ($spage_max * ($p - 1) + $sp);
		$item_mod = $this->item_mod;
		$count = $item_mod->where($where)->count('photoid');

		$arrphoto = $item_mod->field('photoid')->where($where)->order($order)->limit($start.','.$spage_size)->select();
		foreach ($arrphoto as $key=>$val) {
			$item_list[] = $item_mod->getOnePhoto($val['photoid']);
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