<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入后前台公共public的模版文件 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($seo["title"]); ?> - <?php echo ($seo["subtitle"]); ?></title>
<?php if($module_name == 'index' && $app_name == 'public'): ?><meta name="keywords" content="<?php echo ($seo["keywords"]); ?>" /> 
<meta name="description" content="<?php echo ($seo["description"]); ?>" /><?php endif; ?>
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
<div class="mod ui-slides" id="db-events-guess">
  <div class="hd">
    <h2>热门活动</h2>
      
  <div class="ui-slide-control" id="ui-control">
    <span class="ui-slide-counter pl">1/4</span>
    <a href="javascript:void(0)" class="btn-prev"></a>
    <a href="javascript:void(0)" class="btn-next"></a>
  </div>
  

  </div>
  <div class="bd ui-slide-screen">
    <ul class="ui-slide-contents gallery" id="ui-ul">  
		<?php if(is_array($hotEvent)): foreach($hotEvent as $key=>$item): ?><li>
          <div class="pic">
            <a tabindex="-1"  href="<?php echo U('location/event/show',array('id'=>$item[eventid]));?>">
            <img alt="<?php echo ($item[title]); ?>" src="<?php echo ($item[midimg]); ?>" height="165" width="120">
            </a>
          </div>
          <div class="title">
              <a href="<?php echo U('location/event/show',array('id'=>$item[eventid]));?>" title="<?php echo ($item[title]); ?>"><?php echo ($item[title]); ?></a>
          </div>
        </li><?php endforeach; endif; ?> 
     
    </ul>
  </div>
</div>

<!--cate-->
<div class="mod cats-board inline-list">
  <ul>
      <?php if(is_array($arrCateList)): foreach($arrCateList as $key=>$item): if($item[childCate]): ?><li class="entry">
        <h5>
          <a href="<?php echo U('location/event/lists',array('type'=>'week-'.$item[parentCate][enname]));?>"><?php echo ($item[parentCate][catename]); ?>&gt;&gt;</a>
        </h5>
        <ul>
            <?php if(is_array($item[childCate])): foreach($item[childCate] as $ckey=>$citem): ?><li>
                <a href="<?php echo U('location/event/lists',array('type'=>'week-'.$citem[cateid]));?>"><?php echo ($citem[catename]); ?></a>
                </li><?php endforeach; endif; ?>
        </ul>
      </li><?php endif; endforeach; endif; ?>
  </ul>
</div>

<div class="mod">
<script type="text/javascript">
     document.write('<a style="display:none!important" id="tanx-a-mm_11053146_4018392_13072168"></a>');
     tanx_s = document.createElement("script");
     tanx_s.type = "text/javascript";
     tanx_s.charset = "gbk";
     tanx_s.id = "tanx-s-mm_11053146_4018392_13072168";
     tanx_s.async = true;
     tanx_s.src = "http://p.tanx.com/ex?i=mm_11053146_4018392_13072168";
     tanx_h = document.getElementsByTagName("head")[0];
     if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
</script>
</div>

<div class="mod event-mod">
      <h2>
        <span class="pl fr">
          <a href="#">更多</a>
        </span>
        音乐
      </h2>
      <div class="bd">

     <ul class="events-list events-list-2col">
     
<?php if(is_array($hotEvent)): foreach($hotEvent as $key=>$item): ?><li class="list-entry">
      <div class="pic">
        <a tabindex="-1" href="<?php echo U('location/event/show',array('id'=>$item[eventid]));?>">
          <img alt="<?php echo ($item[title]); ?>" data-lazy="<?php echo ($item[smallimg]); ?>" src="__PUBLIC__/images/blank.gif" width="70">
        </a>
      </div>
      <div class="info">
        <div class="title">
          <a href="<?php echo U('location/location/event/show',array('id'=>$item[eventid]));?>" title="<?php echo ($item[title]); ?>">
          <?php echo ($item[title]); ?>
          </a>
        </div>
        <div class="datetime">
        	<span class="month"><?php echo date('m月',$item[begin_date]); ?></span>
            <span class="day"><?php echo date('d日',$item[begin_date]); ?> <?php echo ($item[begin_week_day]); ?></span>&nbsp;
            <span class="time"><?php echo ($item[begin_time]); ?> - <?php echo ($item[end_time]); ?></span>
        </div>
        <address title="<?php echo ($item[city]); ?> <?php echo ($item[district]); ?> <?php echo ($item[street_address]); ?>">
          <?php echo ($item[street_address]); ?>
        </address>
        <div>0人关注</div>
      </div>
      </li><?php endforeach; endif; ?>      
        
     </ul>

      </div>
    </div>







        
        </div><!--//left-->
        <div class="cright">
