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
<script>
function insertMenu(){
	$("table tr:last").after('<tr class="odd"><td><input name="rolename[]" /></td><td><input name="score_start[]" /></td><td><input name="score_end[]" /></td></tr>');
}
</script>
</head>
<body>
<!--main-->
<div class="midder">
<h2><?php echo ($title); ?></h2> 
<div class="tabnav">
<ul>
<?php if(is_array($menu)): foreach($menu as $key=>$item): if($key == $ik): ?><li class="select"><a href="<?php echo ($item[url]); ?>"><?php echo ($item[text]); ?></a></li>
    <?php else: ?>
    <li><a href="<?php echo ($item[url]); ?>"><?php echo ($item[text]); ?></a></li><?php endif; endforeach; endif; ?>
</ul>
</div>

<form method="post">
<table  cellpadding="0" cellspacing="0">
<tr class="old">
<td width="150">角色名称</td>
<td width="200">起始积分</td>
<td>结束积分</td>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr class="odd">
<td><input name="rolename[]" value="<?php echo ($item['rolename']); ?>" /></td>
<td><input name="score_start[]" value="<?php echo ($item['score_start']); ?>" /></td>
<td><input name="score_end[]" value="<?php echo ($item['score_end']); ?>" /></td>
</tr><?php endforeach; endif; ?>
</table>
<br>
<a href="javascript:void('0');" onclick="insertMenu();">点击增加角色</a>（说明：如需删除某一项，请将要删除的某项清空提交即可。）
<div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>
</form>
</div>
</body>
</html>