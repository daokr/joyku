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
<form method="POST" action="<?php echo U('oauth/save',array('ik'=>'unitelogin'));?>">
<table cellpadding="0" cellspacing="0">

	<tr>
		<th>接口标识：</th>
		<td><?php echo ($strData[code]); ?><input name="id" value="<?php echo ($strData[id]); ?>" type="hidden" />
        </td>
	</tr>
    <tr>
		<th>接口名称：</th>
		<td>
        <input name="name" value="<?php echo ($strData[name]); ?>"  maxlength="20"/>
        </td>
	</tr>
    <tr>
		<th>App Key：</th>
		<td>
        <input name="key" value="<?php echo ($strData[key]); ?>"  />
        </td>
	</tr>
    <tr>
		<th>App Code：</th>
		<td>
        <input name="keycode" value="<?php echo ($strData[keycode]); ?>" style="width:280px"/>
        </td>
	</tr>        
	</tr>    
</table>
<div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>

</form>
</div>
</body>
</html>