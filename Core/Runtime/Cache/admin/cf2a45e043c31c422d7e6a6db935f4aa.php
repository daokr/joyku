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
<td>状态</td>
<td>首页导航</td>
<td>开发者</td>
<td width="200">操作</td>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr class="odd">
<td><?php echo ($item[icon_url]); ?></td>
<td><?php echo ($item[app_name]); ?></td>
<td><?php echo ($item[app_alias]); ?></td>
<td>
<?php if($item[status] == 0): ?><font color="red">已禁用</font> 
<?php else: ?>
<font color="green">已启用</font><?php endif; ?>
</td>
<td><?php echo ($item[is_nav]); ?></td>
<td><?php echo ($item[author_name]); ?></td>
<td>
<a href="<?php echo U('admin/apps/doaction',array('ik'=>'editapp','app_name'=>$item[app_name]));?>">[编辑]</a> 
&nbsp;&nbsp;
<?php if($item[status] == 0): ?><a href="<?php echo U('admin/apps/doaction',array('ik'=>'setstatus','id'=>$item[app_id],'status'=>'1'));?>">[启用]</a> 
<?php else: ?>
<a href="<?php echo U('admin/apps/doaction',array('ik'=>'setstatus','id'=>$item[app_id],'status'=>'0'));?>">[禁用]</a><?php endif; ?>&nbsp;&nbsp;
<a href="<?php echo U('admin/apps/doaction',array('ik'=>'uninstallapp','id'=>$item[app_id]));?>" onClick="return confirm('真的要卸载吗？数据库表数据不可以恢复！请做好备份！')" >[卸载]</a> 
</td>
<tr><?php endforeach; endif; ?>
</table>
<div class="pagebar"><?php echo ($pageUrl); ?></div>
</div>
</body>
</html>