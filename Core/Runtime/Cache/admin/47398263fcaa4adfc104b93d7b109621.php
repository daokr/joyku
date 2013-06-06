<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="160780470@qq.com" />
<meta name="Copyright" content="<?php echo ($ikphp["ikphp_site_name"]); ?>" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" type="text/css" href="__ADMIN_STATIC__/css/style.css" />
<script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script src="__ADMIN_STATIC__/js/common.js" type="text/javascript"></script>
</head>
<body>
<!--main-->
<div class="midder">
<h2><?php echo ($title); ?></h2> 
<table  cellpadding="0" cellspacing="0">
<tr class="old">
<td>图标</td>
<td>应用名称</td>
<td>应用别名</td>
<td>应用描述</td>
<td>版本</td>
<td>托管类型</td>
<td>开发者</td>
<td width="200">操作</td>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr class="odd">
<td><?php echo ($item[icon_url]); ?></td>
<td><?php echo ($item[app_name]); ?></td>
<td><?php echo ($item[app_alias]); ?></td>
<td><?php echo ($item[description]); ?></td>
<td><?php echo ($item[version]); ?></td>
<td><?php echo ($item[host_type_alias]); ?></td>
<td><?php echo ($item[author_name]); ?></td>
<td><?php echo ($item[doaction]); ?></td>
<tr><?php endforeach; endif; ?>
</table>
<div class="pagebar"><?php echo ($pageUrl); ?></div>
</div>
</body>
</html>