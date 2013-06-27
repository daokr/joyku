<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
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
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21509482"></script>
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

<?php if(empty($visitor[userid])): ?><div id="anony-reg">
      <div class="wrapper">
            <div class="login">
                <form action="<?php echo U('public/user/login');?>" method="post" name="lzform" id="lzform">
                    <fieldset>
                        <legend>登录</legend>
                        <div class="item item-account">
                            <input type="email" tabindex="1" placeholder="邮箱" class="inp" value="" id="form_email" name="email">
                            <div class="opt"><label for="form_remember"><input type="checkbox" tabindex="4" id="form_remember" name="remember"> 记住我</label> <a href="<?php echo U('public/user/forgetpwd');?>">忘记密码</a></div>
                        </div>
                        <div class="item item-passwd">
                            <input type="password" tabindex="2" class="inp" id="form_password" placeholder="密码" name="password">
                            <div class="opt"><a style="margin-left:10px; margin-right:10px" target="_blank" href="<?php echo U('public/oauth/index', array('mod'=>'qq'));?>"><img align="absmiddle" src="__PUBLIC__/images/connect_qq.png" title="QQ登录"> 登录</a> | <a style="margin-left:10px" target="_blank" href="<?php echo U('public/oauth/index', array('mod'=>'sina'));?>"><img align="absmiddle" src="__PUBLIC__/images/connect_sina_weibo.png" title="新浪微博"> 登录</a></div>
                        </div>
                        <div class="item-submit">
                            <input type="submit" tabindex="4" class="bn-submit" value="登录">
                        </div>
                    </fieldset>
                </form>
            </div>
      
            <div class="reg">
            	<a class="lnk-reg" href="<?php echo U('public/user/register');?>">加入我们 <i>注册</i></a>
            	<div class="nb-info">
            <b>爱客网开源社区程序，内容互动性强，交流更方便</b><br><em>简单</em><em>快捷</em><em>方便</em><em>建设本地化，垂直型社区；目前已有<cite><?php echo ($count_user); ?></cite>位用户加入！</em>
            	</div>
            </div>
      </div>
    </div><?php endif; ?>
    

<div id="anony-sns" class="section">
  <div class="wrapper">
        <div class="side">
            <h2>
                推荐阅读
                    &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
                    <span class="pl">&nbsp;(
                            <a href="<?php echo U('article/index/index');?>">更多</a>
                        ) </span>
            </h2>
        
          <div class="online">
            <ul>
                <li>
                    <div class="title">
                        <a href="http://www.douban.com/online/11560903/">【谁是豆瓣气场女王&amp;豆瓣气场男神】贴照片，晒气场（本活动赠Kindle哦）</a>
                    </div>
                    <div class="desc">
                        时间：6月19日 - 9月18日
                        <br><span class="num">3494人参加</span>
                    </div>
                </li>
        
            </ul>
          </div>
          
        </div><!--//end side-->
        <div class="main">
            <div class="mod">
                <h2>
                    热点内容&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
                </h2>
            
              <div class="albums">
                <ul>
                  <?php if(is_array($arrHotArticle)): foreach($arrHotArticle as $key=>$item): ?><li>
                    <div class="pic">
                    <a href="<?php echo U('article/index/show',array('id'=>$item[aid]));?>"><img src="<?php echo ($item[photo][simg]); ?>" data-origin="" alt=""></a>
                    </div>
                    <a href="<?php echo U('article/index/show',array('id'=>$item[aid]));?>"><?php echo ($item[title]); ?></a>
                    <span class="num">浏览 <?php echo ($item[count_view]); ?> </span>
                  </li><?php endforeach; endif; ?>
                </ul>
              </div>
              <div class="notes">
                <ul>
                
                  <li class="first">
                    <div class="title">
                    <a href="http://site.douban.com/205387/widget/notes/12693315/note/282679835/">美国最贵待售豪宅：1.9亿美元</a>
                    </div>
                    <div class="author">
                    住宅的日记
                    </div>
                    <p>这座法国文艺复兴风格的豪宅位于康涅狄格州，占地逾20公顷，带两个离岸小岛，...</p>
                  </li>
                  <li><a href="http://www.douban.com/note/281973039/">原创教程：薰豆梨肉玛德莲蛋糕（步骤图+食谱）</a></li>
            
                </ul>
              </div>
              
            </div>
        </div><!--//end main-->
        
  </div><!--//end wrapper-->
