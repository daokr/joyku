<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入后台管理的头部模版文件 -->
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
<h2><span><a href="<?php echo U('article/admin/channel',array('ik'=>'add'));?>">+新建频道</a></span><?php echo ($title); ?></h2>
<table cellspacing="2" cellpadding="2" class="helptable">
<tbody><tr><td>
<ul>
<li>系统内置了文章频道。您可以为这些频道进行重新命名，并确定是否显示在站点菜单上面。</li>
<li>如果您在站点 <u>文章管理</u> 里面未开启某个频道功能，则该频道不会显示在站点菜单上面。</li>
<li>您也可以添加自己的频道，频道将会在站点的文章首页显示，也可以指定频道访问地址为其他网站页面。</li>
<li>自己添加的频道名称请用英文表示 如：新闻 <u><em>news</em></u> 并且不要使用下划线等特殊字符；这样有助于SEO。</li>
</ul>
</td></tr>
</tbody>
</table>
<div class="tabnav">
<ul>
<?php if(is_array($menu)): foreach($menu as $key=>$item): if($key == $ik): ?><li class="select"><a href="<?php echo ($item[url]); ?>"><?php echo ($item[text]); ?></a></li>
    <?php else: ?>
    <li><a href="<?php echo ($item[url]); ?>"><?php echo ($item[text]); ?></a></li><?php endif; endforeach; endif; ?>
</ul>
</div>
<table  cellpadding="0" cellspacing="0">
<tr class="old">
<td>英文名称</td>
<td>频道名</td>
<td width="200">操作</td>
<td width="100">导航</td>
</tr>
<?php if(is_array($arrChannel)): foreach($arrChannel as $key=>$item): ?><tr class="odd">
<td><?php echo ($item[nameid]); ?></td>
<td><?php echo ($item[name]); ?></td>
<td>
<a href="<?php echo U('article/admin/channel',array('ik'=>'edit','nameid'=>$item[nameid]));?>">[编辑]</a> 
<a href="<?php echo U('article/index/channel',array('nameid'=>$item[nameid]));?>" target="_blank">[访问]</a> 
</td>
<td>
<?php if($item[isnav] == 0): ?><a href="<?php echo U('article/admin/channel',array('ik'=>'isnav','isnav'=>1,'nameid'=>$item[nameid]));?>">[取消导航]</a>
<?php else: ?>
<a href="<?php echo U('article/admin/channel',array('ik'=>'isnav','isnav'=>0,'nameid'=>$item[nameid]));?>">[开启导航]</a><?php endif; ?>
</td>
<tr><?php endforeach; endif; ?>
</table>

</div>
</body>
</html>