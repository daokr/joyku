<?php
/**
 * 卸载文章应用
 * @author 小麦  <160780470@qq.com>
 * @version IKPHP1.5
 */
if(!defined('SITE_PATH')) exit();
// 数据库表前缀
$db_prefix = C('DB_PREFIX');
// 卸载数据SQL数组
$sql = array(
	// 数据
	"DROP TABLE IF EXISTS `{$db_prefix}group`;",
	"DROP TABLE IF EXISTS `{$db_prefix}group_setting`;",
	"DROP TABLE IF EXISTS `{$db_prefix}group_users`;",
	"DROP TABLE IF EXISTS `{$db_prefix}group_topics`;",	
	"DROP TABLE IF EXISTS `{$db_prefix}group_topics_collects`;",
	"DROP TABLE IF EXISTS `{$db_prefix}group_topics_comments`;",
	"DROP TABLE IF EXISTS `{$db_prefix}group_topics_recommend`;",
);
// 删除文件
// 执行SQL
foreach($sql as $v) {
	D('')->execute($v);
}