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
$(function(){
	$('#score_setting').find('input').live('keyup keydown blur',function(){
	    var self = $(this);
	    var val = self.val();
	    val = val.replace(/[^0-9]/g,'');
	    self.val(val);
	});
})
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
<table  cellpadding="0" cellspacing="0" id="score_setting">
<tr class="old">
<td width="150">用户行为</td>
<td width="200">积分</td>
<td>每日奖惩上限次数</td>
</tr>
<tr class="odd">
<td>注册</td>
	<td>+ <input name="score_rule[register]"  class="input-text" size="10"value="<?php echo C(ik_srule_register);?>" /> 分</td>
	<td>1</td>
</tr>
<tr class="odd">
    <td>登录 :</td>
    <td>+ <input type="text" name="score_rule[login]" class="input-text" size="10" value="<?php echo C(ik_srule_login);?>"> 分</td>
    <td><input type="text" name="score_rule[login_nums]" class="input-text" size="10" value="<?php echo C(ik_srule_login_nums);?>"></td>
</tr>
<tr>
    <td>发布帖子 :</td>
    <td>+ <input type="text" name="score_rule[pubtopic]" class="input-text" size="10" value="<?php echo C('ik_srule_pubtopic');?>"> 分</td>
    <td><input type="text" name="score_rule[pubtopic_nums]" class="input-text" size="10" value="<?php echo C('ik_srule_pubtopic_nums');?>"></td>
</tr>
<tr>
    <td>删除帖子 :</td>
    <td>- <input type="text" name="score_rule[deltopic]" class="input-text" size="10" value="<?php echo C('ik_srule_deltopic');?>"> 分</td>
    <td><input type="text" name="score_rule[deltopic_nums]" class="input-text" size="10" value="<?php echo C('ik_srule_deltopic_nums');?>"></td>
</tr>
<tr>
    <td>发布评论 :</td>
    <td>+ <input type="text" name="score_rule[pubcmt]" class="input-text" size="10" value="<?php echo C('ik_srule_pubcmt');?>"> 分</td>
    <td><input type="text" name="score_rule[pubcmt_nums]" class="input-text" size="10" value="<?php echo C('ik_srule_pubcmt_nums');?>"></td>
</tr>
<tr>
    <td>删除评论 :</td>
    <td>- <input type="text" name="score_rule[delcmt]" class="input-text" size="10" value="<?php echo C('ik_srule_delcmt');?>"> 分</td>
    <td><input type="text" name="score_rule[delcmt_nums]" class="input-text" size="10" value="<?php echo C('ik_srule_delcmt_nums');?>"></td>
</tr>
</table>

<div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>
</form>
</div>
</body>
</html>