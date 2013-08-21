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
<div class="tabnav">
<ul>
<li  <?php if($type == "index"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index');?>">基本配置</a></li>
<li  <?php if($type == "site"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index',array('type'=>'site'));?>">全局配置</a></li>
<li  <?php if($type == "attachment"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index',array('type'=>'attachment'));?>">附件设置</a></li>
<li  <?php if($type == "mail"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index',array('type'=>'mail'));?>">邮件设置</a></li>
</ul>
</div>
<form method="POST" action="__GROUP__/setting/edit">
<table cellpadding="0" cellspacing="0">

	<tr>
		<th>邮箱Host ：</th>
		<td><input style="width: 300px;" name="setting[mailhost]"  size="50" value="<?php echo C('ik_mailhost');?>" /> (例如：smtp.qq.com)</td>
	</tr>
	<tr>
		<th>邮箱端口 ：</th>
		<td><input style="width: 300px;" name="setting[mailport]" size="50" value="<?php echo C('ik_mailport');?>" /> (例如：25)</td>
	</tr>
	<tr>
		<th>邮箱用户 ：</th>
		<td><input style="width: 300px;" name="setting[mailuser]"  value="<?php echo C('ik_mailuser');?>" />  (例如：user@qq.com)</td>
	</tr>        
	<tr>
		<th>邮箱密码 ：</th>
		<td><input style="width: 300px;" name="setting[mailpwd]"  value="<?php echo C('ik_mailpwd');?>" /> (例如：123456)</td>
	</tr> 
</table>

<div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>

</form>
</div>
</body>
</html>