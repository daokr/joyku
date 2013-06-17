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

<form method="POST" action="<?php echo U('admin/apps/saveapp');?>">
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>应用名称：</th>
		<td><?php echo ($strApp[app_name]); ?>
        <input   name="app_name" value="<?php echo ($strApp[app_name]); ?>" type="hidden"/>
        <input   name="app_id" value="<?php echo ($strApp[app_id]); ?>" type="hidden"/></td>
	</tr>
	<tr>
		<th>应用别名：</th>
		<td><input style="width: 300px;" name="app_alias" value="<?php echo ($strApp[app_alias]); ?>" maxlength="50"/> 前台展示的应用名称（必填）</td>
	</tr>
	<tr>
		<th>应用描述：</th>
		<td><textarea style="width: 300px; height: 50px; font-size: 12px;" name="description" maxlength="200"><?php echo ($strApp[description]); ?></textarea>
        用于前台展示本应用的描述</td>
	</tr>

	<tr>
		<th>应用状态：</th>
		<td>
        <input type="radio"  <?php if($strApp[status] == 1): ?>checked<?php endif; ?> name="status" value="1" /> 开启 
        <input type="radio"  <?php if($strApp[status] == 0): ?>checked<?php endif; ?> name="status" value="0" /> 关闭 
        <input name="host_type" value="<?php echo ($strApp[host_type]); ?>" type="hidden"/>
        </td>
	</tr>
	<tr>
		<th>导航显示：</th>
		<td>
        <input type="radio"  <?php if($strApp[is_nav] == 1): ?>checked<?php endif; ?> name="is_nav" value="1" /> 是 
        <input type="radio"  <?php if($strApp[is_nav] == 0): ?>checked<?php endif; ?> name="is_nav" value="0" /> 否 
        <input name="host_type" value="<?php echo ($strApp[host_type]); ?>" type="hidden"/>
        </td>
	</tr>    
	<tr>
		<th>前台入口：</th>
		<td><input style="width: 300px;" name="app_entry" value="<?php echo ($strApp[app_entry]); ?>" maxlength="30"/></td>
	</tr>
	<tr>
		<th>图标地址：</th>
		<td><input style="width: 300px;" name="icon_url" value="<?php echo ($strApp[icon_url]); ?>" maxlength="100"/></td>
	</tr>
	<tr>
		<th>大图标地址：</th>
		<td><input style="width: 300px;" name="large_icon_url" value="<?php echo ($strApp[large_icon_url]); ?>" maxlength="100"/></td>
	</tr> 
	<tr>
		<th>后台入口：</th>
		<td><input style="width: 300px;" name="admin_entry" value="<?php echo ($strApp[admin_entry]); ?>" maxlength="60"/></td>
	</tr>   
	<tr>
		<th>统计入口：</th>
		<td><input style="width: 300px;" name="statistics_entry" value="<?php echo ($strApp[statistics_entry]); ?>" maxlength="60"/></td>
	</tr> 
    <tr>
		<th>显示顺序：</th>
		<td><input style="width: 50px;" name="version" value="<?php echo ($strApp[display_order]); ?>" maxlength="30"/> 在应用市场和导航上的显示顺序</td>
	</tr>    
	<tr>
		<th>版本：</th>
		<td><input style="width: 50px;" name="version" value="<?php echo ($strApp[version]); ?>" maxlength="30"/></td>
	</tr> 
	<tr>
		<th>API_KEY：</th>
		<td><input style="width: 300px;" name="api_key" value="<?php echo ($strApp[api_key]); ?>" maxlength="60"/></td>
	</tr>         
	<tr>
		<th>API密钥：</th>
		<td><input style="width: 300px;" name="secure_key" value="<?php echo ($strApp[secure_key]); ?>" maxlength="60"/></td>
	</tr>                 
	<tr>
		<th>开发者：</th>
		<td><input style="width: 300px;" name="author_name" value="<?php echo ($strApp[author_name]); ?>" maxlength="30"/></td>
	</tr>
	<tr>
		<th>开发者网址：</th>
		<td><input style="width: 300px;" name="author_url" value="<?php echo ($strApp[author_url]); ?>" maxlength="100"/> 必须以http://开头，以/结尾</td>
	</tr> 
</table>

<input  name="is_edit" value="<?php echo ($strApp[is_edit]); ?>" type="hidden"/>
<div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>

</form>

</div>
</body>
</html>