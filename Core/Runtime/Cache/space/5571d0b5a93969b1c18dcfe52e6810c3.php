<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入后前台公共public的模版文件 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($seo["title"]); ?> - <?php echo ($seo["subtitle"]); ?></title>
<meta name="keywords" content="<?php echo ($seo["keywords"]); ?>" /> 
<meta name="description" content="<?php echo ($seo["description"]); ?>" />
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
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21509482"></script>

</head>

<body>
<!--引入后前台公共public的模版文件 -->
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
<!--header-->
<div id="header">
    
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
        
</div>

<div class="midder">

<div class="mc">
<div class="cleft">

<div id="db-usr-profile">
<div class="pic">
<a href="<?php echo U('space/index/index',array('id'=>$strUser[doname]));?>">
<img alt="<?php echo ($strUser[username]); ?>" src="<?php echo ($strUser[face]); ?>">
</a>
</div>
<div class="info">
<h1>
<?php echo ($strUser[username]); ?>
</h1>

<ul>
    <li><a href="<?php echo U('space/notes/index',array('id'=>$strUser[userid]));?>">日记</a></li>
    <li><a href="<?php echo U('space/photos/index',array('id'=>$strUser[userid]));?>">相册</a></li>
    <?php if($strUser[userid] == $visitor[userid]): ?><li><a href="<?php echo U('public/message/ikmail',array('d'=>inbox));?>">站内信</a></li>
    <li><a href="<?php echo U('public/user/setbase');?>">设置</a></li><?php endif; ?>
</ul>

</div>
</div>


<div class="clear"></div>

<div id="recs" class="">
    <h2>
        <?php if($strUser[userid] == $visitor[userid]): ?>我的发布的帖子
        <?php else: ?>
          <?php echo ($strUser[username]); ?>发布的帖子<?php endif; ?>
         &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <!-- <span class="pl">&nbsp;(
                <a href="#">全部</a>
            ) </span> -->
    </h2>

<div class="spacetopic">
    <?php if(!empty($arrMyTopic)): ?><table width="100%">
        <?php if(is_array($arrMyTopic)): foreach($arrMyTopic as $key=>$item): ?><tr>
        <td><img src="__PUBLIC__/images/topic.gif" align="absmiddle"  title="[帖子]" alt="[帖子]" />
        <a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>"><?php echo ($item[title]); ?></a>&nbsp;&nbsp;</td>
        <td><?php if($item[count_comment]): echo ($item[count_comment]); endif; ?></td>
        <td style="width:120px;text-align:right;color:#999999;"><?php echo date('Y-m-d H:i',$item[addtime]) ?></td>
        </tr><?php endforeach; endif; ?>
    </table>
    <?php else: ?>
    <div style="padding:50 0;color:#999999;">这个人很懒，什么也不愿意留下！</div><?php endif; ?>
</div>

<div class="clear"></div>
</div>

<div id="recs" class="">
    <h2> 
        <?php if($strUser[userid] == $visitor[userid]): ?>我回复的帖子
        <?php else: ?>
        <?php echo ($strUser[username]); ?>回复的帖子<?php endif; ?>
         &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
           <!--  <span class="pl">&nbsp;(
                <a href="#">全部</a>
            ) </span> -->
    </h2>

<div class="spacetopic">
    <?php if(!empty($arrMyComment)): ?><table width="100%">
    <?php if(is_array($arrMyComment)): foreach($arrMyComment as $key=>$item): ?><tr>
        <td><img src="__PUBLIC__/images/topic.gif" align="absmiddle"  title="[帖子]" alt="[帖子]" />
        <a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>"><?php echo ($item[title]); ?></a>&nbsp;&nbsp;</td>
        <td><?php if($item[count_comment]): echo ($item[count_comment]); endif; ?></td>
        <td style="width:120px;text-align:right;color:#999999;"><?php echo date('Y-m-d H:i',$item[addtime]) ?></td>
        </tr><?php endforeach; endif; ?>
    </table>
    <?php else: ?>
    <div style="padding:50 0;color:#999999;">这个人很懒，什么也不愿意留下！</div><?php endif; ?>
