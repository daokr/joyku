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

<link rel="stylesheet" type="text/css" href="__STATIC_CSS__/show.css">
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
    
<div class="eventwrap" itemscope="" itemtype="http://data-vocabulary.org/Event">
    <div class="poster">
      <a href="<?php echo ($strEvent[orgimg]); ?>" target="_blank" title="点击查看大图" >
        <img id="poster_img" itemprop="image" src="<?php echo ($strEvent[midimg]); ?>" title="点击查看大图" height="260" width="175">
      </a>
      <script type="text/javascript">
        if (window.devicePixelRatio >= 1.5) {
          document.getElementById('poster_img').src = '<?php echo ($strEvent[orgimg]); ?>';
        }
      </script>
    </div>
    <div id="event-info">
        <div class="event-info">
            <h1 itemprop="summary">
            <?php echo ($strEvent[title]); if($strEvent[isaudit] == 1): ?><font class="red">[审核中]</font><?php endif; ?>
            <span class="start">即将开始</span>
            </h1>
            <div class="event-detail">
                <span class="pl">时间：&nbsp;&nbsp;</span>
                <ul class="calendar-strs ">
                  <li class="calendar-str-item "><?php echo date('m月d日',$strEvent[begin_date]); ?> <?php echo ($strEvent[begin_week_day]); ?> <?php echo ($strEvent[begin_time]); ?>-<?php echo ($strEvent[end_time]); ?></li>
                </ul>
                <time itemprop="startDate" datetime="2013-04-20T08:00:00"></time>
                <time itemprop="endDate" datetime="2013-04-20T22:30:00"></time>
            </div>
            <div class="event-detail" itemprop="location" itemscope="" itemtype="http://data-vocabulary.org/Organization">
                <span class="pl">地点：&nbsp;</span>
                <span itemprop="address" itemscope="" itemtype="http://data-vocabulary.org/Address" class="micro-address">
                     <span itemprop="region" class="micro-address"><?php echo ($strEvent[city]); ?>&nbsp;</span>
                     <span itemprop="locality" class="micro-address"><?php echo ($strEvent[district]); ?>&nbsp;</span>
                     <span itemprop="street-address" class="micro-address"><?php echo ($strEvent[street_address]); ?></span>
                </span>
                <span itemprop="geo" itemscope="" itemtype="http://data-vocabulary.org/Geo" class="micro-address">
                    <meta itemprop="latitude" content="<?php echo ($strEvent[latitude]); ?>">
                    <meta itemprop="longitude" content="<?php echo ($strEvent[longitude]); ?>">
                </span>

            </div>
            <div class="event-detail">
                  <span class="pl">费用：&nbsp;&nbsp;</span><?php echo ($strEvent[fee_detail]); ?>
            </div>
            <div class="event-detail">
                <span class="pl">类型：&nbsp;&nbsp;</span><a href="<?php echo U('location/event/lists',array('type'=>'future_'.$strEvent[cate][enname]));?>" itemprop="eventType"><?php echo ($strEvent[cate][catename]); ?>-<?php echo ($strEvent[subcate][catename]); ?></a>
            </div>
            <div class="event-detail" itemscope="" itemtype="http://data-vocabulary.org/Organization">
                
                <span class="pl">发起人：</span>
                <a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>" itemprop="name"><?php echo ($strEvent[user][username]); ?></a>
            </div>
            <div class="interest-attend pl">
                <span class="num"><?php echo ($strEvent[count_userwish]); ?> </span><span>人感兴趣 &nbsp; </span>
                <span class="num"><?php echo ($strEvent[count_userjion]); ?> </span><span>人参加</span>
            </div>
        </div>
        <div id="event-act">
        	<?php if($strEvent[isaudit] == 1): ?><p>
              <span class="ui-msg ui-warn">
                活动已创建，等待审核中... 审核通过后会有站内信通知
              </span>
            </p><?php endif; ?>
            
        </div>
        

    </div>
</div>



<div class="related_info">

    <div class="mod" id="link-report">
      <h2>活动详情</h2>
        
        <div class="wr">
            <?php echo ($strEvent[content]); ?> 
        </div>
    </div>

