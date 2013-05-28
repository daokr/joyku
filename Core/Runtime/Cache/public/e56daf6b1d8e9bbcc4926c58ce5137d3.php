<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($seo["title"]); ?> - <?php echo ($seo["subtitle"]); ?></title>
<meta name="keywords" content="<?php echo ($seo["keywords"]); ?>" /> 
<meta name="description" content="<?php echo ($seo["description"]); ?>" /> 
<link rel="shortcut icon" href="__PUBLIC__/images/fav.ico" type="image/x-icon">
<style>__SITE_THEME_CSS__</style>
<!--[if gte IE 7]><!-->
    <link href="__PUBLIC__/js/dialog/skins5/idialog.css" rel="stylesheet" />
<!--<![endif]-->
<!--[if lt IE 7]>
    <link href="__PUBLIC__/js/dialog/skins5/idialog.css" rel="stylesheet" />
<![endif]-->
<script>var siteUrl = '__SITE_URL__';</script>
<script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/common.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/IK.js" type="text/javascript" data-cfg-autoload="false"></script>
<script src="__PUBLIC__/js/all.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="__PUBLIC__/js/html5.js"></script>
<![endif]-->
<script src="__PUBLIC__/js/dialog/jquery.artDialog.min5.js" type="text/javascript"></script> 
__EXTENDS_JS__
<!--<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21509482"></script>-->
<link rel="stylesheet" type="text/css" href="__STATIC_CSS__/validate.css" />
<script src="__PUBLIC__/js/validate/jquery.validateid.js"></script>

</head>

<body>
<!--头部开始-->
<header>
<?php if($app_name == 'public' && empty($visitor) && $module_name == 'index'): ?><div class="hd-wrap">
            <div class="hd">
                <div class="logo">
                    <h1><a href="__SITE_URL__" title="爱客开源">爱客开源</a></h1>
                </div>
                <div class="top-nav-items">
                <ul>
                <li><a href="__SITE_URL__" class="lnk-home" target="_blank">爱客首页</a></li>
                <li><a href="<?php echo U('group/index/index');?>" class="lnk-group" target="_blank">爱客小组</a></li>
                <li><a href="<?php echo U('article/index/index');?>" class="lnk-article" target="_blank">爱客阅读</a></li>
                <li><a href="<?php echo U('location/index/index');?>" class="lnk-location" target="_blank">爱客同城</a></li>
                <li><a href="<?php echo U('site/index/index');?>" class="lnk-site" target="_blank">爱客小站</a></li>
                <li><a href="<?php echo U('mall/index/index');?>" class="lnk-mall" target="_blank">爱客商城</a></li>
                </ul>
                </div>
            </div>
</div>
<?php else: ?>
<div class="top_nav">
  <div class="top_bd">
    
    <div class="top_info">
        <?php if(empty($visitor)): ?><a href="<?php echo U('public/user/login');?>">登录</a> | <a href="<?php echo U('public/user/register');?>">注册</a> | <a href="<?php echo U('public/oauth/index', array('mod'=>'qq'));?>" target="_blank" style="margin-left:10px"><img  align="absmiddle" title="QQ登录" src="__PUBLIC__/images/connect_qq.png"> 登录</a> | <a href="<?php echo U('public/oauth/index', array('mod'=>'sina'));?>" target="_blank" style="margin-left:10px"><img  align="absmiddle" title="新浪微博" src="__PUBLIC__/images/connect_sina_weibo.png"> 登录</a>    
        <?php else: ?>
        <a id="newmsg" href="<?php echo U('public/message/ikmail',array('d'=>'inbox'));?>">新消息(<?php echo ($count_new_msg); ?>)</a> | 
        <a href="<?php echo U('space/index/index', array('id'=>$visitor['doname']));?>">
        	<?php echo ($visitor["username"]); ?>
        </a> | 
        <a href="<?php echo U('public/user/setbase');?>">设置</a> | 
        <a href="<?php echo U('public/user/logout');?>">退出</a><?php endif; ?>
    </div>


    <div class="top_items">
        <ul>
             <?php if(is_array($topNav)): foreach($topNav as $key=>$item): ?><li><a href="<?php echo ($item[url]); ?>" title="<?php echo ($item[name]); ?>"><?php echo ($item[name]); ?></a></li><?php endforeach; endif; ?>
             <li><a href="<?php echo U('public/apps/index');?>">应用商店</a></li>
             <li><a href="<?php echo U('public/help/download');?>" style="color:#fff">IKPHP源码下载</a></li>                                                      
        </ul>
    </div>
  	<div class="cl"></div>
    
  </div>
  
