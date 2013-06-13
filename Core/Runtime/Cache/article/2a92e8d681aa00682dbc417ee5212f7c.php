<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入其他应用的模版文件：格式 IKAPP:应用名:Tpl目录:操作 -->
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
     <li><a href="<?php echo U('robots/add',array('ik'=>'add_robot'));?>">添加机器人</a></li>
     <li  class="select"><a href="<?php echo U('robots/lists');?>">浏览机器人</a></li>
</ul>
</div>
 
 
<table>
<tr class="old">
    <td width="150">采集名</td>
    <td width="120">采集时间</td>
    <td>采集次数</td>
    <td>选择操作</td>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
    <td><?php echo ($item[name]); ?></td>
    <td><?php echo ($item[lasttime]); ?></td>
    <td><?php echo ($item[robotnum]); ?></td>
    <td>
    <a href="<?php echo U('robots/startrobot',array('clearcache'=>'1','robotid'=>$item[robotid]));?>">开始采集</a> 
    <a href="<?php echo U('robots/edit',array('robotid'=>$item[robotid]));?>">编辑配置</a> 
    <a href="<?php echo U('robots/delete',array('robotid'=>$item[robotid]));?>">删除机器</a></td>
</tr><?php endforeach; endif; ?>
</table>
 
</div>
</body>
</html>