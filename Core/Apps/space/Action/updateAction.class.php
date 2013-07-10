<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * 邮箱:ikphp@sina.cn 微博 空间动态广播
 * 开发时间 2013.7.9 作者：小麦
 */
class updateAction extends spacebaseAction {
	public function _initialize() {
		parent::_initialize ();
		
		//应用所需 mod
		$this->user_mod = D('user');
	}
	//动态广播首页
	public function index(){
		if(! $this->visitor->is_login ) $this->redirect ( 'public/user/login' );
		$userid =  $this->visitor->info ['userid'];
		$user = $this->user_mod->getOneUser($userid);

		
		$this->_config_seo ( array (
				'title' => '我的动态广播',
				'keywords' => '分享日记,分享动态信息,日记,宝贝,照片,最新动态',
				'description'=> '把生活中的点点滴滴都记录下来吧；提供图书、电影、音乐唱片的推荐、评论和价格比较，以及城市独特的文化生活！',
		) );		
		$this->display();
	}
	//发布
	public function publish(){
		$comment = $this->_post('comment','trim'); // 150个字最多

		$content = str_replace("＃", "#", $content);
		preg_match_all("/#([^#]*[^#^\s][^#]*)#/is",$content,$arr);
		$arr = array_unique($arr[1]);
		dump($arr);

	}
	
	
	
}