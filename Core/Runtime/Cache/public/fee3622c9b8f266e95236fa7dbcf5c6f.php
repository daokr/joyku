<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($seo["title"]); ?>_<?php echo ($seo["subtitle"]); ?></title>
<?php if(!empty($seo["keywords"])): ?><meta name="keywords" content="<?php echo ($seo["keywords"]); ?>" /><?php endif; ?>
<?php if(!empty($seo["description"])): ?><meta name="description" content="<?php echo ($seo["description"]); ?>" /><?php endif; ?>
<meta property="qc:admins" content="12472730776130006375" />
<link rel="shortcut icon" href="__PUBLIC__/images/fav.ico" type="image/x-icon">
<link rel="icon" href="__PUBLIC__/images/fav.gif" type="image/gif" />
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
    

<div id="anony-article" class="section">
  <div class="wrapper">
        <div id="head-slide-box" class="head-slide-box">
        	<ul class="head-slides">
				<li class="item" style="display:block">
                	<div class="mod2-left">
                        <a  href="<?php echo U('space/photos/show',array('id'=>$arrPhoto[0][photoid]));?>"><img width="400" height="300" alt="" src="<?php echo ($arrPhoto[0][mimg]); ?>">
                        
                        </a>                    
                    </div>
                    <div class="mod2-mid">

                        <div>
                            <a href="<?php echo U('space/photos/show',array('id'=>$arrPhoto[1][photoid]));?>"><img src="<?php echo ($arrPhoto[1][mimg]); ?>" alt="" height="150" width="250">
                            
                            </a>
                        </div>
                        <div class="pt1h">
                        <a href="<?php echo U('space/photos/show',array('id'=>$arrPhoto[2][photoid]));?>"><img src="<?php echo ($arrPhoto[2][mimg]); ?>" alt="" height="149" width="250">
                       
                        </a>
                        </div>
                        
                    </div>
                    <div class="mod2-right">
                        <a  href="<?php echo U('space/photos/show',array('id'=>$arrPhoto[3][photoid]));?>"><img width="400" height="300" alt="" src="<?php echo ($arrPhoto[3][mimg]); ?>">
                       
                        </a>  	
                    </div>
                </li>            
            	<li class="item">
                    <div class="mod1-left">
                    	<div class="dlitem">
                    	<dl>
                        	<dt><a href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[0][aid]));?>"><img width="490" height="300" alt="<?php echo ($arrdigArticle[0][title]); ?>" src="<?php echo ($arrdigArticle[0][photo][mimg]); ?>"></a>
                        	<dd class="filter"><a class="cFFF" href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[0][aid]));?>"><?php echo ($arrdigArticle[0][title]); ?></a></dd>
                        </dl>
                        </div>
                        <!--
                        <ul class="dotitem">
							<li class="on"></li>
                            <li></li>
                             <li></li>
                        </ul>-->
                    </div> 
                    <div class="mod1-right">
                    	<div class="padingbox">
                            <h2 class="tit"><a href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[1][aid]));?>"><?php echo ($arrdigArticle[1][title]); ?></a></h2>
                            <div class="hot-box1 clearfix">
                              <ul>
                                <li><a class="c555" href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[2][aid]));?>"><?php echo ($arrdigArticle[2][title]); ?></a></li>
                                <li><a class="c555" href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[3][aid]));?>"><?php echo ($arrdigArticle[3][title]); ?></a></li>
                              </ul>
                              <ul class="r">
                                <li><a class="c555" href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[4][aid]));?>"><?php echo ($arrdigArticle[4][title]); ?></a></li>
                                <li><a class="c555" href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[5][aid]));?>"><?php echo ($arrdigArticle[5][title]); ?></a></li>
                              </ul>
                            </div>
                            <div class="hot-box2 clearfix">
                                <div class="hL">
                                	<h2><a href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[6][aid]));?>"><?php echo ($arrdigArticle[6][title]); ?></a></h2>
                                	<p><?php echo getsubstrutf8(t($arrdigArticle[6][content]),0,45); ?></p>
                                </div>
                                <div class="hR">            
                                    <h2><a href="<?php echo U('article/index/show',array('id'=>$arrdigArticle[7][aid]));?>"><?php echo ($arrdigArticle[7][title]); ?></a></h2>
                                    <p><?php echo getsubstrutf8(t($arrdigArticle[7][content]),0,55); ?></p>
                                </div>
                            </div>
                       </div>                         
                    </div>               
                </li>
                <li class="item">
                	<div class="mod2-left">
                        <a  href="<?php echo U('article/index/show',array('id'=>$arrfunArticle[0][aid]));?>"><img width="400" height="300" alt="<?php echo ($arrfunArticle[0][title]); ?>" src="<?php echo ($arrfunArticle[0][photo][mimg]); ?>">
                        <span class="filter"><?php echo ($arrfunArticle[0][title]); ?></span>
                        </a>                    
                    </div>
                    <div class="mod2-mid">

                        <div>
                            <a href="<?php echo U('article/index/show',array('id'=>$arrfunArticle[1][aid]));?>"><img src="<?php echo ($arrfunArticle[1][photo][mimg]); ?>" alt="<?php echo ($arrfunArticle[1][title]); ?>" height="150" width="250">
                            <span class="filter"><?php echo ($arrfunArticle[1][title]); ?></span>
                            </a>
                        </div>
                        <div class="pt1h">
                        <a href="<?php echo U('article/index/show',array('id'=>$arrfunArticle[2][aid]));?>"><img src="<?php echo ($arrfunArticle[2][photo][mimg]); ?>" alt="<?php echo ($arrfunArticle[2][title]); ?>" height="149" width="250">
                        <span  class="filter"><?php echo ($arrfunArticle[2][title]); ?></span>
                        </a>
                        </div>
                        
                    </div>
                    <div class="mod2-right">
                        <a  href="<?php echo U('article/index/show',array('id'=>$arrfunArticle[3][aid]));?>"><img width="400" height="300" alt="<?php echo ($arrfunArticle[3][title]); ?>" src="<?php echo ($arrfunArticle[3][photo][mimg]); ?>">
                        <span class="filter"><?php echo ($arrfunArticle[3][title]); ?></span>
                        </a>  	
                    </div>
                </li>
                <li class="item" >
                 	<div class="mod3-left">
                        <a  href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[0][aid]));?>">
                        <img width="250" height="300" alt="<?php echo ($arrHotArticle[0][title]); ?>" src="<?php echo ($arrHotArticle[0][photo][mimg]); ?>">
                        <span class="filter"><?php echo ($arrHotArticle[0][title]); ?></span>
                        </a>                    
                    </div> 
                    <div class="mod3-mid">
                    
                        <div class="midbox">
                            <div class="mhd">
                                <h2><a href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[1][aid]));?>"><?php echo ($arrHotArticle[1][title]); ?></a></h2>
                                <p><?php echo getsubstrutf8(t($arrHotArticle[1][content]),0,30); ?></p>
                            </div>
                            <div class="mbd">
                                <h2><a href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[2][aid]));?>"><?php echo ($arrHotArticle[2][title]); ?></a></h2>
                                <p><?php echo getsubstrutf8(t($arrHotArticle[2][content]),0,30); ?></p>
                            </div>
                        </div>
                                        
                    </div> 
                    <div class="mod3-mid">
                    
                        <div class="midbox">
                            <div class="mhd">
                                <h2><a href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[3][aid]));?>"><?php echo ($arrHotArticle[3][title]); ?></a></h2>
                                <p><?php echo getsubstrutf8(t($arrHotArticle[3][content]),0,30); ?></p>
                            </div>
                            <div class="mbd">
                                <h2><a href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[4][aid]));?>"><?php echo ($arrHotArticle[4][title]); ?></a></h2>
                                <p><?php echo getsubstrutf8(t($arrHotArticle[4][content]),0,30); ?></p>
                            </div>
                        </div>
                                        
                    </div> 
                    <div class="mod3-right">
                            <div class="picbox">
                            <a href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[5][aid]));?>"><img src="<?php echo ($arrHotArticle[5][photo][mimg]); ?>" alt="<?php echo ($arrHotArticle[5][title]); ?>" height="150" width="247"></a>
                            </div>
                            <div class="picinfo"> 
                                <h2><a href="<?php echo U('article/index/show',array('id'=>$arrHotArticle[5][aid]));?>"><?php echo ($arrHotArticle[5][title]); ?></a></h2>
                                <p><?php echo getsubstrutf8(t($arrHotArticle[5][content]),0,30); ?></p>
                            </div>
                    </div>                                 
                </li>
            </ul>
            <ul class="head-ctrls">
               <li class="on">推荐</li><li>头条</li><li>视觉</li><li class="last">热门</li>
            </ul>
        </div>
        
  </div><!--//end wrapper-->
