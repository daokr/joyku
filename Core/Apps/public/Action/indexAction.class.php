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
		$this->dev_mod = D('develop/develop');
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
		//获取推荐的应用
		$arrpopApp = $this->dev_mod->getPopApp(10);
		
		//获取最多点击的的 8文章
		$arrHotArticle = $this->article_mod->getArticleItemByMap('count_view desc','4',array('isphoto'=>'1'));
		$this->assign ( 'arrHotArticle', $arrHotArticle );
		
		//统计用户数
		$count_user = $this->user_mod->count('*'); 
		
		$this->assign ( 'ret_url', $ret_url );
		$this->assign ( 'count_user', $count_user );
		$this->assign ( 'arrpopApp', $arrpopApp );
		$this->assign ( 'arrNewGroup', $arrNewGroup );
		$this->assign ( 'arrNewArticle', $arrNewArticle );
		$this->assign ( 'arrRecommendGroup', $arrRecommendGroup );
		$this->assign ( 'arrHotUser', $arrHotUser );
		$this->assign ( 'arrHotTopic', $arrHotTopic ); 
		$this->_config_seo ();
		$this->display ();
	}
	public function style(){

		$ikTheme = cookie('ikTheme');
		$ikTheme = empty($ikTheme) ? 'blue' : $ikTheme;
		$arrTheme	= ikScanDir('Public/theme');
		$this->assign('arrTheme',$arrTheme);
		$this->assign('ikTheme',$ikTheme);
		$this->_config_seo ( array (
				'title' => '更换主题风格',
		) );
		$this->display();
	}

}