</div><!--//end anony-sns-->

<div id="anony-group" class="section">
  <div class="wrapper">
  
<div class="sidenav">

  <h2 class="section-title"><a href="<?php echo U('group/index');?>">小组</a></h2>
  <div class="side-links nav-anon">
      <ul>             
           <li><a href="<?php echo U('group/index/explore');?>">发现小组</a></li>
      </ul>
  </div>
  
</div>

  <div class="side">
<div class="mod">

    <h2>
        小组分类
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
    </h2>

   <div class="cate group-cate">
       <ul>
           <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'兴趣'));?>">兴趣» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'旅行'));?>">旅行</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'摄影'));?>">摄影</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'影视'));?>">影视</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'音乐'));?>">音乐</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'文学'));?>">文学</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'游戏'));?>">游戏</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'动漫'));?>">动漫</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'运动'));?>">运动</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'戏曲'));?>">戏曲</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'桌游'));?>">桌游</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'怪癖'));?>">怪癖</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
       <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'购物'));?>">购物» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'淘宝'));?>">淘宝</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'二手'));?>">二手</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'团购'));?>">团购</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'数码'));?>">数码</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'品牌'));?>">品牌</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'文具'));?>">文具</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
       <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'生活'));?>">生活» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'健康'));?>">健康</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'美食'));?>">美食</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'宠物'));?>">宠物</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'美容'));?>">美容</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'化妆'));?>">化妆</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'护肤'));?>">护肤</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'服饰'));?>">服饰</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'公益'));?>">公益</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'家庭'));?>">家庭</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'育儿'));?>">育儿</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'汽车'));?>">汽车</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
        <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'社会'));?>">社会» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'求职'));?>">求职</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'租房'));?>">租房</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'励志'));?>">励志</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'留学'));?>">留学</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'出国'));?>">出国</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'理财'));?>">理财</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'传媒'));?>">传媒</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'创业'));?>">创业</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'考试'));?>">考试</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
           <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'艺术'));?>">艺术» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'设计'));?>">设计</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'手工'));?>">手工</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'展览'));?>">展览</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'曲艺'));?>">曲艺</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'舞蹈'));?>">舞蹈</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'雕塑'));?>">雕塑</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'纹身'));?>">纹身</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
       <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'学术'));?>">学术» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'人文'));?>">人文</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'社科'));?>">社科</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'自然'));?>">自然</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'建筑'));?>">建筑</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'国学'));?>">国学</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'语言'));?>">语言</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'宗教'));?>">宗教</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'哲学'));?>">哲学</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'软件'));?>">软件</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'硬件'));?>">硬件</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'互联网'));?>">互联网</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
       <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'情感'));?>">情感» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'恋爱'));?>">恋爱</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'心情'));?>">心情</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'心理学'));?>">心理学</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'星座'));?>">星座</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'塔罗'));?>">塔罗</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'LES'));?>">LES</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'GAY'));?>">GAY</a></li>
       </ul>
    </div>
   <div class="cate group-cate">
       <ul>
       <li class="cate-label"><a href="<?php echo U('group/index/explore',array('tag'=>'闲聊'));?>">闲聊» </a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'吐槽'));?>">吐槽</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'笑话'));?>">笑话</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'直播'));?>">直播</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'八卦'));?>">八卦</a></li>
       <li><a href="<?php echo U('group/index/explore',array('tag'=>'发泄'));?>">发泄</a></li>
       </ul>
    </div>
</div>
</div>
  <div class="main">


    <h2>
        推荐小组
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <span class="pl">&nbsp;(
                    <a href="<?php echo U(group/index/explore);?>">更多</a>
                ) </span>
    </h2>

<div class="group-list list">
  <ul>
 <?php if(is_array($arrRecommendGroup)): foreach($arrRecommendGroup as $key=>$item): ?><li>
    <div class="pic">
        <a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>">
            <img src="<?php echo ($item[icon_48]); ?>" alt="<?php echo ($item[groupname]); ?>" width="48" height="48">
         </a>
    </div>
    <div class="info">
      <div class="title">
        <a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a>
      </div>
      <?php echo ($item[count_user]); ?> 个成员        
    </div>
    </li><?php endforeach; endif; ?>    
    
  </ul>
</div>
</div>
  </div>
  
</div>


<!--同城-->
<div id="anony-events" class="section">
  <div class="wrapper">
  
