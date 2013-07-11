<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入后前台公共public的模版文件 -->
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
    
        <div id="group-info">
            <h1 class="group_tit"><?php echo ($seo["title"]); ?></h1>
            <div class="group-misc">
                    <a href="javascript:;" class="button-join" rel="nofollow" onClick="$('#select-bar').show()">
                        <span>+我要发言</span>
                    </a>
                    <div id="select-bar" style="display:none" onmouseleave="$('#select-bar').hide()">
                    	<h3>选择小组：</h3>
                        <ul>
                        	<?php if($myGroups): if(is_array($myGroups)): foreach($myGroups as $key=>$item): ?><li><a href="<?php echo U('group/index/add',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a></li><?php endforeach; endif; ?>
                             <?php else: ?>
                            <li>你还没有加入任何小组， <a href="<?php echo U('group/index/create');?>">+申请创建小组</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo U('group/index/explore');?>">发现小组&gt;&gt;</a></li><?php endif; ?>
                        </ul>
                    </div>
            </div>
        </div>
            
        <div class="cleft w700">


            <div class="group_topics">
                <table class="olt">
                    <tbody>
            <?php if(!empty($arrTopic)): if(is_array($arrTopic)): foreach($arrTopic as $key=>$item): ?><tr class="pl">
               <td class="td-subject"><a title="<?php echo ($item[title]); ?>" href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>"><?php echo getsubstrutf8(t($item['title']),0,25); ?></a>
                <?php if($item[isvideo] == 1): ?><img src="__PUBLIC__/images/lc_cinema.png" align="absmiddle" title="[视频]" alt="[视频]" /><?php endif; ?>                
                <?php if($item[istop] == 1): ?><img src="__PUBLIC__/images/headtopic_1.gif" title="[置顶]" alt="[置顶]" /><?php endif; ?>
                <?php if($item[addtime] > (strtotime(date('Y-m-d 00:00:00')))): ?><img src="__PUBLIC__/images/topic_new.gif" align="absmiddle"  title="[新帖]" alt="[新帖]" /><?php endif; ?> 
                <?php if($item[isphoto] == 1): ?><img src="__PUBLIC__/images/image_s.gif" title="[图片]" alt="[图片]" align="absmiddle" /><?php endif; ?> 
                <?php if($item[isattach] == 1): ?><img src="__PUBLIC__/images/attach.gif" title="[附件]" alt="[附件]" /><?php endif; ?> 
                <?php if($item[isdigest] == 1): ?><img src="__PUBLIC__/images/posts.gif" title="[精华]" alt="[精华]" /><?php endif; ?>
                </td>
                <td class="td-reply" nowrap="nowrap"><?php if($item[count_comment] > 0): echo ($item[count_comment]); ?> 回应<?php endif; ?></td>
                <td class="td-time" nowrap="nowrap"><?php echo getTime($item[uptime],time()); ?></td>
                <td align="right"><a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo getsubstrutf8(t($item[group][groupname]),0,10); ?></a></td>
                </tr><?php endforeach; endif; endif; ?>         
                </tbody>
              </table>
            </div>
            
             
            
            <div class="clear"></div>
    
    
    	</div>
    
        <div class="cright w250" id="cright">   
              
			<div class="mod" id="g-user-profile">

    <div class="usercard">
      <div class="pic">
            <a href="<?php echo U('space/index/index',array('id'=>$strUser[doname]));?>"><img alt="<?php echo ($strUser[username]); ?>" src="<?php echo ($strUser[face]); ?>"></a>
      </div>
      <div class="info">
           <div class="name">
               <a href="<?php echo U('space/index/index',array('id'=>$strUser[doname]));?>"><?php echo ($strUser[username]); ?></a>
           </div>
                <?php if($strUser[area] != ''): echo ($strUser[area][areaname]); else: ?>火星<?php endif; ?>                        
                 <br>
       </div>
    </div>
               
    <div class="group-nav">
     <ul>
		<?php if($action_name == 'my_group_topics'): ?><li class="on"><a href="<?php echo U('group/index/my_group_topics');?>">我的小组话题</a></li>
		<?php else: ?>
		<li class=""><a href="<?php echo U('group/index/my_group_topics');?>">我的小组话题</a></li><?php endif; ?>
        
		<?php if($action_name == 'my_topics'): ?><li class="on"><a href="<?php echo U('group/index/my_topics');?>">我发起的话题</a></li>
		<?php else: ?>
		<li class=""><a href="<?php echo U('group/index/my_topics');?>">我发起的话题</a></li><?php endif; ?>
        		
		<?php if($action_name == 'my_replied_topics'): ?><li class="on"><a href="<?php echo U('group/index/my_replied_topics');?>">我回应的话题</a></li>
		<?php else: ?>
		<li class=""><a href="<?php echo U('group/index/my_replied_topics');?>">我回应的话题</a></li><?php endif; ?>
		
		<?php if($action_name == 'my_collect_topics'): ?><li class="on"><a href="<?php echo U('group/index/my_collect_topics');?>">我喜欢的话题</a></li>
		<?php else: ?>
		<li class=""><a href="<?php echo U('group/index/my_collect_topics');?>">我喜欢的话题</a></li><?php endif; ?>
		
		<?php if($action_name == 'mine'): ?><li class="on"><a href="<?php echo U('group/index/mine');?>">我管理/加入的小组</a></li>
		<?php else: ?>
		<li class=""><a href="<?php echo U('group/index/mine');?>">我管理/加入的小组</a></li><?php endif; ?>
     </ul>
    </div>
             
</div> 
         
<div class="mod">
<?php if($visitor): ?><div class="create-group">
<a href="<?php echo U('group/index/create');?>"><i>+</i>申请创建小组</a>
</div><?php endif; ?>
</div>                 
        
        </div>
    
    </div><!--//mc-->


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