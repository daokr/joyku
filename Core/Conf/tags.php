<?php

// 行为插件
return array(
		
	'app_begin' => array(
			//   'check_ipban', //禁止IP
			'load_lang', //语言
	),		
    'view_filter' => array(
        'content_replace', //路径替换
    ),
	/**
	 +------------------------------------------------------------------------------
	 * 用户行为标签
	 +------------------------------------------------------------------------------
	 */
	//登陆
	'login_begin' => array(
	),
	'login_end' => array(
			'alter_score', // 积分
	),
	//注册
	'register_begin' => array(
	),
	'register_end' => array(
			'alter_score', // 积分
	),
	//发布帖子
	'pubtopic_end' => array(
			'alter_score', // 积分
	),
	//删除帖子
	'deltopic_end' => array(
			'alter_score', // 积分
	),		
	//发布评论
	'pubcmt_end' => array(
			'alter_score', // 积分
	),
	//删除评论
	'delcmt_end' => array(
			'alter_score', // 积分
	),

);