</div><?php endif; ?>
<!--APP NAV-->

</header>

<?php if($app_name == 'public' && !empty($visitor)): ?><div id="header">
    
	<div class="site_nav">
        <div class="<?php echo ($logo[style]); ?>">
            <a href="<?php echo ($logo[url]); ?>"><?php echo ($logo[name]); ?></a>
        </div>
		<div class="appnav">
			    <ul id="nav_bar">
                    <?php if(is_array($arrNav)): foreach($arrNav as $key=>$item): ?><li><a href="<?php echo ($item[url]); ?>" class="a_<?php echo ($key); ?>"><?php echo ($item[name]); ?></a></li><?php endforeach; endif; ?>
			    </ul>
		   <form onsubmit="return searchForm(this);" method="post" action="<?php echo U('public/search/index');?>">
                <input type="hidden" value="all" name="type">
                <div id="search_bar">
                    <div class="inp"><input type="text" placeholder="小组、话题、日志、成员、小站" value="" class="key" name="q"></div>
                    <div class="inp-btn"><input type="submit" class="search-button" value="搜索"></div>
                </div>
		    </form>
		</div>
        <div class="cl"></div>
	</div>
        
</div><?php endif; ?>


<script type="text/javascript">
$(document).ready(function() {
	
	var validator = $("#signupform").validate({
		onkeyup: false,
		rules:{
			<?php if(C('ik_isinvite') == 1): ?>invitecode:{
				required:true,
				remote:"<?php echo U('check',array('t'=>'isinvite'));?>"
			},<?php endif; ?>
			email: {
				required: true,
				email: true,
				remote: "<?php echo U('check',array('t'=>'email'));?>"
			},
			password: {
				required: true,
				minlength: 5
			},
			repassword: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			username:{
				required: true,
				minlength: 2,
				maxlength: 12,
				remote:"<?php echo U('check',array('t'=>'username'));?>"
			}
		},
		messages: {
		<?php if(C('ik_isinvite') == 1): ?>invitecode:{
				required:"请输入邀请码",
				remote:jQuery.format("邀请码无效，请寻找新的邀请码！")
			},<?php endif; ?>
			email: {
					required: "请输入Email地址",
					email: "请输入一个正确的Email地址",
					remote:jQuery.format("Email已经存在，请更换其他Email")
			},
			password: {
				required: "请输入密码",
				minlength: jQuery.format("至少输入6个字符")
			},
			repassword: {
				required: "请重复输入密码",
				minlength: jQuery.format("两次输入密码不一致"),
				equalTo: "两次输入密码不一致"
			},
			username:{
				required:"请输入用户名",
				minlength: jQuery.format("至少输入2个字符"),
				maxlength: jQuery.format("最多输入12个字符"),
				remote:jQuery.format("用户名已经存在，请更换其他用户名")
			}
		},

		// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().next() );
		},

		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});

});
</script>

<script language="javascript">
function newgdcode(obj) {
obj.src = $(obj).attr('url') + '&nowtime=' + new Date().getTime();
//后面传递一个随机参数，否则在IE7和火狐下，不刷新图片
}
</script>


<!--main-->
<div class="midder">
<div class="mc">
<h1 class="user_tit"><?php echo L('user_regist_tit');?></h1>

