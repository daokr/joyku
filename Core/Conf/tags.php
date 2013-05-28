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


);