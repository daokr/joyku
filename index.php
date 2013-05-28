<?php
//载入版本号
require_once('version.php');
//网站根路径设置
define('SITE_PATH', dirname(__FILE__));
//定义项目名称和路径
define('APP_NAME', 'Core');
define('APP_PATH', './Core/');
define('APP_DEBUG',TRUE);
define('APPS_PATH', APP_PATH.'Apps/');
define('APPS_URL', APP_NAME.'/apps/');
// 加载框架入口文件
require( "./ThinkPHP/ThinkPHP.php");