</div>

<div class="clear"></div>
</div>

<div id="recs" class="">
    <h2>
        <?php if($strUser[userid] == $visitor[userid]): ?>我喜欢的帖子
        <?php else: ?>
        <?php echo ($strUser[username]); ?>喜欢的帖子<?php endif; ?>
         &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <!-- <span class="pl">&nbsp;(
                <a href="#">全部</a>
            ) </span> -->
    </h2>

<div class="spacetopic">
    <?php if(!empty($arrMyCollect)): ?><table width="100%">
    <?php if(is_array($arrMyCollect)): foreach($arrMyCollect as $key=>$item): ?><tr>
        <td><img src="__PUBLIC__/images/topic.gif" align="absmiddle"  title="[帖子]" alt="[帖子]" />
        <a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>"><?php echo ($item[title]); ?></a>&nbsp;&nbsp;</td>
        <td><?php if($item[count_comment]): echo ($item[count_comment]); endif; ?></td>
        <td style="width:120px;text-align:right;color:#999999;"><?php echo date('Y-m-d H:i',$item[addtime]) ?></td>
        </tr><?php endforeach; endif; ?>
    </table>
    <?php else: ?>
    <div style="padding:50 0;color:#999999;">这个人很懒，什么也不愿意留下！</div><?php endif; ?>
</div>


<div id="photo" class="sort">
    <h2>
    <?php if($strUser[userid] == $visitor[userid]): ?>我的相册
        <?php else: ?>
        <?php echo ($strUser[username]); ?>的相册<?php endif; ?>
        &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·<span class="pl">&nbsp;(<a href="<?php echo U('space/photos/index',array('id'=>$strUser[userid]));?>">全部</a>) </span></h2>
    <div class="bd">
    	<?php if(is_array($arrAlbum)): $i = 0; $__LIST__ = $arrAlbum;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="photoin">
            <a title="<?php echo ($vo["albumname"]); ?>" href="<?php echo U('space/photos/album',array('id'=>$vo[albumid]));?>" class="nbg"><img class="album_s" src="<?php echo ($vo["simg"]); ?>" width="100" height="100" alt="<?php echo ($vo["albumname"]); ?>"></a>
            <div class="info pl">
            	<p><a href=""><?php echo ($vo["albumname"]); ?></a></p><?php echo (date("Y-m-d",$vo["uptime"])); ?> 更新
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        
    </div>


</div>


<div class="clear"></div>
</div>



<div class="clear"></div>

</div>

<div class="cright">

<div id="profile">

<div class="infobox">
<div class="ex1"><span></span></div>
<div class="bd">
<img alt="" class="userface" src="<?php echo ($strUser[face_160]); ?>">
<div class="user-info">
常居：&nbsp;<?php echo ($strUser[area][areaname]); ?>
<br />
<div class="pl">UID：<?php echo ($strUser[userid]); ?> <br><?php echo date('Y-m-d',$strUser[addtime]); ?> 加入</div>
<div class="pl">级别：<?php echo ($strUser['rolename']); ?></div>
<div class="pl">积分：<?php echo ($strUser['count_score']); ?></div>

<?php if($strUser[userid] != $visitor[userid]): ?><div class="user-opt">

    <?php if($strUser[isfollow]): ?><div class="user-group" style="display: block;">
        <span class="user-cs">已关注</span>
        <span class="user-rs"><a href="<?php echo U('public/user/unfollow',array('userid'=>$strUser[userid]));?>">取消关注</a></span>
    </div>
    <?php else: ?>
    <a class="a-btn-add mr10 add_contact" href="<?php echo U('public/user/userfollow',array('userid'=>$strUser[userid]));?>">关注此人</a><?php endif; ?>
    <a href="<?php echo U('public/message/write',array('touserid'=>$strUser[userid]));?>" rel="nofollow" class="a-btn mr5">发消息</a>
    <div id="divac"></div>