</div><!--//end anony-sns-->

<div class="section" id="anony-sns">
  <div class="wrapper">
  
<!-- douban ad begin -->
<div id="dale_anonymous_homepage_top_for_crazy_ad"></div>
<!-- douban ad end -->

  
  <div class="side">

  
    <h2>
        线上活动
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <span class="pl">&nbsp;(
                    <a href="http://www.douban.com/online/?r=i">更多</a>
                ) </span>
    </h2>

  <div class="online">
    <ul>
        <li>
            <div class="title">
                <a href="http://www.douban.com/online/11583350/">你出邮费我就送</a>
            </div>
            <div class="desc">
                时间：7月28日 - 8月27日
                <br><span class="num">2817人参加</span>
            </div>
        </li>
        <li>
            <div class="title">
                <a href="http://www.douban.com/online/11582110/">豆瓣【原来不是】第一届比穷大赛！！！</a>
            </div>
            <div class="desc">
                时间：7月26日 - 9月5日
                <br><span class="num">1547人参加</span>
            </div>
        </li>
        <li>
            <div class="title">
                <a href="http://www.douban.com/online/11535333/">晒出真实的自己，遇见对的TA！</a>
            </div>
            <div class="desc">
                时间：5月7日 - 8月6日
                <br><span class="num">5799人参加</span>
            </div>
        </li>
        <li>
            <div class="title">
                <a href="http://www.douban.com/online/11582151/">来来来，给输入法和豆瓣阅读广告合个影吧！</a>
            </div>
            <div class="desc">
                时间：7月26日 - 8月25日
                <br><span class="num">235人参加</span>
            </div>
        </li>
        <li>
            <div class="title">
                <a href="http://www.douban.com/online/11580254/">豆瓣首届喵星人Hold住大赛</a>
            </div>
            <div class="desc">
                时间：7月23日 - 8月18日
                <br><span class="num">1839人参加</span>
            </div>
        </li>
        <!-- douban ad begin -->
        <li>
          <div id="dale_homepage_online_activity_promo_1"></div>
        </li>
        <li>
          <div id="dale_anonymous_homepage_doublemint"></div>
        </li>
        <!-- douban ad end -->
    </ul>
  </div>