<div class="sidenav">
  <h2 class="section-title"><a href="<?php echo U('location/index/index');?>">同城</a></h2>
  
  
  <div class="side-links nav-anon">
      <ul>
            <li>
                <a href="http://beijing.douban.com/events">同城活动</a>
            </li>
      </ul>
  </div>

</div>

<div class="side">

    <div class="mod">
    
        <h2>
            活动标签
                &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
        </h2>
    
        <div class="cate events-cate">
          <ul>
          <li class="cate-label"><a href="http://www.douban.com/location/beijing/events/week-music">音乐»</a></li>
            <li><a href="http://www.douban.com/location/beijing/events/week-1001">小型现场</a></li>
            <li><a href="http://www.douban.com/location/beijing/events/week-1002">音乐会</a></li>
            <li><a href="http://www.douban.com/location/beijing/events/week-1003">演唱会</a></li>
            <li><a href="http://www.douban.com/location/beijing/events/week-1004">音乐节</a></li>
          </ul>
        </div>
    
    </div>
</div>
  <div class="main">


    <h2>
        北京 · 本周热门活动
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <span class="pl">&nbsp;(
                    <a href="<?php echo U('location/event/lists');?>">更多</a>
                ) </span>
    </h2>

<div class="events-list list">
  <ul>
  
    <li>
      <div class="pic">
        <a href="http://www.douban.com/event/18858870/">
            <img data-origin="http://img3.douban.com/pview/event_poster/small/public/22d1cacc783f39c.jpg" src="http://www.ikphp.com/data/upload/event/poster/2013/0626/18/c4ca4238a0b923820dcc509a6f75849b_200_300.jpg?v=1372322797" width="70">
        </a>
      </div>
      <div class="info">
        <div class="title">
          <a href="http://www.douban.com/event/18858870/" title="2013何韵诗北京演唱会">
            2013何韵诗北京演唱会
          </a>
        </div>
        <div class="datetime">
            7月6日 周六 19:30 - 22:00
        </div>
        <address title="奥体中心体育馆">
          奥体中心体育馆
        </address>
        <div class="follow">
          213人关注
        </div>
      </div>
    </li>
    
    
  </ul>
</div>
</div>
  </div>
  
</div>

<!--爱客商城-->
<div id="anony-mall" class="section">
  <div class="wrapper">
  
<div class="sidenav">
  <h2 class="section-title"><a href="<?php echo U('mall/index/index');?>">淘客</a></h2>
  
  
  <div class="side-links nav-anon">
      <ul>
             <li><a href="http://music.douban.com/artists/">音乐人</a></li>
      </ul>
  </div>
  
</div>

  <div class="side">
<div class="mod">


    <h2>
        本周专辑TOP榜
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <span class="pl">&nbsp;(
                    <a href="http://music.douban.com/artists/">更多</a>
                ) </span>
    </h2>

<div class="list1 artist-charts">
  <ul>
  
    <li>
    <span class="num">1.</span>
    <div class="pic">
        <a href="http://site.douban.com/miserablefaith/"><img src="http://img02.taobaocdn.com/bao/uploaded/i2/T1YDyUXd4oXXb_8icT_012218.jpg_210x1000.jpg" data-origin="http://img3.douban.com/view/site/large/public/6c075a931ffb140.jpg" width="48"></a>
    </div>
    <div class="content">
    <a href="http://site.douban.com/miserablefaith/">唯美世界流行风</a>
    <div class="desc">
      标签: 清新 寒流
      <br>71269人喜欢
    </div>
    </div>
    </li>

  </ul>
</div>
</div>
</div>
  <div class="main">


    <h2>
        最新商品
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <span class="pl">&nbsp;(
                    <a href="#">更多</a>
                ) </span>
    </h2>

<div class="album-list list">
  <ul>
    <li>
    <div class="pic">
        <a href="http://music.douban.com/subject/24365227/"><img src="http://img02.taobaocdn.com/bao/uploaded/i2/T1YDyUXd4oXXb_8icT_012218.jpg_210x1000.jpg" data-origin="http://img3.douban.com/spic/s26715990.jpg" alt="低調人生"></a>
    </div>
    </li>
              
    
    </ul>
</div>
</div>
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
        <font color="green">ThinkPHP版本<?php echo (THINK_VERSION); ?></font>  目前有 <?php echo ($count_online_user); ?> 人在线 
        <!-- <script src="http://s6.cnzz.com/stat.php?id=5262498&web_id=5262498" language="JavaScript"></script> --><br />
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