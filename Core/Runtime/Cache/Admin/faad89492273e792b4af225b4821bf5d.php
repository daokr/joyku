<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($site_title); ?></title>
<link rel="stylesheet" type="text/css" href="__APP_STATIC__/css/style.css" />

</head>

<body id="loginbody">

    <div class="login">
    
<div class="info">
<form method="post"action="__URL__/checkLogin">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th height="35" scope="row">管理员Email：</th>
    <td><input  name="admin_email" class="linput"/></td>
  </tr>
  <tr>
    <th height="35" scope="row">密码：</th>
    <td><input type="password" name="admin_password" class="linput" /></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>
    <input class="lsubmit" type="submit" value="登录后台" /> <a href="__APP__" class="bh">返回首页</a>
    </td>
  </tr>  
</table>
</form>
</div>
        
    </div>


</body>
</html>