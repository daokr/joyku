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
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21509482"></script>

<script type="text/javascript">
  var IK_BASE_URL = siteUrl;
  var lowLevelBrowser = true;
  if($.browser.webkit || $.browser.safari || $.browser.opera || $.browser.mozilla || (parseInt($.browser.version,10) > 8)){
      lowLevelBrowser = false;
  }
  
  IK.add('dialog-css', {path: '__PUBLIC__/css/ui/dialog.css', type: 'css'});
  IK.add('dialog', {path: '__PUBLIC__/js/ui/dialog.js', type: 'js', requires: ['dialog-css']});
   // Editable Select
  IK.add('editable-select-css', {path: '__PUBLIC__/css/lib/jquery.editable-select.css', type: 'css'});
  IK.add('editable-select', {path: '__PUBLIC__/js/lib/jquery.editable-select.js', type:"js", requires: ['editable-select-css']});
  // Date Picker
  IK.add('datePickercss', {path: '__PUBLIC__/css/ui/datepicker.css', type: 'css'});
  IK.add('datePicker', {path: '__PUBLIC__/js/lib/jquery.ui.min.js', type: 'js', requires: ['datePickercss']}); 
  
  IK.add('validate', {path: '__PUBLIC__/js/lib/validate.js', type:'js'});
  
  
  window._pinicon_ = '__PUBLIC__/images/pin.png';


  IK.add('imap', {path: '__PUBLIC__/js/ui/imap.js', type: 'js', requires: ['jquery.ui', 'dialog']});
  IK.add('google_map', {path: 'http://maps.google.com/maps/api/js?sensor=false&language=zh-CN&libraries=places&callback=loadMap', type: 'js'});

  function loadMap(){
    IK('imap', 
    '__PUBLIC__/css/ui/jquery.ui.autocomplete.css',
    '__PUBLIC__/js/lib/jquery.ui.autocomplete.min.js',
    '__STATIC_JS__/event/map.js');
  }

  IK('google_map');

  
  //离开页面
</script>
<script type="text/javascript" src="__STATIC_JS__/event/create.js"></script>
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
    	<h1><?php echo ($seo["title"]); ?></h1>
        <div class="cleft">
            <div class="nav-step">
              <span>1. 填写活动信息</span>
              <span class="pl">&gt;</span>
              <span class="pl">2. 上传活动海报</span>
              <span class="pl">&gt;</span>
              <span class="pl">3. 提交活动</span>
            </div>
<form id="eform" name="eform" action="<?php echo U('location/event/create');?>" method="post" autocomplete="off" tagName="form">        
<div class="row">
  <label class="field" for="type">活动分类</label>
  <div class="item">
    <select name="cateid" class="basic-input" id="type" data-suburl="<?php echo U('location/event/ajax_subcate');?>">
      <option value="0">请选择</option>
      <?php if(is_array($arrCate)): foreach($arrCate as $key=>$item): ?><option value="<?php echo ($item[cateid]); ?>"><?php echo ($item[catename]); ?></option><?php endforeach; endif; ?>
    </select>
	<span id="subtype-select" class="hide"></span>   
   </div>
</div>

<div class="row row-title">
        <label class="field" for="title">活动标题</label>
        <div class="item">
            <input type="text" size="64" name="title" maxlength="70" class="basic-input " value="" id="title" style="width:395px">
        </div>
</div>
<hr class="hrline">

