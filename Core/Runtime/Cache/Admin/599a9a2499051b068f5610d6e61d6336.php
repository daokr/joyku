<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="160780470@qq.com" />
<meta name="Copyright" content="<?php echo ($ikphp["ikphp_site_name"]); ?>" />
<title><?php echo ($title); ?></title>
<link type="text/css" rel="stylesheet" href="__APP_STATIC__/css/main.css"/>
<!--[if gte IE 7]><!-->
    <link href="__PUBLIC__/js/dialog/skins5/idialog.css" rel="stylesheet" />
<!--<![endif]-->
<!--[if lt IE 7]>
    <link href="__PUBLIC__/js/dialog/skins5/idialog.css" rel="stylesheet" />
<![endif]-->
<script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/dialog/jquery.artDialog.min5.js" type="text/javascript"></script> 
<script language="javascript">
function tips(c){ $.dialog({content: '<font style="font-size:14px;">'+c+'</font>',fixed: true, width:300, time:1500});}
function succ(c){ $.dialog({icon: 'succeed',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
function error(c){$.dialog({icon: 'error',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
$(function(){
	//窗口
	var set_h = function(){
        var heights = document.documentElement.clientHeight-80;
        $("#MainIframe, .menubox").height(heights-9);
        $('body').css('overflow','hidden');
    }
    $(window).resize(function(){
        set_h();
    });
    set_h();
	//菜单事件
    //默认载入左侧菜单
    $('.MenuList').load($('.MenuList').attr('data-uri'));
	//左侧菜单收缩
	$('.actuator').live('click',function(){
		var _self = $(this), par = _self.parent();
		if(par.attr('class')=='treemenu_on')
		{
			par.removeClass().addClass('treemenu_off');
			par.find('.submenu').slideUp(100);
		}else{
			par.removeClass().addClass('treemenu_on');
			par.find('.submenu').slideDown(100);
		}		
	});	

    //顶部菜单点击
    $('#topnav a').live('click', function(){
        var data_id = $(this).attr('data-id');
        //改变样式
        $(this).parent().addClass("on").siblings().removeClass("on");
        //改变左侧
		$.get($('.MenuList').attr('data-uri'), { ik: data_id },
			function(data){
				$('.MenuList').html(data);
				$('#MainIframe').attr('src',$('.MenuList li ul li a').attr('href'));
		});
    });	
	$('.submenu li').live('click',function(){
		$('.submenu li').each(function(i){
			$(this).find('a').removeClass();
		});
		$(this).find('a').removeClass().addClass('submenuB');
	});
	
	//更新缓存
    $('#J_flush_cache').live('click', function(){
        var title = $(this).attr('title'),
            data_uri = $(this).attr('data-uri');
        $.getJSON(data_uri, function(res){
            succ(res.html)
        });
    });
	
});
function refresh() {
	parent.MainIframe.location.reload();
}
</script>
</head>
<body scroll="no" style="margin:0; padding:0;">

<div class="header">
    <div class="logo"><a href="__GROUP__/index/index" >&nbsp;</a></div>
    <div class="nav_sub">
       您好,<?php echo (session('username')); ?> &nbsp; | <a href="__APP__" target="_blank">返回前台</a> | 
       <a href="javascript:void(0);" onclick="refresh();">刷新</a> | 
       <a href="javascript:void(0);" id="J_flush_cache" hidefocus="true" data-uri="__GROUP__/cache/qclear" title="更新缓存">清除缓存</a> | 
       <a href="__GROUP__/public/logout">[退出]</a><br>    
    </div>
    <ul class="nav" id="topnav">	
		<li class="on"><a style="outline:none;" hidefocus="true" data-id="index" href="javascript:;">首页</a></li>
<li><a style="outline:none;" hidefocus="true" data-id="setting" href="javascript:;">全局配置</a></li>
<li><a style="outline:none;" hidefocus="true" data-id="user" href="javascript:;">用户管理</a></li>
<li><a style="outline:none;" hidefocus="true" data-id="apps" href="javascript:;">应用管理</a></li>
<li><a style="outline:none;" hidefocus="true" data-id="oauth" href="javascript:;">第三方管理</a></li>
<?php if(is_array($admin_top_nav)): foreach($admin_top_nav as $key=>$item): ?><li><a style="outline:none;" hidefocus="true" data-id="<?php echo ($item[app_name]); ?>" href="javascript:;"><?php echo ($item[app_alias]); ?>管理</a></li><?php endforeach; endif; ?>

    </ul>                   
</div>
<div class="LeftMenu">
    <div class="menubox">
        <ul id="root_index" class="MenuList" data-uri="__GROUP__/index/left"></ul>
        <div class="cl"></div>
    </div>
                        
</div>

<div class="right_main">
	<div class="header_line"><span>&nbsp;</span></div>
	<iframe width="100%" scrolling="yes" height="100%" frameborder="0" noresize="" src="__GROUP__/index/main" name="MainIframe" id="MainIframe"></iframe>
</div>

</body>
</html>