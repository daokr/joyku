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
		$this->article_channel_mod = D('article/article_channel');
		$this->note_mod = D('space/note');
		$this->photo_album_mod = D('space/user_photo_album');
		
		$this->event_mod = D( 'location/event' );
		$this->event_cate_mod = D( 'location/event_cate' );
	}
	public function index(){

		//统计用户数
		$count_user = $this->user_mod->count('*'); 
		$this->assign ( 'count_user', $count_user );
		
		//获取推荐照片
		$arrPhoto = $this->photo_album_mod->getRecommendAlbum(4);
		$this->assign ( 'arrPhoto', $arrPhoto );
		
		//获取推荐日记
		$arrNote = $this->note_mod->getRecommendNote(14);
		$this->assign ( 'arrNote', $arrNote );

		//文章模块
		$articleChannel = $this->article_channel_mod->getAllChannel();
		$this->assign ( 'articleChannel', $articleChannel );
		//文章列表
		foreach($articleChannel as $key=>$item){
			$arrArticle[$key][cname] = $item['name'];
			$arrArticle[$key]['alist'] = $this->article_mod->getArticleByChannel($item['nameid'],5);
		}
		$this->assign ( 'arrArticle', $arrArticle );

		//推荐小组10个
		$arrRecommendGroups = $this->group_mod->getRecommendGroup ( 14 );
		foreach ( $arrRecommendGroups as $key => $item ) {
			$arrRecommendGroup [] = $item;
			$arrRecommendGroup [$key] ['groupdesc'] = getsubstrutf8 ( t ( $item ['groupdesc'] ), 0, 35 );
		}
		$this->assign ( 'arrRecommendGroup', $arrRecommendGroup );		
		
		//热门同城活动
		$hotEvent = $this->event_mod->getHotEvent(6);
		$this->assign('hotEvent',$hotEvent);
		
		//获取同城活动大分类
		$arrEventCates = $this->event_cate_mod->getAllCate();
		foreach ($arrEventCates as $key=>$item){
			$arrEventCateList[$key]['parentCate'] = $item; 
			$arrEventCateList[$key]['childCate'] = $this->event_cate_mod->getAllsubCate($item['cateid']);
		}
		$this->assign('arrEventCateList',$arrEventCateList);		
		
		
		//活跃会员
		$arrHotUser = $this->user_mod->getHotUser(14);
		$this->assign ( 'arrHotUser', $arrHotUser );
		
		$this->_config_seo ();
		$this->display ();
	}
	/*public function index() {
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
		$arrHotArticle = $this->article_mod->getArticleItemByMap('count_view desc','6',array('isphoto'=>'1'));
		$this->assign ( 'arrHotArticle', $arrHotArticle );
		
		//获取头条
		$arrdigArticle = $this->article_mod->getArticleItemByMap('orderid desc','8',array('isdigest'=>'1','isphoto'=>1));
		$this->assign ( 'arrdigArticle', $arrdigArticle );
		//dump($arrdigArticle);
		//视觉
		$arrfunArticle = $this->article_mod->getArticleItemByMap('orderid desc','4',array('cateid'=>array('exp',' IN (18,19) ','isphoto'=>1)));
		$this->assign ( 'arrfunArticle', $arrfunArticle );
		
		//获取推荐照片
		$arrPhoto = $this->photo_mod->getRecommendPhoto(4);
		$this->assign ( 'arrPhoto', $arrPhoto );
		
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
	}*/
	public function style(){

		$ikTheme = cookie('ikTheme');
		$ikTheme = empty($ikTheme) ? 'blue' : $ikTheme;
		$arrTheme	= ikScanDir('Public/theme');
		$this->assign('arrTheme',$arrTheme);
		$this->assign('ikTheme',$ikTheme);
		$this->_config_seo ( array (
				'title' => '更换主题风格',
				'keywords' =>'',
				'description'=>'',
		) );
		$this->display();
	}

}