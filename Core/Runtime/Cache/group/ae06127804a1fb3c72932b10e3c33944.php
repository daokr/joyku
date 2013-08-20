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

<script>
$(document).ready(function() {
//选择一级区域
$('#oneid').change(function(){
	$("#stwoid").html('<img src="'+siteUrl+'Public/images/loading.gif" />');
	var oneid = $(this).children('option:selected').val();  //弹出select的值
	
	if(oneid==0){
		$("#stwoid").html('');
	 }else{
		$.ajax({
			type: "POST",
			url:  "<?php echo U('group/index/ajax_getcate');?>",
			data: {oneid:oneid},
			success: function(msg){
				$("#stwoid").html(msg);				
			}
		});
	
	}
	
});

});
</script>
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
<!--main-->
<div class="midder">
    <h1>申请创建小组</h1>
    <div class="mc">

        <div class="cleft">
        <form method="POST" action="<?php echo U('group/index/create');?>"  enctype="multipart/form-data" onsubmit="return createGroup(this);">
        <table width="100%" cellpadding="0" cellspacing="0" class="table_1">
            <tr>
                <th>小组名称：</th>
                <td><input type="text" value="" maxlength="63" size="31" name="groupname" tabindex="1" class="txt"    placeholder="请填写小组名称"></td>
            </tr>
            <tr>
                <th>小组分类：</th>
                <td>
<select id="oneid" name="oneid" class="txt">
<option value="0">请选择</option>
<?php if(is_array($arrOne)): $i = 0; $__LIST__ = $arrOne;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo[cateid]); ?>"><?php echo ($vo[catename]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>&nbsp;
<span id="stwoid"></span>
	</td>
            </tr>            
            <tr>
                <th>小组介绍：</th>
                <td><textarea style="width:500px;height:200px;" name="groupdesc" tabindex="2" id="editor_mini" class="txt"   placeholder="请填写小组介绍"></textarea></td>
            </tr>
            <tr>
                <th>小组标签：</th>
                <td>
                	<input style="width:300px;" onKeyDown="checkTag(this)" onKeyUp="checkTag(this)"  onBlur="checkTag(this)" type="text" value=""  name="tag" id="tag" tabindex="3" class="txt" placeholder="请填写小组标签"> <span class="tip">最多 5 个标签</span>
                </td>
            </tr> 
			<tr>
        	<th>&nbsp;</th>
            <td><div class="site-tags">
            	<dl class="tag-items" id="tag-items">
                    <dd onClick="tags(this)">生活</dd>
                    <dd onClick="tags(this)">同城</dd>
                    <dd onClick="tags(this)">影视</dd>
                    <dd onClick="tags(this)">工作室</dd>
                    <dd onClick="tags(this)">艺术</dd>
                    <dd onClick="tags(this)">音乐</dd>
                    <dd onClick="tags(this)">品牌</dd>
                    <dd onClick="tags(this)">手工</dd>
                    <dd onClick="tags(this)">闲聊</dd>
                    <dd onClick="tags(this)">设计</dd>
                    <dd onClick="tags(this)">服饰</dd>
                    <dd onClick="tags(this)">摄影</dd>
                    <dd onClick="tags(this)">媒体</dd>
                    <dd onClick="tags(this)">美食</dd>
                    <dd onClick="tags(this)">读书</dd>
                    <dd onClick="tags(this)">公益</dd>
                    <dd onClick="tags(this)">互联网</dd>
                    <dd onClick="tags(this)">动漫</dd>
                    <dd onClick="tags(this)">旅行</dd>
                    <dd onClick="tags(this)">绘画</dd>
                    <dd onClick="tags(this)">美容</dd>
                    <dd onClick="tags(this)">购物</dd>
                    <dd onClick="tags(this)">电影</dd>
                    <dd onClick="tags(this)">教育公益</dd>
                    <dd onClick="tags(this)">游戏</dd>
                </dl>
            </div></td>
        	</tr> 
            <tr>
                <th>&nbsp;</th>
                <td style="padding-top:0px ">
                	<p class="tips">标签作为关键词可以被用户搜索到，多个标签之间用空格分隔开。</p>
                </td>
            </tr>                                               
            <tr>
                <th>小组图标：</th>
                <td><input type="file" name="picfile" class="txt" tabindex="4"><span class="tip">(仅支持jpg，gif，png格式图片)</span></td>
            </tr>           
            <tr>
                <th>&nbsp;</th>
                <td>
                <label><input type="checkbox" checked  name="grp_agreement" id="grp_agreement" value="1" tabindex="5">&nbsp;我已认真阅读并同意《社区指导原则》和《免责声明》</label>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td><input class="submit" type="submit" value="创建小组" tabindex="6"/></td>
            </tr>
        </table>
        </form>
        </div>
    
        <div class="cright"></div>

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