</div>
  <div class="main">
<div class="mod">

  
    <h2>
        热点内容
            ······
    </h2>

  <div class="albums">
    <ul>
      <li>
      <div class="pic">
          <a href="http://www.douban.com/photos/album/106931735/"><img alt="" data-origin="http://img3.douban.com/view/photo/albumcover/public/p2061959750.jpg" src="http://img3.douban.com/view/photo/albumcover/public/p2061959750.jpg"></a>
      </div>
      <a href="http://www.douban.com/photos/album/106931735/">●ω●</a>
      <span class="num">23张照片</span>
      </li><li>
      <div class="pic">
          <a href="http://www.douban.com/photos/album/106644365/"><img alt="" data-origin="http://img3.douban.com/view/photo/albumcover/public/p2038197635.jpg" src="http://img3.douban.com/view/photo/albumcover/public/p2038197635.jpg"></a>
      </div>
      <a href="http://www.douban.com/photos/album/106644365/">20分钟做意面</a>
      <span class="num">13张照片</span>
      </li><li>
      <div class="pic">
          <a href="http://www.douban.com/photos/album/106614246/"><img alt="" data-origin="http://img3.douban.com/view/photo/albumcover/public/p2037866810.jpg" src="http://img3.douban.com/view/photo/albumcover/public/p2037866810.jpg"></a>
      </div>
      <a href="http://www.douban.com/photos/album/106614246/">超市那个弱爆了，看洛杉矶艺术家的展台设计</a>
      <span class="num">92张照片</span>
      </li><li>
      <div class="pic">
          <a href="http://www.douban.com/photos/album/81000590/"><img alt="" data-origin="http://img3.douban.com/view/photo/albumcover/public/p2048571395.jpg" src="http://img3.douban.com/view/photo/albumcover/public/p2048571395.jpg"></a>
      </div>
      <a href="http://www.douban.com/photos/album/81000590/">LIFECYCLING</a>
      <span class="num">793张照片</span>
    </li></ul>
  </div>
  <div class="notes">
    <ul>
      <li class="first">
      <div class="title">
          <a href="http://www.douban.com/note/290939157/">读书真的重要吗？</a>
      </div>
      <div class="author">
        芬雷的日记
      </div>
      <p>人到三十，我开始重新思考这个问题。想来想去，不一定有道理，我觉得读书是重要的...</p>
      </li>

      <li><a href="http://www.douban.com/note/289514899/">由绘画看人的包容和坚守</a></li>
      <li><a href="http://www.douban.com/note/288959253/">下意识的语言模式（下）</a></li>
      <li><a href="http://www.douban.com/note/289389729/">1、《满满都是我对你的爱》之我反对你们结婚</a></li>
      <li><a href="http://www.douban.com/note/289501225/">商场的地下王国</a></li>
      <li><a href="http://www.douban.com/note/290175650/">先生做饭太太乐</a></li>
      <li><a href="http://www.douban.com/note/291906190/">闲话印石，以及我的封门青。</a></li>
      <li><a href="http://www.douban.com/note/292016157/">20岁以后，努力选择去过自己喜欢的生活</a></li>
      <li><a href="http://site.douban.com/MLS/widget/notes/13844412/note/289129651/">诗两首</a></li>
      <li><a href="http://www.douban.com/note/289375225/">我收集的有用的社会科学数据（不断添加中）</a></li>
    </ul>
  </div>
</div>
</div>
  </div>
  
<div class="extra" id="dale_anonymous_home_page_top"><iframe width="950" scrolling="no" height="90" frameborder="0" id="dale_anonymous_home_page_top_frame" style="overflow: hidden; margin: 0px;"></iframe></div>

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