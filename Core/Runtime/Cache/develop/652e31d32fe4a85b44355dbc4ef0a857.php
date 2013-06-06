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
<script>var siteUrl = '__SITE_URL__',show_login_url='<?php echo U("public/user/ajaxlogin");?>';</script>
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
<div class="midder">
	<div class="mc">
    <h1><?php echo ($seo["title"]); ?></h1>
        <div class="cleft">
            <div id="th-apps">
            	<div class="mod hd">
                    <h2>
                        大家在谈论
                            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
                    </h2>
                    <div class="cate-tab">
                     	<a href="<?php echo U('develop/index/applist');?>" <?php if(($apptype) == "0"): ?>class="on"<?php endif; ?> >最新</a>
						<?php if(is_array($typeList)): foreach($typeList as $key=>$item): if($item[id] == $apptype): ?><a href="<?php echo U('develop/index/applist',array('type'=>$item[id]));?>" class="on"><?php echo ($item[name]); ?></a>
                          <?php else: ?>
                          <a href="<?php echo U('develop/index/applist',array('type'=>$item[id]));?>"><?php echo ($item[name]); ?></a><?php endif; endforeach; endif; ?>
                    </div>
                 </div>
                <div class="bd">
                	<div class="comment-list">
                    		<?php if(is_array($arrApp)): foreach($arrApp as $key=>$item): ?><div data-id="$item[appid]" class="common-item">
                                <div class="pic">
                                  <a href="<?php echo U('develop/index/show',array('id'=>$item[appid]));?>"><img alt="<?php echo ($item[title]); ?>" src="<?php echo ($item[icon_100]); ?>"></a>
                                </div>
                                <span class="digg">
                                	<?php if($visitor[userid] > 0): ?><a title="有用" class="a_digg <?php echo ($item[digged]); ?>"  data-url="<?php echo U('develop/index/vote',array('id'=>$item[appid]));?>" href="javascript:;" onClick="postvote(this)">有用</a>
                                    <?php else: ?>
                                    <a title="有用" class="i a_show_login a_digg"  data-url="<?php echo U('develop/index/vote',array('id'=>$item[appid]));?>" href="javascript:;">有用</a><?php endif; ?>
                                    <span class="counter"><?php echo ($item[count_vote]); ?></span>
                                </span>
                                <div class="info">
                                     	<?php if($item[comment][content]): ?><p><?php echo getsubstrutf8(t($item[comment][content]),0,80) ?></p><?php endif; ?>
                                        <div class="info-ft">
                                            <a href="<?php echo U('develop/index/show',array('id'=>$item[appid]));?>"><?php echo ($item[title]); ?></a> |
                                            <a href="<?php echo U('develop/index/applist',array('type'=>$apptype,'cateid'=>$item[cateid]));?>"><?php echo ($item[cate][catename]); ?></a>,
                                            <?php if($item[comment][content]): echo ($item[comment][user][username]); ?>的短评<?php endif; ?>
                                        </div>
                                 </div>
                            </div><?php endforeach; endif; ?> 
                                               
                    </div>
                    <div class="page"><?php echo ($pageUrl); ?></div>
                </div>
            </div>	
        
        </div><!--//left-->
        <div class="cright">

            <div class="mod" id="th-app-cate">
                <h2>
                    发现更多应用
                        &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
                </h2>
              <div class="sub-mod list cate-list">
                <ul>
                  <li>[分类]</li>
                  <li><a href="/app/android?cat_id=1087">游戏</a></li>
                  <li><a href="/app/android?cat_id=1072">生活</a></li>
                  <li><a href="/app/android?cat_id=1063">工具</a></li>
                  <li><a href="/app/android?cat_id=1065">影音</a></li>
                  <li><a href="/app/android?cat_id=1068">教育</a></li>
                  <li><a href="/app/android?cat_id=1080">社交</a></li>
                  <li><a href="/app/android?cat_id=1083">新闻</a></li>
                  <li><a href="/app/android?cat_id=1067">摄影</a></li>
                  <li><a href="/app/android">(全部)</a></li>
                </ul>
              </div>
            </div>

        	<div class="mod">
                <h2>
                        iOS最近流行的应用
                            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
                </h2>
                <div class="th-app-pop">
                     <ul>
                     <li class="common-item">
                     <div class="pic">
                         <a href="http://www.douban.com/subject/20508491/"><img width="48" src="http://img3.douban.com/spic/s26008770.jpg"></a>
                     </div>
                     <div class="info">
                         <div class="title">
                           <a href="http://www.douban.com/subject/20508491/">豆瓣阅读</a>
                         </div>
                         <div class="favs">433人用过 / 图书</div>
                     </div>
                     </li>
                     </ul>
                </div> 
            </div><!--//mod-->
            
        </div><!--//right-->
    
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