<?php if(C('ik_isinvite') == 2): ?><p>系统升级中，暂时关闭用户注册！<a href="<?php echo C('ik_site_url');?>">[返回首页]</a></p>
<?php else: ?>

<div class="user_left">
<form  id="signupform" method="POST" action="<?php echo U('public/user/register');?>">

<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="Tabletext">
<?php if(C('ik_isinvite') == 1): ?><tr>
<td class="label"><label id="invitecode" for="invitecode">
<font color="red">邀请码：</font></label></td>
<td class="field" width="300"><input class="uinput" id="invitecode" name="invitecode" type="text" value="" placeholder="请输入邀请码"/></td>
<td class="status"></td>
</tr><?php endif; ?>


<tr>
<td class="label"><label id="email" for="email">Email：</label></td>
<td class="field" width="300"><input class="uinput" id="email" name="email" type="email" value="" placeholder="请输入Email" autofocus/></td>
<td class="status"></td>
</tr>
<tr>
<td class="label"><label>密码：</label></td>
<td class="field"><input class="uinput" type="password" id="password" name="password"  /></td>
<td class="status"></td>
</tr>
<tr>
<td class="label"><label>重复密码：</label></td>
<td class="field"><input class="uinput" type="password" id="repassword" name="repassword"  /></td>
<td class="status"></td>
</tr>

<tr>
<td class="label"><label>用户名：</label></td>
<td class="field"><input class="uinput" type="text" id="username" name="username" /></td>
<td class="status"></td>
</tr>

<tr><td class="label">验证码：</td><td class="field">
<input name="authcode"  class="uinput" style="width:50px; float:left"/>
<img src="<?php echo U('public/user/captcha');?>" url="<?php echo U('public/user/captcha');?>" onclick="javascript:newgdcode(this);" alt="点击刷新验证码" style="cursor:pointer; margin-left:5px; float:left;" align="absmiddle"/></td>
<td class="status"></td></tr>

<tr>
<td class="label"></td>
<td class="field">
<input type="hidden" name="fuserid" value="<?php echo ($fuserid); ?>" />
<input class="submit" type="submit" value="注册" style="margin-top:8px"/> 
</td>
<td class="status"></td>
</tr>

<tr>
<td class="label"><br /></td>
<td class="field"><br /></td> 
<td class="status"></td>
</tr>

</table>
</form><?php endif; ?>
</div>

<div class="aside">
            
	<p class="pl2">&gt; 已经拥有12ik网帐号? <a href="<?php echo U('public/user/login');?>" rel="nofollow">直接登录</a></p>

</div>
<div class="cl"></div>

</div>
</div>
<!--footer-->
<footer>
<div id="footer">
	<div class="f_content">
        <span class="fl gray-link" id="icp">
            &copy; 2012－2015 IKPHP.COM, all rights reserved <span><a href="http://www.miibeian.gov.cn/" target="_blank">京ICP备13018602号</a></span>
        </span>
        
        <span class="fr">
            <a href="<?php echo U('public/help/about');?>">关于爱客</a>
            · <a href="<?php echo U('public/help/contact');?>">联系我们</a>
            · <a href="<?php echo U('public/help/agreement');?>">用户条款</a>
            · <a href="<?php echo U('public/help/privacy');?>">隐私申明</a>
        </span>
        <div class="cl"></div>
        <p>Powered by <a class="softname" href="<?php echo (IKPHP_SITEURL); ?>"><?php echo (IKPHP_SITENAME); ?></a> <?php echo (IKPHP_VERSION); ?>  
        <font color="green">ThinkPHP版本<?php echo (THINK_VERSION); ?></font>  目前有 <?php echo ($count_online_user); ?> 人在线<br />
        <span style="font-size:0.83em;">{__RUNTIME__}          </span>

        <!--<script src="http://s6.cnzz.com/stat.php?id=5262498&web_id=5262498" language="JavaScript"></script>-->
       
        </p>   
    </div>
</div>
</footer>
</body>
</html>