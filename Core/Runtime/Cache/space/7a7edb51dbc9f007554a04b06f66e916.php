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
	<h1  id="image"><?php echo ($seo["title"]); ?></h1>
	<div class="cleft">

<div class="pl photitle">
        <span class="fr">&gt; <a href="<?php echo U('space/photos/album',array('id'=>$strPhoto[albumid]));?>">返回相册</a></span>
        <span class="fl">第<?php echo ($strPhoto[nowPage]); ?>张 / 共<?php echo ($strPhoto[countPage]); ?>张</span>
        <?php if($strPhoto[nowPage] > 1): ?><a id="pre_photo" title="上一张" href="<?php echo ($strPhoto[prevturl]); ?>#image">上一张</a>
        	 <?php if($strPhoto[nowPage] < $strPhoto[countPage]): ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php endif; endif; ?>
        <?php if($strPhoto[nowPage] < $strPhoto[countPage]): ?><a id="next_photo" title="下一张" href="<?php echo ($strPhoto[nexturl]); ?>#image">下一张</a><?php endif; ?>
</div>
    
<div id="link-report">
      <div style="text-align:center">
       <?php if($strPhoto[nowPage] < $strPhoto[countPage]): ?><a title="点击查看下一张" href="<?php echo ($strPhoto[nexturl]); ?>#image" class="mainphoto">
              <img src="<?php echo ($strPhoto[mimg]); ?>">
          </a>
       <?php else: ?>
       		 <img src="<?php echo ($strPhoto[mimg]); ?>"><?php endif; ?>   
      </div>
      <div class="photo_descri">
           <p class="pl" id="desc_info">
           <span>
               <?php if($strPhoto[photodesc]): echo ($strPhoto[photodesc]); ?>
               <?php else: ?>
               这张照片的还没有添加任何描述...<?php endif; ?>
           </span>
           &nbsp;<?php if($visitor[userid] == $strPhoto[userid]): ?>&gt;&nbsp;<a title="编辑描述" href="javascript:;" id="edit_pinfo">编辑描述</a><?php endif; ?>
           </p>
           
           <?php if($visitor[userid] == $strPhoto[userid]): ?><p class="pl" id="desc_edit" style="display:none">
               <textarea maxlength="120" name="photodesc" id="photodesc" style="width:100%; margin-bottom:5px; color:#666" class="txt"><?php echo ($strPhoto[photodesc]); ?></textarea>
               <br/>
               <input type="button" value="保存" class="subab" id="savebtn">&nbsp;&nbsp;<a href="javascript:;" id="cancle_edit">取消</a>
           </p><?php endif; ?>
           
      </div>
      <div class="report-link" style="color:#999;margin-bottom:5px">
      		<?php if($visitor[userid] == $strPhoto[userid]): ?><span class="fr">&gt;&nbsp;<a title="删除这张照片" href="<?php echo U('space/photos/delphoto',array('id'=>$strPhoto[photoid]));?>">删除照片</a></span><?php endif; ?>
            <?php echo ($strPhoto[count_view]); ?>人浏览&#12288;上传于<?php echo (date("Y-m-d",$strPhoto[addtime])); ?>&#12288;<a target="_blank" title="查看原图" href="<?php echo ($strPhoto[img]); ?>">查看原图</a>
      </div>
    
</div>

