<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>注册引导</title>
<script>var siteUrl = '__SITE_URL__',show_login_url='<?php echo U("public/user/ajaxlogin");?>',show_register_url='<?php echo U("public/user/ajaxregister");?>';</script>
<script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/validate/jquery.validateid.js"></script>
<style>
html {
	color:#111;
	background:#fff
}
blockquote, body, button, code, dd, div, dl, dt, fieldset, form, h1, h2, h3, h4, h5, h6, input, legend, li, pre, textarea, ul {
	margin:0;
	padding:0
}
table {
	border-collapse:collapse;
	border-spacing:0
}
fieldset, img {
	border:0
}
address, caption, cite, code, dfn, em, i, optgroup, strong, th, var {
	font-style:normal;
	font-weight:normal
}
ol, ul {
	list-style:none
}
caption, th {
	text-align:left
}
h1, h2, h3, h4, h5, h6 {
	font-size:100%;
	font-weight:normal
}
q:after, q:before {
content:
}
abbr, acronym {
	border:0;
	font-variant:normal
}
sup {
	vertical-align:baseline
}
sub {
	vertical-align:baseline
}
legend {
	color:#000
}
button, input, optgroup, option, select, textarea {
	font-family:inherit;
	font-size:inherit;
	font-style:inherit;
	font-weight:inherit
}
button, input, select, textarea {
*font-size:100%
}
pre {
	white-space:pre-wrap;
	word-wrap:break-word
}
a {
	cursor:pointer
}
a:link {
	color:#37a;
	text-decoration:none
}
a:visited {
	color:#669;
	text-decoration:none
}
a:hover {
	color:#fff;
	text-decoration:none;
	background:#37a
}
a:active {
	color:#fff;
	text-decoration:none;
	background:#f93
}
a img {
	border-width:0;
	vertical-align:middle
}
body, td, th {
	font:12px Helvetica, Arial, sans-serif;
	line-height:1.62
}
table {
	border-collapse:collapse;
	border:0;
	padding:0;
	margin:0
}
wbr:after {
	content:"\00200B"
}
textarea {
	resize:none
}
input[type=password]:focus, input[type=text]:focus, textarea:focus {
	outline:0
}
body, html {
	width:100%;
	height:100%
}
.list {
	overflow:hidden;
	zoom:1
}
.list ul {
	letter-spacing:-0.31em;
*letter-spacing:normal;
	word-spacing:-0.43em
}
.list li {
	display:inline-block;
*display:inline;
	zoom:1;
	width:33.3%;
	vertical-align:top;
	letter-spacing:normal;
	word-spacing:normal
}
.group-item .pic {
	float:left;
	margin-right:12px
}
.group-item .info {
	overflow:hidden;
	zoom:1;
	margin-right:24px
}
.group-item .title {
	margin-bottom:10px;
	line-height:1.3;
	font-size:14px
}
.group-item .members {
	margin-bottom:10px;
	font-size:14px;
	color:#666
}
.group-item .members i {
	color:#072
}
.group-item p {
	margin:0 0 10px;
	color:#666;
	max-height:13em;
	_height:6.2em;
	overflow:hidden;
	word-break:break-all;
	word-wrap:break-word
}
.lnk-selection {
	display:inline-block;
*display:inline;
	zoom:1;
	width:80px;
	line-height:1.8;
*height:1.8em;
*line-height:1.9;
*overflow:hidden;
	text-align:center;
	border-radius:3px
}
.lnk-selection:active, .lnk-selection:hover, .lnk-selection:link, .lnk-selection:visited {
	background-color:#3fa156;
	color:#fff
}
.lnk-selection:active, .lnk-selection:hover {
	background-color:#44af5d
}
.selected:active, .selected:hover, .selected:link, .selected:visited {
	background-color:#ccc;
	color:#fff
}
.selected:active, .selected:hover {
	background-color:#ccc
}
.mod-login, .mod-register {
	width: 75%;
	margin: auto;
}
.mod-login .item input, .mod-register .item input {
	width: 78%;
}
h1 {
	width: 75%;
	margin:0 auto 12px;
	font-size:18px;
	color: #072;
}
.col {
	padding-top: 14px;
	width: 50%;
}
.dou-intro {
	position: absolute;
	width: 50%;
	height: 100%;
	right: 0;
	top: 0;
	background: #ecf6ed;
}
.info {
	padding: 24px 0 0 40px;
	margin-bottom: 20px;
	color: #666;
}
.info b {
	margin-right: 10px;
	font-size: 16px;
	-webkit-font-smoothing: antialiased;
}
.dou-intro p {
	padding-left: 40px;
	padding-top: 80px;
	margin: 0 40px 0 0;
	font-size: 18px;
	color: #072;
	-webkit-font-smoothing: antialiased;
}
.mod-register-error {
	position: absolute;
	top: 10px;
	left: 40px;
}
.lnk-reg-entry, .lnk-login-entry {
	display: inline-block;
 *display: inline;
	zoom: 1;
	padding: 0 14px;
	vertical-align: middle;
	background: #edf7ef;
	line-height: 1.8;
}
.lnk-reg-entry:link, .lnk-reg-entry:visited, .lnk-reg-entry:hover, .lnk-reg-entry:active, .lnk-login-entry:link, .lnk-login-entry:visited, .lnk-login-entry:hover, .lnk-login-entry:active {
	color:#072;
	background:#edf7ef;
}

