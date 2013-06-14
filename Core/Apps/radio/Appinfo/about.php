<?php
/**
 * 爱客电台版本信息
 * @author 小麦 <160780470@qq.com>
 * @version IKPHP 1.5
 */
if(!defined('SITE_PATH')) exit();

return array(
	// 应用名称 [必填]
	'NAME'						=> '电台',	
	// 应用简介 [必填]
	'DESCRIPTION'				=> '豆瓣电台，酷我电台，用户自己添加自己的电台',
	// 托管类型 [必填]（0:本地应用，1:远程应用）
	'HOST_TYPE'					=> '0',
	// 前台入口 [必填]（格式：Action/act）
	'APP_ENTRY'					=> 'index/index',
	// 为空
	'ICON_URL'					=> APPS_PATH.'radio/Appinfo/icon_app.png',
	// 为空
	'LARGE_ICON_URL'			=> APPS_PATH.'radio/Appinfo/icon_app_large.png',
	// 版本号 [必填]
	'VERSION'			=> '1.5',
	// 后台入口 [选填]
	'ADMIN_ENTRY'				=> 'radio/admin/index',
	// 统计入口 [选填]（格式：Model/method）
	'STATISTICS_ENTRY'			=> 'statistics/statistics',
	// 开发者
	'AUTHOR_NAME'				=> '爱客开源',
	// 开发者个人网址
	'AUTHOR_URL'				=> 'http://www.ikphp.com',		

);