<div class="mod">
	      <div class="orderbar"> 
        <?php if(($page == 1) && ($strPhoto[count_comment] > 3)): ?><a href="<?php echo U('group/index/topic',array('id'=>$strTopic[topicid],'sc'=>$sc,'isauthor'=>$author[isauthor]));?>"><?php echo ($author[text]); ?></a>&nbsp;&nbsp;
        <?php if($sc == 'asc'): ?><a href="<?php echo U('group/index/topic',array('id'=>$strTopic[topicid],'sc'=>'desc','isauthor'=>$isauthor));?>">倒序阅读</a> 
        <?php else: ?>
        	<a href="<?php echo U('group/index/topic',array('id'=>$strTopic[topicid],'sc'=>'asc','isauthor'=>$isauthor));?>">正序阅读</a><?php endif; endif; ?>
      </div>      
      <!--comment评论-->
      <ul class="comment" id="comment">
       <?php if(!empty($commentList)): if(is_array($commentList)): foreach($commentList as $key=>$item): ?><li class="clearfix">
                  <div class="user-face"> 
                  <a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><img title="<?php echo ($item[user][username]); ?>" alt="<?php echo ($item[user][username]); ?>" src="<?php echo ($item[user][face]); ?>"></a> 
                  </div>
                  <div class="reply-doc">
                    <h4>
                        <span class="fr"></span>
                        <a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><?php echo ($item[user][username]); ?></a> 
                        <?php echo date('Y-m-d H:i:s',$item[addtime]) ?>
                    </h4>
                    
                    <?php if($item[referid] != 0): ?><div class="recomment"><a href="<?php echo U('space/index/index',array('id'=>$item[recomment][user][doname]));?>"><img src="<?php echo ($item[recomment][user][face]); ?>" width="24" align="absmiddle"></a> <strong><a href="<?php echo U('space/index/index',array('id'=>$item[recomment][user][doname]));?>"><?php echo ($item[recomment][user][username]); ?></a></strong>：<?php echo ($item[recomment][content]); ?></div><?php endif; ?>
                    
                    <p><?php echo ($item[content]); ?></p>
                    
                    <div class="group_banned"> 
                      <?php if($visitor[userid] != 0): ?><span><a href="javascript:void(0)"  onclick="commentOpen(<?php echo ($item[commentid]); ?>,<?php echo ($item[photoid]); ?>)">回复</a></span><?php endif; ?>
                      <?php if(($strPhoto[userid] == $visitor[userid]) OR ($visitor[userid] == $item[userid])): ?><span><a class="j a_confirm_link" href="<?php echo U('space/photos/delcomment',array('commentid'=>$item[commentid]));?>" rel="nofollow" onclick="return confirm('确定删除?')">删除</a> </span><?php endif; ?>
                    </div>
                    <div id="rcomment_<?php echo ($item[commentid]); ?>" style="display:none; clear:both; padding:0px 10px">
                      <textarea style="width:550px;height:50px;font-size:12px; margin:0px auto;" id="recontent_<?php echo ($item[commentid]); ?>" type="text" onkeydown="keyRecomment(<?php echo ($item[commentid]); ?>,<?php echo ($item[photoid]); ?>,event)" class="txt"></textarea>
                      <p style=" padding:5px 0px">
                        <button onclick="recomment(this,<?php echo ($item[commentid]); ?>,<?php echo ($item[photoid]); ?>)" id="recomm_btn_<?php echo ($item[commentid]); ?>" class="subab" data-url="<?php echo U('space/photos/recomment');?>">提交</button>
                        &nbsp;&nbsp;<a href="javascript:;" onclick="$('#rcomment_<?php echo ($item[commentid]); ?>').slideToggle('fast');">取消</a>
                      </p>
                    </div>
                  </div>
                  <div class="clear"></div>
                </li><?php endforeach; endif; endif; ?>
      </ul>
      
      <div class="page"><?php echo ($pageUrl); ?></div>
      <h2>你的回应&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·</h2>
      <div> 
            <?php if(!$visitor['userid']): ?><div style="border:solid 1px #DDDDDD; text-align:center;padding:20px 0"><a href="<?php echo U('public/user/login');?>">登录</a> | <a href="<?php echo U('public/user/register');?>">注册</a></div>
            <?php else: ?>
            <form method="POST" action="<?php echo U('space/photos/addcomment');?>" onSubmit="return checkComment('#formMini');" id="formMini" enctype="multipart/form-data">
              <textarea  style="width:100%;height:100px;" id="editor_mini" name="content" class="txt" onkeydown="keyComment('#formMini',event)"></textarea>
              <input type="hidden" name="photoid" value="<?php echo ($strPhoto[photoid]); ?>" />
              <input type="hidden" name="p" value="<?php echo ($page); ?>" />
              <input class="submit" type="submit" value="加上去(Crtl+Enter)" style="margin:10px 0px">
            </form><?php endif; ?>
      </div>
</div>
    
<script language="javascript">
	$('#edit_pinfo').bind('click',function(){
		var desc_info = $('#desc_info'),desc_edit = $('#desc_edit');
		desc_info.hide();desc_edit.show();
	});
	$('#cancle_edit').bind('click',function(){
		var desc_info = $('#desc_info'),desc_edit = $('#desc_edit');
		desc_info.show();desc_edit.hide();
	});
	$('#savebtn').bind('click',function(){
		var info = $('#photodesc'),pid = <?php echo ($strPhoto["photoid"]); ?>,ajaxurl='<?php echo U("space/photos/editphoto");?>';
		var desc_info = $('#desc_info'),desc_edit = $('#desc_edit');
		if(info.val()=="" || info.val() == 0){
			tips('描述不能为空字符')
		}else{
			$.post(ajaxurl,{photoid:pid,photodesc:info.val()},function(res){
				if(res.r==1){
					desc_info.show();desc_edit.hide();
					desc_info.find('span').html(res.html);
					info.val(res.html);
				}else{
					tips(res.error)
				}
			});
		}
	})
</script>    
    	
    </div><!--//cleft-->
    <div class="cright">
       
<div class="mod">
        
    <h2>
        我的相册&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
        <span class="pl">&nbsp;(<a href="<?php echo U('space/photos/index',array('id'=>$strPhoto['userid']));?>">全部</a>) </span>
    </h2>

        <div class="bd">
            <ul class="album-list">
                    <?php if(is_array($arrAlbum)): foreach($arrAlbum as $key=>$item): ?><li>
                    <div class="pic">
                        <a href="<?php echo U('space/photos/album',array('id'=>$item[albumid]));?>">
                            <img width="75" height="75" alt="美女图片" src="<?php echo ($item[simg]); ?>">
                        </a>
                    </div>
                    <div class="info">
                        <a href="<?php echo U('space/photos/album',array('id'=>$item[albumid]));?>"><?php echo ($item[albumname]); ?></a>
                        <span class="num"><?php echo ($item[count_photo]); ?>张照片</span>
                        <p><?php echo getsubstrutf8(t($item[albumdesc]),0,30); ?></p>
                    </div>
                    </li><?php endforeach; endif; ?>				    
            </ul>
        </div>
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