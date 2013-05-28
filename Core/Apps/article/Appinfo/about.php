<?php
/**
 * 文章阅读版本信息
 * @author 小麦 <160780470@qq.com>
 * @version IKPHP 1.5
 */
if(!defined('SITE_PATH')) exit();

return array(
	// 应用名称 [必填]
	'NAME'						=> '阅读',	
	// 应用简介 [必填]
	'DESCRIPTION'				=> '可以通过投稿、管理员推荐、绑定用户等方式，聚合优质内容，可以采集抓取各大网站内容',
	// 托管类型 [必填]（0:本地应用，1:远程应用）
	'HOST_TYPE'					=> '0',
	// 前台入口 [必填]（格式：Action/act）
	'APP_ENTRY'					=> 'index/index',
	// 为空
	'ICON_URL'					=> APPS_PATH.'article/Appinfo/icon_app.png',
	// 为空
	'LARGE_ICON_URL'			=> APPS_PATH.'article/Appinfo/icon_app_large.png',
	// 版本号 [必填]
	'VERSION'			=> '1.5',
	// 后台入口 [选填]
	'ADMIN_ENTRY'				=> 'article/admin/index',
	// 统计入口 [选填]（格式：Model/method）
	'STATISTICS_ENTRY'			=> 'statistics/statistics',
	// 开发者
	'AUTHOR_NAME'				=> '爱客开源',
	// 开发者个人网址
	'AUTHOR_URL'				=> 'http://www.ikphp.com',		

);