<div class="mod">
    <h2>活动相关小站</h2>
    <ul class="link-site-container">
    
        <li class="link-subject">
            <div class="photo">
                <a title="爱客小站" href="#"><img width="64" title="爱客小站" alt="" src="http://img3.douban.com/pview/event_poster/large/public/edf7b12feb39945.jpg"></a>
            </div>
            <div class="detail">
                <h3><a href="#">爱客小站</a> <span class="cate">推广</span></h3>
            </div>
        </li>
    </ul>
</div>
    
<div class="mod">
      <h2>我来问主办方 &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
        <span class="pl">
          (<a href="#">全部0个</a>
          )
        </span>
      </h2>
        <div class="pl">还没有人提问</div>
</div>
    
    

<div class="mod">
    <h2>这个活动论坛</h2>
    <div class="indent">
    <table class="olt">
        <tr>
        <td width="54%"></td>
        <td width="22%"></td>
        <td width="12%"></td>
        <td wdith="12%"></td>
        </tr>
        <tr>
        <td><a title="活动具体内容？" href="#">活动具体内容？</a></td>
        <td class="pl">来自<a href="#">Lizyjs</a></td>
        <td class="pl">6 回应</td>
        <td class="pl">2013-04-19</td>
        </tr>
     </table>
    <p align="right" class="pl">&gt; <a rel="nofollow" href="#">在这个活动论坛发言</a></p>
    </div>
</div>




<div class="mod">
  <h2 class="related_h2">喜欢这个活动的人也喜欢</h2>
  <ul class="events-list events-list-2col">

      <li class="list-entry">
      <div class="pic">
        <a tabindex="-1" href="#">
          <img alt=""  src="http://img3.douban.com/pview/event_poster/median/public/e835b34b08d2565.jpg" width="70">
        </a>
      </div>
      <div class="info">
        <div class="title">
          <a href="#" title="噪音冲撞 Vol 3 - After Argument、DICE、Mr.Graceless">
            噪音冲撞 Vol 3 - After Argument、DICE、Mr.Graceless
          </a>
        </div>
        <div class="datetime">
      		<span class="month">4月</span><span class="day">20日 周六</span>&nbsp;<span class="time">20:30 - 22:30</span>
        </div>
        <address title="北京 朝阳区 麻雀瓦舍">
          麻雀瓦舍
        </address>
        <div>
          282人关注
        </div>
      </div>
      </li>

  </ul>
</div>    



</div><!--//related_info-->
 

        </div><!--//left-->
    
        <div class="cright">


  




<div class="mod">
    <h2>活动相关标签 &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·</h2>
    <ul class="aside-event-tags">
        <li><a href="#">音乐节</a>&nbsp;</li>
            · &nbsp;
        <li><a href="#">草莓音乐节</a>&nbsp;</li>
            · &nbsp;
        <li><a href="#">摇滚</a>&nbsp;</li>
    </ul>
</div>
  


    <div class="mod">
        <h2>活动地图 <span class="pl">( <a href="<?php echo U('location/event/full_map',array('id'=>$strEvent[eventid]));?>">查看大图</a> )</span></h2>
        
        <div id="event-map" style="background:url(http://ditu.google.cn/maps/api/staticmap?language=zh-CN&amp;size=308x200&amp;zoom=13&amp;markers=40.108257,117.119263&amp;sensor=false) no-repeat">
          <a href="<?php echo U('location/event/full_map',array('id'=>$strEvent[eventid]));?>">
            <img src="http://ditu.google.cn/maps/api/staticmap?language=zh-CN&amp;size=308x200&amp;zoom=13&amp;markers=40.108257,117.119263&amp;sensor=false" width="308" height="200" alt="Google 地图" />
          </a>
        </div>
        <script id="db-templ-map-comment" type="text/template">
            <div class="map-confirm">
                <h2>{%=address%}</h2>
                <p class="pos-comment">
                    {% if (comment) { %}
                        {%=comment%}
                        <br>
                    {% } %}
                    {%=drive%}
                </p>
            </div>
        </script>
        <?php if($strEvent[direction]): ?><p class="bus-direction">乘车路线：<?php echo ($strEvent[direction]); ?></p><?php endif; ?>
    </div>

