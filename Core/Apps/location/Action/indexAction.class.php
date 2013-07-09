<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends locationbaseAction {
	public function _initialize() {
		parent::_initialize ();
		$this->area_mod = D ( 'area' );
		$this->user_mod = D ( 'user' );
		$this->event_mod = D( 'event' );
		$this->cate_mod = D( 'event_cate' );
	}
	public function index() {
		//获取热门活动 16 个
		$hotEvent = $this->event_mod->getHotEvent(16);
		//获取大分类
		$arrCates = $this->cate_mod->getAllCate();
		foreach ($arrCates as $key=>$item){
			$arrCateList[$key]['parentCate'] = $item; 
			$arrCateList[$key]['childCate'] = $this->cate_mod->getAllsubCate($item['cateid']);
		}
		$this->assign('arrCateList',$arrCateList);
		$this->assign('hotEvent',$hotEvent);
		
		$this->_config_seo ( array (
				'title' => '爱客同城',
				'subtitle'=> '北京_'.C('ik_site_title'),
				'keywords' => '活动网站, 同城活动, 活动发布, 活动搜索, 音乐, 演出, 电影, 话剧, 公益, 讲座, 沙龙, 展览, 聚会, 旅行, 交友',
				'description'=> '提供北京本地所有音乐、戏剧、讲座、聚会、旅行等线下活动的资讯，并能根据你的口味推荐好活动给你，帮助你结识志同道合的人',
		) );
		$this->display();
	}
	public function area() {
		// 处理html编码
		
		$this->error('APP模块还在建设中,请等待下一版本吧！') ;
	}
	public function getarea(){
		$id = $this->_post('areaid');
		if(!empty($id)){
			$arrStrict = $this->area_mod->field('areaid,areaname')->where(array('referid'=>$id))->select();
			if($arrStrict){
				$arrJson = array(
						'id'=> $id,
						'r'=> true,
						'children'=>$arrStrict,
				);
			}else{
				$arrJson = array(
						'id'=> $id,
						'r'=> false,
				);
			}
		}else{
			$arrJson = array(
					'id'=> $id,
					'r'=> false,
			);
		}
		$this->ajaxReturn($arrJson,'JSON');
	}

	
}