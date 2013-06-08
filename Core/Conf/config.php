<?php
return array(

    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
    'APP_GROUP_LIST'            =>  'public,admin,group,article,develop',	
	'DEFAULT_MODULE'            => 'index', // 默认模块名称		
    'APP_GROUP_MODE'            =>  1,
    'SHOW_PAGE_TRACE'           =>  1,//显示调试信息
	'LOAD_EXT_CONFIG' => 'url,db', //扩展配置

	'TMPL_ACTION_SUCCESS' => 'public:success',
	'TMPL_ACTION_ERROR'   => 'public:error',
		
	'APP_AUTOLOAD_PATH' => 'COM.iklib',//自动加载项目类库
	
);