<div class="row" id="eventTimeHook">
  <label for="time" class="field">活动时间</label>
  <div class="item">
    <select id="repeat_type" name="repeat_type" class="basic-input">
      <option value="0" selected>当天结束</option>
      <option value="1" >连续多天</option>
      <option value="2" >每周举行</option>
      <option value="3" >自定义</option>
    </select>
    <input type="hidden" name="begin_date" id="begin_date" value=""/>
    <input type="hidden" name="begin_time" id="begin_time" value=""/>
    <input type="hidden" name="end_date" id="end_date" value=""/>
    <input type="hidden" name="end_time" id="end_time" value=""/>
    <input type="hidden" name="repeat_time" id="repeat_time" value=""/>
  </div>
  <div>
    <div id="evnetDateOnedayHook" class="item inner-back hide">
      <input placeholder="活动日期" class="basic-input event_calendar" id="one_begin_day" type="text" size="12" value=""/>

      <input type="hidden" class="editableHook" data-id="one_begin_time" data-start="true" data-time="" /> 至&nbsp;&nbsp;
      <input type="hidden" class="editableHook" data-id="one_end_time" data-time=""/>
    </div>
    <div id="eventDateContinueHook" class="item inner-back hide">
      <div class="con_item">
        <label for="week_start_day" class="inner">起止日期</label>
        <div class="inner-item">
          <input class="basic-input event_calendar" id="more_begin_day" name="more_begin_day" type="text" size="12" value=""/> 至&nbsp;&nbsp;
          <input class="basic-input event_calendar" id="more_end_day" name="more_end_day" type="text" size="12" value=""/>
        </div>
      </div>
      <div class="con_item">
        <label for="week_start_time" class="inner">活动时间</label>
        <div class="inner-item">
          <input type="hidden" class="editableHook" data-id="more_begin_time" data-start="true" data-time=""/> 至&nbsp;&nbsp;
          <input type="hidden" class="editableHook" data-id="more_end_time" data-time=""/>
        </div>
      </div>
      <div class="con_item clearfix">
        <label class="inner">活动描述</label>
        <div id="eventContinueDescHook">
        </div>
      </div>
    </div>
    <div id="eventDateWeekHook" class="item inner-back hide">
      <div class="con_item">
        <label for="" class="inner">活动频率</label>
        <div class="inner-item week-label">
          
          <label for="week_mon">一<input type="checkbox" name="week_mon" id="week_mon" /></label>
          <label for="week_tue">二<input type="checkbox" name="week_tue" id="week_tue" /></label>
          <label for="week_wed">三<input type="checkbox" name="week_wed" id="week_wed" /></label>
          <label for="week_thu">四<input type="checkbox" name="week_thu" id="week_thu" /></label>
          <label for="week_fri">五<input type="checkbox" name="week_fri" id="week_fri" /></label>
          <label for="week_sat">六<input type="checkbox" name="week_sat" id="week_sat" /></label>
          <label for="week_sun">日<input type="checkbox" name="week_sun" id="week_sun" /></label>
        </div>
      </div>
      <div class="con_item">
        <label for="week_start_day" class="inner">起止日期</label>
        <div class="inner-item">
          <input class="basic-input event_calendar" id="week_begin_day" name="week_begin_day" type="text" size="12" value="" /> 至&nbsp;&nbsp;
          <input class="basic-input event_calendar" id="week_end_day" name="week_end_day" type="text" size="12" value=""/>
        </div>
      </div>
      <div class="con_item">
        <label for="week_start_time" class="inner">活动时间</label>
        <div class="inner-item">
          <input type="hidden" class="editableHook" data-id="week_begin_time" data-start="true" data-time=""/> 至&nbsp;&nbsp;
          <input type="hidden" class="editableHook" data-id="week_end_time" data-time=""/>
        </div>
      </div>
      <div class="con_item clearfix">
        <label class="inner">活动描述</label>
        <div id="eventWeekDescHook">
        </div>
      </div>
    </div>
    <div id="eventDateIntermHook" class="item inner-back hide">
      <div class="con_item">
        <label for="" class="inner">举办时间</label>
          <div class="inner-item interm-item">
            <input class="basic-input event_calendar interm_day" type="text" size="12" />
            <input type="hidden" class="editableHook" data-class="intermBeginTime" data-start="true"/> 至&nbsp;&nbsp;
            <input type="hidden" class="editableHook" data-class="intermEndTime"/>
          </div>
          <div class="inner-item interm-item">
            <input class="basic-input event_calendar interm_day" type="text" size="12" />
            <input type="hidden" class="editableHook" data-class="intermBeginTime" data-start="true"/> 至&nbsp;&nbsp;
            <input type="hidden" class="editableHook" data-class="intermEndTime"/>
          </div>
        <div class="inner-item">
          <a href="#" id="addEventDaysHook">添加时间</a>
        </div>
      </div>
      <div class="con_item clearfix">
        <label class="inner">活动描述</label>
        <div id="eventIntermDescHook">
        </div>
      </div>
    </div>
  </div>
</div>