<script type="text/javascript">
var get_address_url = "<?php echo U('location/event/get_address');?>"; 
var post_address_url = "<?php echo U('location/event/post_address');?>"; 
IK.add('google.map', { type: 'js', path: 'http://maps.google.com/maps/api/js?language=zh-CN&sensor=false&callback=init_map' });
IK.add('dui.map', { type: 'js', path: "__STATIC_JS__/event/duimap.js", depends: ['google.map'] });
function init_map() {
	IK("dui.map",
	function() {
		var c = window._event_map_;
		c.callback = function(d, e) {
			if (d === "small") {
				a(e)
			}
		};
		var b = new dui.Map(c);
		function a(f) {
			var e = $.tmpl($("#db-templ-map-comment").html(), {
				address: c.address,
				comment: c.comment,
				drive: c.drive
			}),
			d = new google.maps.InfoWindow({
				content: e
			});
			google.maps.event.addListener(f.marker, "mouseover",
			function() {
				d.open(f.map, f.marker)
			})
		}
	})
}
IK.ready(function() {
	IK("google.map")
});

IK.add('getaddr', { type: 'js', path: "__STATIC_JS__/event/getaddr.js", 
depends: ['google.map'] });
IK.ready(function() { IK('getaddr'); });
</script>

<script type="text/javascript">
  var begin_date = "<?php echo date('Y/m/d',$strEvent[begin_date]); ?>"
  window._event_map_ = {
    containerId: 'event-map',
    lat: '<?php echo ($strEvent[latitude]); ?>',
    lng: '<?php echo ($strEvent[longitude]); ?>',
    type: 'small',
    markerIcon:'',
    address: '<?php echo ($strEvent[street_address]); ?>',
    comment: '',
    drive: '<a href="http://ditu.google.cn/maps?hl=zh-CN&ie=UTF8&dirflg=r&f=d&daddr=<?php echo ($strEvent[street_address]); ?>&date='+begin_date+'&time=<?php echo ($strEvent[begin_time]); ?>" target="_blank">驾车/公交路线</a>'
  };
</script>



<div class="mod">
    <h2>活动组织者
    </h2>
    <ul class="member_photo">
        
         <li class="">
            <a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>"><img src="<?php echo ($strEvent[user][face]); ?>" alt="" data-title="<?php echo ($strEvent[user][username]); ?>" data-relation="False" width="35"></a>
            <div class="member-tip">
            <a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>" class="pic"><img src="<?php echo ($strEvent[user][face]); ?>" title="<?php echo ($strEvent[user][username]); ?>"></a>
            <div class="detail"><a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>" title="<?php echo ($strEvent[user][username]); ?>"><?php echo ($strEvent[user][username]); ?></a></div>
                <div class="pl detail">组织者</div>
                <div class="relation pl"></div>
                <span class="arrow inner"></span>
                <span class="arrow outer"></span>
            </div>
        </li> 
        
    </ul>
</div>

<div class="mod">
    <h2>活动成员 <span class="pl">( <a href="#">1人参加 </a>· <a href="#">0人感兴趣</a>
            )</span></h2>
    <ul class="member_photo">
        
         <li class="">
            <a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>"><img src="<?php echo ($strEvent[user][face]); ?>" alt="" data-title="<?php echo ($strEvent[user][username]); ?>" data-relation="False" width="35"></a>
            <div class="member-tip">
            <a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>" class="pic"><img src="<?php echo ($strEvent[user][face]); ?>" title="<?php echo ($strEvent[user][username]); ?>"></a>
            <div class="detail"><a href="<?php echo U('space/index/index',array('id'=>$strEvent[user][doname]));?>" title="<?php echo ($strEvent[user][username]); ?>"><?php echo ($strEvent[user][username]); ?></a></div>
                <div class="pl detail">组织者</div>
                <div class="relation pl"></div>
                <span class="arrow inner"></span>
                <span class="arrow outer"></span>
            </div>
        </li>       

        
    </ul>
</div>


        </div><!--//right-->
    
    </div><!--//mc-->
</div><!--//midder-->
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