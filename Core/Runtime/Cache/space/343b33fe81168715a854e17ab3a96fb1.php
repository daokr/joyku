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
    	<div class="note-header">
        	<h1><?php echo ($strNote[title]); ?></h1>
        	<div><span class="pl"><?php echo (date("Y-m-d H:i:s",$strNote["addtime"])); ?></span></div>
    	</div>
    
    	<div id="link-report" class="note"><?php echo ($strNote[content]); ?></div>
    	<br>
		<div class="note-ft">
        	<?php if($strNote[userid] == $visitor[userid]): ?><div class="note_upper_footer">
                    <span class="pl gtleft">&nbsp;<?php echo ($strNote[count_view]); ?> 人浏览</span>
                    <span class="gtleft">&gt; <a href="<?php echo U('space/notes/edit',array('id'=>$strNote[noteid]));?>">修改</a>&nbsp; &nbsp; </span>
                    <span class="gtleft">&gt; <a   title="删除这篇日记吗?"  href="<?php echo U('space/notes/delete',array('id'=>$strNote[noteid]));?>" onClick="return confirm('删除这篇日记吗?')">删除</a></span>
            </div><?php endif; ?>
        </div>        

    <div class="mod">
               <div class="orderbar"> 
        <?php if(($page == 1) && ($strObj[count_comment] > 3)): ?><a href="<?php echo U($strObj[showurl],array('id'=>$strObj[id],'sc'=>$sc,'isauthor'=>$author[isauthor]));?>"><?php echo ($author[text]); ?></a>&nbsp;&nbsp;
            <?php if($sc == 'asc'): ?><a href="<?php echo U($strObj[showurl],array('id'=>$strObj[id],'sc'=>'desc','isauthor'=>$isauthor));?>">倒序阅读</a> 
            <?php else: ?>
                <a href="<?php echo U($strObj[showurl],array('id'=>$strObj[id],'sc'=>'asc','isauthor'=>$isauthor));?>">正序阅读</a><?php endif; endif; ?>
      </div>
      
      <!--comment评论-->
      <ul class="comment" id="comment">
       <?php if(!empty($commentList)): if(is_array($commentList)): foreach($commentList as $key=>$item): ?><li class="clearfix">
          <div class="user-face"> <a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><img title="<?php echo ($item[user][username]); ?>" alt="<?php echo ($item[user][username]); ?>" src="<?php echo ($item[user][face]); ?>"></a> </div>
          <div class="reply-doc">
            <h4><span class="fr"></span><a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><?php echo ($item[user][username]); ?></a> <?php echo date('Y-m-d H:i:s',$item[addtime]) ?></h4>
            
            <?php if($item[referid] != 0): ?><div class="recomment"><span id="re_sub_<?php echo ($item[commentid]); ?>"><?php echo getsubstrutf8(t($item[recomment][content]),0,60,0); ?>&nbsp;
            <?php if(mb_strlen(t($item[recomment][content]),'utf8')>60){ ?>
            <a href="javascript:;" onClick="$('#re_all_<?php echo ($item[commentid]); ?>').show();$('#re_sub_<?php echo ($item[commentid]); ?>').hide();">... </a>
            </span><span style="display:none" id="re_all_<?php echo ($item[commentid]); ?>"><?php echo t($item[recomment][content]); ?></span>
            <?php } ?>
            <strong><a href="<?php echo U('space/index/index',array('id'=>$item[recomment][user][doname]));?>"><?php echo ($item[recomment][user][username]); ?></a></strong></div><?php endif; ?>
            
            <p> <?php echo ($item[content]); ?> </p>
            
            <!--签名--> 
            <?php if(!empty($item[user][signed])): ?><div class="signed"><?php echo ($item[user][signed]); ?></div><?php endif; ?>
            
            <div class="group_banned"> 
              <?php if($visitor[userid] != 0): ?><span><a href="javascript:void(0)"  onclick="commentOpen(<?php echo ($item[commentid]); ?>,<?php echo ($item[topicid]); ?>)">回复</a></span><?php endif; ?>
              <?php if(($strTopic[userid] == $visitor[userid]) OR ($strGroup[userid] == $visitor[userid]) OR ($visitor[userid] == $item[userid]) OR ($strGroupUser[isadmin] == 1) OR ($visitor[userid] == 1)): ?><span><a class="j a_confirm_link" href="<?php echo ($action[deleteurl]); ?>" rel="nofollow" onclick="return confirm('确定删除?')">删除</a> </span><?php endif; ?>
            </div>
            <div id="rcomment_<?php echo ($item[commentid]); ?>" style="display:none; clear:both; padding:0px 10px">
              <textarea style="width:550px;height:50px;font-size:12px; margin:0px auto;" id="recontent_<?php echo ($item[commentid]); ?>" type="text" onkeydown="keyRecomment(<?php echo ($item[commentid]); ?>,<?php echo ($item[topicid]); ?>,event)" class="txt"></textarea>
              <p style=" padding:5px 0px">
                 <button onclick="recomment(this,<?php echo ($item[cid]); ?>,<?php echo ($item[aid]); ?>)" id="recomm_btn_<?php echo ($item[cid]); ?>" class="subab" data-url="<?php echo ($action[recomment]); ?>">提交</button>
                &nbsp;&nbsp;<a href="javascript:;" onclick="$('#rcomment_<?php echo ($item[commentid]); ?>').slideToggle('fast');">取消</a> </p>
            </div>
          </div>
          <div class="clear"></div>
        </li><?php endforeach; endif; endif; ?>
      </ul>
      <div class="page"><?php echo ($pageUrl); ?></div>
      <h2>你的回应&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·</h2>
      <div> 
        <?php if(!$visitor['userid']): ?><div style="border:solid 1px #DDDDDD; text-align:center;padding:20px 0"><a href="<?php echo U('public/user/login');?>" class="i a_show_login">登录</a> | <a href="<?php echo U('public/user/register');?>" class="i a_show_register">注册</a></div>
        <?php else: ?>
        <form method="POST" action="<?php echo ($action[addcomment]); ?>" onSubmit="return checkComment('#formMini');" id="formMini" enctype="multipart/form-data">
          <textarea  style="width:100%;height:100px;" id="editor_mini" name="content" class="txt" onkeydown="keyComment('#formMini',event)"></textarea>
          <input type="hidden" name="id" value="<?php echo ($strObj[id]); ?>" />
          <input type="hidden" name="p" value="<?php echo ($page); ?>" />
          <input class="submit" type="submit" value="加上去(Crtl+Enter)" style="margin:10px 0px">
        </form><?php endif; ?>
      </div>
    </div>

    	
    </div><!--//cleft-->
    <div class="cright">
		<div class="mod">
	        <h2>
	        <?php if($visitor[userid]): ?>我的日记<?php else: echo ($strNote[user][username]); ?>的日记<?php endif; ?>
	            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
	            <span class="pl">&nbsp;(<a  href="<?php echo U('space/notes/index',array('id'=>$strNote['userid']));?>">全部</a>) </span>
	    	</h2>
			<ul class="note-list">
            	  <?php if(is_array($arrNotes)): foreach($arrNotes as $key=>$item): ?><li><a href="<?php echo U('space/notes/show',array('id'=>$item[noteid]));?>" title="$item[title]"><?php echo ($item[title]); ?></a></li><?php endforeach; endif; ?>
            </ul>       
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