</div><?php endif; ?>
</div>

<div class="sep-line"></div>
<div class="user-intro">

<div class="j edtext pl" id="edit_intro">
<span id="intro_display">
性别：<?php if($strUser[sex] == 0): ?>保密<?php elseif($strUser[sex] == 1): ?>男<?php else: ?>女<?php endif; ?><br />
<?php if(!empty($strUser[blog])): ?>博客：<?php echo ($strUser[blog]); ?><br /><?php endif; ?>
<?php if(!empty($strUser[about])): ?>关于：<?php echo ($strUser[about]); ?><br /><?php endif; ?>
<?php if(!empty($strUser[signed])): ?>签名：<?php echo ($strUser[signed]); ?><br /><?php endif; ?>

<?php if($strUser[userid] == $visitor[userid]): ?>[<a href="<?php echo U('public/user/setbase');?>">修改基本信息</a>]<?php endif; ?>
</span>
</div>

</div>

</div>
<div class="ex2"><span></span></div>
</div>


</div>
<div class="clear"></div>

<div id="friend">

<h2>
    <?php if($strUser[userid] == $visitor[userid]): ?>我关注的人
    <?php else: ?>
    <?php echo ($strUser[username]); ?>关注的人<?php endif; ?>
    &nbsp;·&nbsp;·&nbsp;·
    <!--<span class="pl">&nbsp;(
    <a href="{U('user','follow',array(userid=>$strUser[userid]))}">全部<?php echo ($strUser[count_follow]); ?></a>
    ) </span>-->
</h2>

<?php if(is_array($strUser[followUser])): foreach($strUser[followUser] as $key=>$item): ?><dl class="obu"><dt><a class="nbg" href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>"><img alt="<?php echo ($item[username]); ?>" class="m_sub_img" src="<?php echo ($item[face]); ?>"></a></dt>
<dd><a href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>"><?php echo ($item[username]); ?></a></dd>
</dl><?php endforeach; endif; ?>

<br clear="all">

<a href="<?php echo U('public/user/followed',array(userid=>$strUser[userid]));?>">&gt; 被<?php echo ($strUser[count_followed]); ?>人关注</a>

</div>

    <div id="group" class="">
    
        <h2>
            <?php if($strUser[userid] == $visitor[userid]): ?>我参加的小组
            <?php else: ?>
            <?php echo ($strUser[username]); ?>参加的小组<?php endif; ?>
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <!--<span class="pl">&nbsp;(
            <a href="<?php echo U('group/mygroups',array('userid'=>$strUser[userid]));?>">全部</a>
            ) </span>
            -->
        </h2>
    
        <?php if(is_array($arrMyGroup)): foreach($arrMyGroup as $key=>$item): ?><dl class="ob"><dt><a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><img alt="<?php echo ($item[groupname]); ?>" class="m_sub_img" src="<?php echo ($item[icon_48]); ?>"></a></dt>
            <dd><a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a> <span>(<?php echo ($item[count_user]); ?>)</span></dd>
            </dl><?php endforeach; endif; ?>
    
        <div class="clear"></div>
    </div>
	<br/>
	<p class="pl">本页永久链接: <a href="__SITE_URL__space/<?php echo ($strUser[doname]); ?>">__SITE_URL__space/<?php echo ($strUser[doname]); ?></a></p>
	<br>
<!--    <p class="pl">订阅<?php echo ($strUser[username]); ?>的收藏 <br>
        <span class="feed"><a href="#"> feed: rss 2.0</a></span>
    </p>
    -->
</div>


</div>
</div>

<!--引入后前台的模版文件 -->
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
        <script src="http://s6.cnzz.com/stat.php?id=5262498&web_id=5262498" language="JavaScript"></script><br />
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
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->

</body>
</html>