</style>
<link rel="stylesheet" type="text/css" href="__STATIC_CSS__/pop.css" />
</head>
<body>
<div id="content">

<div class="col">
  <h1>欢迎加入<?php echo C('ik_site_title');?></h1>

<div class="mod-register">

<form target="_top" action="<?php echo U('public/user/register',array('simple'=>1));?>" method="post" name="lzform" id="frm-reg">


    <div class="item item-inp">
        <label>邮箱</label>
        <input type="text" value="" tabindex="1" maxlength="60" class="basic-input" name="email" id="email">
    </div>
    
    <div class="item item-inp">
        <label>密码</label>
        <input type="password" maxlength="20" tabindex="2" class="basic-input" name="password" id="password">
    </div>
    
    <div class="item item-inp has-error">
        <label>名号</label>
        <input type="text" value="" tabindex="3" maxlength="15" class="basic-input" name="username" id="username" placeholder="起个响亮的名号吧">
    </div>

    <div class="item item-inp captcha-item" id="captcha-item">
        <label>验证码</label>
        <img title="点击换一张" class="captcha-img" src="<?php echo U('public/user/captcha');?>" url="index.php?app=public&m=user&a=captcha" onclick="javascript:newgdcode(this);"  align="absmiddle">
        <input type="text" maxlength="10" tabindex="4" id="authcode" class="basic-input captcha" name="authcode">
    </div>

    <div class="item item-tos">
        <input type="checkbox" tabindex="5" name="agreement" id="agreement" checked><label class="agreement-label" for="agreement">我已经认真阅读并同意爱客网的《<a href="<?php echo U('public/help/agreement');?>" target="_blank">用户条款</a>》。</label>
    </div>

    <div class="item-submit">
        <input type="submit" tabindex="6" class="btn-submit" value="注册">

  
        <a class="lnk-reg-entry" href="<?php echo U('public/user/ajaxlogin');?>" rel="nofollow">已有帐号，直接登录</a>
    </div>
  <style>
  /* 3rd login*/
  .item-3rd { padding:5px 0;margin-top:10px;border-top:1px solid #eee;border-bottom:1px solid #eee; }
  .item-3rd label { width:auto;margin:0;font-size:12px;color:#999;line-height:1.5; }
  .item-3rd img { margin:0 5px;vertical-align:middle; }
  .item-3rd a:hover { background-color:transparent; }
  .item-3rd a:active { background-color:transparent; }
  </style>
  
  
  <div class="item item-3rd">
    <label>
    第三方登录：
    </label>
    <a href="<?php echo U('public/oauth/index', array('mod'=>'qq'));?>" target="_top"><img title="QQ" src="__PUBLIC__/images/connect_qq.png"></a>
    <a href="<?php echo U('public/oauth/index', array('mod'=>'sina'));?>" target="_top"><img title="新浪微博" src="__PUBLIC__/images/connect_sina_weibo.png"></a>
  </div>

</form>
</div>

<script>

</script>


</div>

<div class="col dou-intro">
  <p>现在加入<?php echo C('ik_site_title');?>小组，结识更多志趣相投之人，<br>无论你来自哪里，有什么兴趣爱好，都能在这里找到和你一样特别的人。</p>

  <div class="info">
	<b>爱客网开源社区程序，内容互动性强，交流更方便</b><br><em>简单</em><em>快捷</em><em>方便</em><em>建设本地化，垂直型社区；目前已有<cite><?php echo ($count_user); ?></cite>位用户加入！</em>
  <br>

  </div>
</div>

</div>


<script type="text/javascript">
$(document).ready(function() {
	
	var validator = $("#frm-reg").validate({
		onkeyup: false,
		rules:{
			email: {
				required: true,
				email: true,
				remote: "<?php echo U('check',array('t'=>'email'));?>"
			},
			password: {
				required: true,
				minlength: 5
			},
			username:{
				required: true,
				minlength: 2,
				maxlength: 12,
				remote:"<?php echo U('check',array('t'=>'username'));?>"
			},
			authcode: {
				required: true
			},
		},
		messages: {
			email: {
					required: "不能为空",
					email: "格式不对",
					remote:jQuery.format("Email已经存在")
			},
			password: {
				required: "不能为空",
				minlength: jQuery.format("不足6个字符")
			},
			username:{
				required:"不能为空",
				minlength: jQuery.format("不足2个字符"),
				maxlength: jQuery.format("最多12个字符"),
				remote:jQuery.format("名号已经存在")
			},
			authcode: {
					required: "不能为空"
			},
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

</body>
</html>