<?php
/**
 * 安装应用
 * @author 小麦  <160780470@qq.com>
 * @version IKPHP1.5
 */
if(!defined('SITE_PATH')) exit();
// 头文件设置
header('Content-Type:text/html;charset=utf-8;');
// 安装SQL文件
$sql_file = APPS_PATH.'/location/Appinfo/install.sql';
// 执行sql文件
$res = D('')->executeSqlFile($sql_file);
// 错误处理
if(!empty($res)) {
	echo $res['error_code'];
	echo '<br />';
	echo $res['error_sql'];
	// 清除已导入的数据
	include_once(APPS_PATH.'/location/Appinfo/uninstall.php');
	exit;
}