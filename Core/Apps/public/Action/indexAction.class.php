<?php
/*
 * IKPHP 爱客开源社区 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();
		$this->group_mod = D ( 'group/group' );
		$this->user_mod = D ( 'user' );
		$this->group_topic_mod = D ( 'group/group_topics' );
		$this->article_mod = D('article/article');
	}
	public function index() {
		// 来路
		$ret_url = __APP__;
 		//最新10个小组
		$arrNewGroup = $this->group_mod->getNewGroup ( 10 );
		$arrHotTopic = $this->group_topic_mod->getHotTopic(15);
		//活跃会员
		$arrHotUser = $this->user_mod->getHotUser(12);
		//获取最新的 8文章
		$arrNewArticle = $this->article_mod->getNewArticleItem(8);
		//推荐小组10个
		$arrRecommendGroups = $this->group_mod->getRecommendGroup ( 10 );
		foreach ( $arrRecommendGroups as $key => $item ) {
			$arrRecommendGroup [] = $item;
			$arrRecommendGroup [$key] ['groupdesc'] = getsubstrutf8 ( t ( $item ['groupdesc'] ), 0, 35 );
		}
		//统计用户数
		$count_user = $this->user_mod->count('*'); 
		
		$this->assign ( 'ret_url', $ret_url );
		$this->assign ( 'count_user', $count_user );
		$this->assign ( 'arrNewGroup', $arrNewGroup );
		$this->assign ( 'arrNewArticle', $arrNewArticle );
		$this->assign ( 'arrRecommendGroup', $arrRecommendGroup );
		$this->assign ( 'arrHotUser', $arrHotUser );
		$this->assign ( 'arrHotTopic', $arrHotTopic ); 
		$this->_config_seo ();
		$this->display ();
	}

}