<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登录引导</title>
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
h1 {
	margin-top: 22px;
}
.mod-register-error {
	top:30px;
}
.mod-login .item-captcha .error, .mod-register .item-captcha .error {
	right: 140px;
}

</style>
<link rel="stylesheet" type="text/css" href="__STATIC_CSS__/pop.css" />
</head>
<body>
<div id="content">

<div class="col">
  <h1>登录<?php echo C('ik_site_title');?></h1>
<div class="mod-login">
    <form target="_top" action="<?php echo U('public/user/login');?>" method="POST" name="lzform" id="lzform" tagName="from">
    <div class="item item-inp">
      <label for="email">邮箱</label>
      <input type="text" value="" id="email" name="email">
    </div>


    <div class="item item-inp">
      <label for="form_password">密码</label>
      <input type="password" id="password" name="password">
    </div>


    <div class="item-rember">
       <label><input type="checkbox" name="remember">&nbsp;下次自动登录</label>
    </div>
    <div class="item-submit">
      <input type="submit" value="登录" class="btn-submit">
      <a class="lnk-reg-entry" href="<?php echo U('public/user/ajaxregister');?>">还没有<?php echo C('ik_site_title');?>帐号? 15秒注册</a>
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
$(function(){
      var validator = $("#lzform").validate({
		onkeyup: false,
		rules:{
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		},
		messages: {
			email: {
					required: "不能为空",
					email: "格式不正确"
			},
			password: {
				required: "不能为空"
			}
		}
	});
});
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

</body>
</html>