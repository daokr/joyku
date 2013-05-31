<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入后前台公共public的模版文件 -->
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

</head>

<body>
<!--引入后前台公共public的模版文件 -->
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
<!--main-->
<div class="midder">

<div class="mc">
<div id="group-info">
	<img align="left" alt="<?php echo ($strGroup[groupname]); ?>" src="<?php echo ($strGroup[icon_48]); ?>" class="pil mr10 groupicon"/>
    <h1 class="group_tit"><?php echo ($strGroup[groupname]); if($strGroup[isaudit] == 1): ?><font class="red">[审核中]</font><?php endif; ?></h1>

    <div class="group-misc">
    <?php if($isGroupUser && ($strGroup[userid]!=$visitor[userid])): ?><span class="fleft mr5 color-gray">我是这个小组的<?php echo ($strGroup['role_user']); ?> <a class="j a_confirm_link" href="<?php echo U('group/index/quit',array('id'=>$strGroup['groupid']));?>" style="margin-left: 6px;">&gt;退出小组</a></span>
    
    <?php elseif($isGroupUser && ($strGroup[userid]==$visitor[userid])): ?>
    
    <span class="fleft mr5 color-gray">我是这个小组的<?php echo ($strGroup['role_leader']); ?></span><?php endif; ?>
    <?php if($strGroup[joinway] == 0 && !$isGroupUser): ?><a rel="nofollow" class="button-join" href="<?php echo U('group/index/join',array('id'=>$strGroup['groupid']));?>">
                    <span>加入小组</span>
                </a><?php endif; ?>
	<?php if($strGroup[joinway] != 0): ?><span>本小组禁止加入</span><?php endif; ?>
	</div>
    
</div>

<div class="cleft">
<div class="infobox">

<div class="bd">
    <p>创建于<?php echo date('Y-m-d',$strGroup[addtime]) ?>&nbsp; &nbsp; <?php echo ($strGroup[role_leader]); ?>：<a href="<?php echo U('space/index/index',array('id'=>$strLeader[doname]));?>"><?php echo ($strLeader[username]); ?></a></p>
    <?php echo nl2br($strGroup[groupdesc]); ?>
</div>

</div>

<div class="box">

<div class="box_content">

    <h2 style="margin-top:10px">
                <a class="rr bn-post" href="<?php echo U('group/index/add',array('id'=>$strGroup[groupid]));?>"><span>+发言</span></a>
        最近小组话题  · · · · · ·
    </h2>

<div class="clear"></div>

            <div class="indent">
                <table class="olt">
                    <tbody>
                        <tr>
                            <td>话题</td>
                            <td nowrap="nowrap">作者</td>
                            <td nowrap="nowrap">回应</td>
                            <td align="right" nowrap="nowrap">最后回应</td>
                        </tr>
            <?php if(!empty($arrTopic)): if(is_array($arrTopic)): foreach($arrTopic as $key=>$item): ?><tr class="pl">
                                <td class="td-title">
                                <a title="<?php echo ($item[title]); ?>" href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>">
                                <?php echo getsubstrutf8(t($item['title']),0,25); ?>
                                </a>
                                <?php if($item[isvideo] == 1): ?><img src="__PUBLIC__/images/lc_cinema.png" align="absmiddle" title="[视频]" alt="[视频]" /><?php endif; ?>                
                                <?php if($item[istop] == 1): ?><img src="__PUBLIC__/images/headtopic_1.gif" title="[置顶]" alt="[置顶]" /><?php endif; ?>
                                <?php if($item[addtime] > (strtotime(date('Y-m-d 00:00:00')))): ?><img src="__PUBLIC__/images/topic_new.gif" align="absmiddle"  title="[新帖]" alt="[新帖]" /><?php endif; ?> 
                                <?php if($item[isphoto] == 1): ?><img src="__PUBLIC__/images/image_s.gif" title="[图片]" alt="[图片]" align="absmiddle" /><?php endif; ?> 
                                <?php if($item[isattach] == 1): ?><img src="__PUBLIC__/images/attach.gif" title="[附件]" alt="[附件]" /><?php endif; ?> 
                                <?php if($item[isdigest] == 1): ?><img src="__PUBLIC__/images/posts.gif" title="[精华]" alt="[精华]" /><?php endif; ?>
            					</td>
                                <td nowrap="nowrap"><a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><?php echo ($item[user][username]); ?></a></td>
                                <td nowrap="nowrap" ><?php if($item[count_comment]): echo ($item[count_comment]); endif; ?></td>
                                <td nowrap="nowrap" class="time" align="right"><?php echo getTime($item[uptime],time()) ?></td>
                            </tr><?php endforeach; endif; endif; ?>         
                </tbody>
              </table>
            </div>

	<div class="clear"></div>
	<div class="page"><?php echo ($pageUrl); ?></div>

</div>
</div>

</div>


<div class="cright">
    <div>
        <h2>最新加入成员</h2>
        <?php if(is_array($arrGroupUser)): foreach($arrGroupUser as $key=>$item): ?><dl class="obu">
            <dt>
            <a href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>"><img alt="<?php echo ($item[username]); ?>" class="m_sub_img" src="<?php echo ($item[face]); ?>" /></a>
            </dt>
            <dd><?php echo ($item[username]); ?><br>
                <span class="pl">(<a href="<?php echo U('location/area',array(areaid=>$item[area][areaid]));?>"><?php echo ($item[area][areaname]); ?></a>)</span>
            </dd>
     	 </dl><?php endforeach; endif; ?>
    
        <br clear="all">
    
        <?php if($visitor[userid] == $strGroup[userid]): ?><p class="pl2">&gt; <a href="<?php echo U('group/index/group_user',array(groupid=>$strGroup[groupid]));?>">成员管理 (<?php echo ($strGroup[count_user]); ?>)</a></p>
            
            <p class="pl2">&gt; <a href="<?php echo U('group/index/edit',array(d=>base,groupid=>$strGroup[groupid]));?>">修改小组设置 </a></p>
            
            <?php else: ?>
            
            <p class="pl2"><a href="<?php echo U('group/index/group_user',array(groupid=>$strGroup[groupid]));?>">浏览所有成员 (<?php echo ($strGroup[count_user]); ?>)</a></p><?php endif; ?>
        
       <div class="clear"></div>

        
    </div>
    
	<p class="pl">本页永久链接: <a href="http://www.ikphp.com<?php echo U('group/index/show',array(id=>$strGroup[groupid]));?>">http://www.ikphp.com<?php echo U('group/index/show',array(id=>$strGroup[groupid]));?></a></p>
    
    <p class="pl"><span class="feed"><a href="<?php echo U('group/index/rss',array(id=>$strGroup[groupid]));?>">feed: rss 2.0</a></span></p>
    
    <div class="clear"></div>
    
</div>
</div>
</div>
<!--引入后前台的模版文件 -->
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