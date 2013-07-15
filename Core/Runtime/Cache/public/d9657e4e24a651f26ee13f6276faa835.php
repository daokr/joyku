<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($seo["title"]); ?>_<?php echo ($seo["subtitle"]); ?></title>
<?php if(!empty($seo["keywords"])): ?><meta name="keywords" content="<?php echo ($seo["keywords"]); ?>" /><?php endif; ?>
<?php if(!empty($seo["description"])): ?><meta name="description" content="<?php echo ($seo["description"]); ?>" /><?php endif; ?>
<meta property="qc:admins" content="12472730776130006375" />
<link rel="shortcut icon" href="__PUBLIC__/images/fav.ico" type="image/x-icon">
__SITE_THEME_CSS__
<!--[if gte IE 7]><!-->
    <link href="__PUBLIC__/js/dialog/skins5/idialog.css" rel="stylesheet" />
<!--<![endif]-->
<!--[if lt IE 7]>
    <link href="__PUBLIC__/js/dialog/skins5/idialog.css" rel="stylesheet" />
<![endif]-->
<script>var siteUrl = '__SITE_URL__',show_login_url='<?php echo U("public/user/ajaxlogin");?>',show_register_url='<?php echo U("public/user/ajaxregister");?>';</script>
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
</head>

<body>
<!--头部开始-->
<header>
<?php if($app_name == 'public' && empty($visitor) && $module_name == 'index'): ?><div class="hd-wrap">
            <div class="hd" id="anony-nav">
                <div class="logo">
                    <h1><a href="__SITE_URL__" title="爱客开源">爱客开源</a></h1>
                </div>
                <div class="anony-srh">
                <form onsubmit="return searchForm(this);" method="post" action="<?php echo U('public/search/index');?>">
                <span class="inp"><input type="text" autocomplete="off" placeholder="书籍、电影、音乐、小组、小站、成员" size="12" maxlength="60" class="key" name="q"></span>
                <span class="bn"><input type="submit" value="搜索"></span>
                </form>
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
             <li><a href="<?php echo U('develop/index/index');?>">应用商店</a></li>
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
<div class="midder">
	<div class="mc">
		<div id="search_menubar">
        	<div class="s_menu">
    <?php if(is_array($menu)): foreach($menu as $key=>$item): if($type == $key): ?><a class="s_select" href="<?php echo ($item[url]); ?>"><?php echo ($item[text]); ?></a>
        <?php else: ?>
        <a href="<?php echo ($item[url]); ?>"><?php echo ($item[text]); ?></a><?php endif; endforeach; endif; ?>
</div>

<div class="mod-search">
  <form method="POST" action="<?php echo U('public/search/index',array('type'=>$type));?>">
    <fieldset>
      <legend>搜索：</legend>
      <div class="inp"><input name="q" value="<?php echo ($kw); ?>" maxlength="60" size="22" ></div>
      <div class="inp-btn"><input type="submit" value="搜索"></div>
    </fieldset>
  </form>
</div>
        </div>
 		<div class="s_top">获得约 <?php echo ($total); ?> 条结果</div>

<?php if(is_array($arrGroup)): foreach($arrGroup as $key=>$item): ?><div class="result">
    <div class="pic">
    <a title="<?php echo ($item[groupname]); ?>" href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>" class="nbg"><img alt="<?php echo ($item[groupname]); ?>" src="<?php echo ($item[icon_48]); ?>" width="48" /></a>
    </div>
    <div class="content">
    <h3><span>[小组] </span>&nbsp;<a  href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a></h3>
    <div class="info">创建于 <?php echo date('Y-m-d',$item[addtime]) ?> &nbsp; <?php echo ($item[count_user]); ?> 成员</div>
    <p><?php echo ($item[groupdesc]); ?></p>
    </div>
    </div><?php endforeach; endif; ?>  
<?php if(is_array($arrTopic)): foreach($arrTopic as $key=>$item): ?><div class="result">
    <div class="pic">
    <a title="<?php echo ($item[user][username]); ?>" href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>" class="nbg"><img alt="<?php echo ($item[user][username]); ?>" src="<?php echo ($item[user][face]); ?>" width="48" /></a>
    </div>
    <div class="content">
    <h3><span>[话题] </span>&nbsp;<a  href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>"><?php echo ($item[title]); ?></a></h3>
    <div class="info">小组：<a href="<?php echo U('group/index/show',array('id'=>$item[group][groupid]));?>"><?php echo ($item[group][groupname]); ?></a> 发表于 <?php echo date('Y-m-d',$item[addtime]); ?> &nbsp; <a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>#comment"><?php echo ($item[count_comment]); ?> 回复</a></div>
    <p><?php echo ($item[content]); ?></p>
    </div>
    </div><?php endforeach; endif; ?> 
<?php if(is_array($arrUser)): foreach($arrUser as $key=>$item): ?><div class="result">
    <div class="pic">
    <a title="<?php echo ($item[username]); ?>" href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>" class="nbg"><img alt="<?php echo ($item[username]); ?>" src="<?php echo ($item[face]); ?>" width="48" /></a>
    </div>
    <div class="content">
    <h3><span>[用户] </span>&nbsp;<a  href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>"><?php echo ($item[username]); ?></a></h3>
    <div class="info"><?php echo date('Y-m-d',$item[addtime]); ?> 加入&nbsp; <a href="<?php echo U('public/user/followed',array('userid'=>$item[userid]));?>"><?php echo ($item[count_followed]); ?> 人关注</a></div>
    <p><?php echo ($item[signed]); ?></p>
    </div>
    </div><?php endforeach; endif; ?> 
      
		<div class="page"><?php echo ($pageUrl); ?></div>		
	</div>
</div>
<!--footer-->
<?php if(empty($$visitor)): ?><div id="g-popup-reg" class="popup-reg" style="display:none;"><div class="bd"><iframe src="about:blank" frameborder="0" scrolling="no"></iframe><a href="javascript:;" class="lnk-close">&times;</a></div></div><?php endif; ?>
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
        <font color="green">ThinkPHP版本<?php echo (THINK_VERSION); ?></font>  目前有 <?php echo ($count_online_user); ?> 人在线 
        <!--<script src="http://s6.cnzz.com/stat.php?id=5262498&web_id=5262498" language="JavaScript"></script><br />-->
        <span style="font-size:0.83em;">{__RUNTIME__}          </span>

        
       
        </p>   
    </div>
</div>
</footer>
<div id="styleBox"><a href="<?php echo U('public/index/style');?>">风格设置</a></div>
<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=1&amp;pos=right&amp;uid=0" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
//document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->
</body>
</html>