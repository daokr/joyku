<?php
/**
 * 卸载爱客商城应用
 * @author 小麦  <160780470@qq.com>
 * @version IKPHP1.5
 */
if(!defined('SITE_PATH')) exit();
// 数据库表前缀
$db_prefix = C('DB_PREFIX');
// 卸载数据SQL数组
$sql = array(
	// 数据
	"DROP TABLE IF EXISTS `{$db_prefix}mall_album`;",
	"DROP TABLE IF EXISTS `{$db_prefix}mall_album_cate`;",
);
// 删除文件
// 执行SQL
foreach($sql as $v) {
	D('')->execute($v);
}