<div class="row" id="pageAddressHook">
  
  <label class="field" for="page_address">活动地点</label>
  <div class="item map-item-error">
    <span class="validate-error map-error-fix" style="display: inline;"></span>
    <input id="coordinate" type="hidden" name="coordinate" value="" />
  </div>
  <div class="item page-address">
    <input id="loc_id" name="loc_id" type="hidden" value="<?php echo ($currtCity[areaid]); ?>" data-url="<?php echo U('location/index/getarea');?>"/>
    <div class="all-address-field">
      <div id="events-new-address" class="item">
        <div class="address-field-scope">
          <span class="ui-drop-input">
            <input id="city" name="city" class="basic-input drop-input" size="6" max="8" value="<?php echo ($currtCity[areaname]); ?>" />
            <s class="tri-down"></s>
          </span>
          <select class="basic-input address-select" id="district_id" name="district_id">

          </select>
          <select class="basic-input address-select" id="region_id" name="region_id">
            <option value="0">商圈(可选)</option>
          </select>
        </div>
        <div class="item street-address">
          <input class="basic-input" id="street_address" name="street_address" type="text" size="56" placeholder="详细地址" value="" maxlength="100"/>
        </div>
        <div id="new-map-card" class="map-card">
          <div class="bd">
              <a href="javascript:void(0);" data-type="new_mark" class="lnk-modify-addr">
                <img src="http://maps.google.cn/maps/api/staticmap?size=388x106&amp;zoom=6&amp;center=北京,CN&amp;sensor=false&amp;language=zh-CN" width="388" height="106">
                <span class="map-card-nomark">在地图上标注活动地点</span>
              </a>
            <div class="map-card-modify" style="display:none">
              已标注地点 <a href="javascript:void(0);" data-type="new_mark" class="no-visited lnk-modify-addr">修改</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="item">
    <a href="javascript:void(0)" id="addDirectionHook">设置乘车路线</a>
  </div>


</div>

<div class="citypicker ui-ftip ui-ftip-cb" id="city-picker" style="display: none;">
    <i class="pointer tri-up"><i class="tri-up"></i></i>
    <div class="cities">
      <div class="hd">
        <span class="tab on">热门</span>
        <span class="tab">A - G</span>
        <span class="tab">H - L</span>
        <span class="tab">M - T</span>
        <span class="tab">W - Z</span>
      </div>
      <div class="bd hot">
          <?php if(is_array($arrCity)): foreach($arrCity as $key=>$item): ?><span><a data-uid="<?php echo ($item[pinyin]); ?>" data-value="<?php echo ($item[areaid]); ?>" href="javascript:;"><?php echo ($item[areaname]); ?></a></span><?php endforeach; endif; ?>
      </div>
        
        
        
        
    </div>
  </div>

    
<div class="row">
  <label class="field" for="desc">活动详情</label>
  <div class="item desc">
    <textarea class="basic-input" id="desc" name="content" rows="10" cols="54" max_length="4000" ></textarea>
  </div>
</div>

<hr class="hrline" />
    

<div class="row" id="activeFeeHook">
  <label class="field" for="fee">活动费用</label>
  <div class="item fee">

    <label class="no-need-fee">                                              
      <input name="fee" type="radio" class="fee-value" checked value="0"/>免费
    </label>                                                                 
    <label>                                                                  
      <input name="fee" type="radio" class="fee-value" value="1"  />收费
    </label> 
    <input type="hidden" value="" id="fee_detail" name="fee_detail">
  </div>
  <div id="active_fee" class="item inner-back hide">
    <div class="con_item">
      <span>名称 </span><span class="pl">（如：预售票等）</span> <span style="margin-left:15px;">费用（元）</span>
    </div>
    <div class="con_item fee_item">
      <input type="text" class="basic-input fee-name" maxlength="15" placeholder="选填"/> <input type="text" class="basic-input fee-num" maxlength="6"/>
    </div>
    <a href="#" id="addFeeHook">添加费用</a>
  </div>
  <div id="tickets_field" class="item inner-back hide">
    在接下来的"发售电子票"环节里，设置详细的票务信息。
  </div>
</div>

    <div class="row">
        <label for="label" class="field">活动标签</label>
        <div class="item">
            <input id="tags" name="tags" class="basic-input" size="55" value="">
        </div>
        <div id="tagsContainer" class="item"></div>
    </div>
    <hr class="hrline" />
    <div class="row footer">
        <div class="item">
            <input class="loc-btn" type="button" id="submit_form" value="下一步：上传活动海报"/>
            <a id="cancel_form" class="lnk-flat">取消</a>
        </div>
    </div>
    </form>   
            
        </div><!--//left-->
    
        <div class="cright">
          <h2>什么是合适的同城活动？</h2>
          <ol class="pl">
              <li>有能最终确定的活动起止日期</li>
              <li>具备现实中能集体参与的活动地点</li>
              <li>是多人在现实中能碰面的活动</li>
          </ol>
          
          <br>
          <h2>如何才能让你的活动更吸引人？</h2>
          <ol class="pl">
            <li>标题简单明了 </li>
            <li>活动内容和特点介绍详细 </li>
            <li>活动海报吸引人眼球 </li>
          </ol>
          <p class="pl"> 更重要的是，邀请好友们都来参与！ </p>    
        </div><!--//right-->
    
    </div><!--//mc-->
</div><!--//midder-->
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