<div class="mod">  			
<script type="text/javascript">
     document.write('<a style="display:none!important" id="tanx-a-mm_11053146_4018392_13062841"></a>');
     tanx_s = document.createElement("script");
     tanx_s.type = "text/javascript";
     tanx_s.charset = "gbk";
     tanx_s.id = "tanx-s-mm_11053146_4018392_13062841";
     tanx_s.async = true;
     tanx_s.src = "http://p.tanx.com/ex?i=mm_11053146_4018392_13062841";
     tanx_h = document.getElementsByTagName("head")[0];
     if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
</script>
</div>

<div class="mod">  
<a href="<?php echo U('location/event/create',array('loc'=>'beijing'));?>" rel="nofollow" class="bn-big-action">
  ＋发起同城活动     
</a>     
</div>
            
<div class="mod event-mod">
  <h2>
    官方预售
    <span class="pl fr">
      <a href="#" title="北京的全部售票活动">
        更多》
      </a>
    </span>
  </h2>
    <ul class="simple-list-1col">
        
        <li class="list-entry">
        <a  href="#" class="ll"><img width="48" src="__PUBLIC__/images/defimg.gif" alt="情歌之巅&mdash;&mdash;胡里奥Julio lglesias中国巡回演唱会北京站"></a>
        <div class="info">
          <p class="event-title">
              <a onclick="moreurl(this, {from:'loc-event-ticket-108288-0-title'})" href="#">
              情歌之巅&mdash;&mdash;胡里奥Julio lglesias中国巡回演唱会北京站
            </a>
          </p>
          <p class="tip">
            04月21日 19:30-21:30<br>
            
            <span class="on-selling-events-price">¥ 380</span>
          </p>
        </div>
        </li>
        
    </ul>
</div>            
  

<!--主办方-->
<div class="mod event-mod">
    <h2>
      <span class="pl fr">
        <a href="#">更多》</a>
      </span>
      北京活跃的主办方
    </h2>
    
<ul class="simple-list-1col">
    <li class="list-entry">
    <a href="#" class="ll" target="db-host"><img width="48" height="48" src="__PUBLIC__/images/defimg.gif" alt="北京中山公园音乐堂"></a>
    <div class="info">
      <p class="title"><a href="#" target="db-host">北京中山公园音乐堂</a></p>
      <p class="tip">
      
      有<a href="#" target="db-host">18个活动</a>正在进行
      </p>
      <ul>
          <li>
          <a title="威尔第歌剧的光辉&mdash;女高音歌唱家李国玲和她的朋友们" href="#" class="gloomy">[音乐] 威尔第歌剧的光辉&mdash;女高音歌唱家...</a>
          </li>
          <li>
          <a title="浪漫竖琴之夜-俄罗斯竖琴家艾米丽亚·莫斯克维金娜独奏音乐会" href="#" class="gloomy">[音乐] 浪漫竖琴之夜-俄罗斯竖琴家艾米丽...</a>
          </li>
      </ul>
    </div>
    </li>
    
</ul>

  </div>
 

<div class="mod">
  <h2>更多发现</h2>
  <ul class="inline-list linkgrid">
  	<li>
    <a class="no-hover no-visited" href="#">
      <strong>
      同城活动小组
      </strong>
      <span class="info">
      发现玩活动的圈子
      </span>
    </a>
  	</li>
  	<li>
    <a  class="no-hover no-visited" href="#" style="border-left:none">
      <strong>
      主办方系列活动
      </strong>
      <span class="info">
      主办方的主题活动
      </span>
    </a>
  	</li>
  </ul>
</div>

<div class="mod">
<p style="font-size:14px;" class="pl">
<a href="#" class="lnk-rss" target="_blank">RSS</a>
&nbsp;
&nbsp;
&gt; <a href="#">申请主办方</a>
&nbsp;
&nbsp;
&gt; <a href="#">我要提建议</a>
</p>
</div>
  
        
        </div><!--//right-->
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