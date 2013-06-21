<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<!--引入后前台公共public的模版文件 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($seo["title"]); ?> - <?php echo ($seo["subtitle"]); ?></title>
<meta name="keywords" content="<?php echo ($seo["keywords"]); ?>" /> 
<meta name="description" content="<?php echo ($seo["description"]); ?>" /> 
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

<script type="text/javascript" src="__PUBLIC__/js/masonry/jquery.masonry.min.js"></script>
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
                    <?php if(is_array($arrNav)): foreach($arrNav as $key=>$item): if($key == 'share'): ?><li><a href="javascript:;" class="a_<?php echo ($key); ?>" data-url="<?php echo ($item[url]); ?>"><?php echo ($item[name]); ?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo ($item[url]); ?>" class="a_<?php echo ($key); ?>" ><?php echo ($item[name]); ?></a></li><?php endif; endforeach; endif; ?>
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
       	 <h1>发现宝贝 </h1>
    <div class="">
        <div id="J_waterfall" class="wall_container" data-uri="<?php echo U('mall/index/index_ajax',array('tag'=>$tag,'sort'=>$sort,'p'=>$p));?>">
            <div class="J_item wall_tag">
                <h3>热门标签：</h3>
                <div class="atags clearfix">
                    	<a href="<?php echo U('mall/index/album');?>" title="" class="on">全部</a>
                        <a href="<?php echo U('mall/index/album',array('cid'=>1));?>" title="">甜美</a>
                        <a href="<?php echo U('mall/index/album',array('cid'=>1));?>" title="">街拍</a>
                        <a href="<?php echo U('mall/index/album',array('cid'=>1));?>" title="">欧美</a>
                        <a href="<?php echo U('mall/index/album',array('cid'=>1));?>" title="">美女</a>
                        <a href="<?php echo U('mall/index/album',array('cid'=>1));?>" title="">个性</a>
                </div>
            </div>
            <?php if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="J_item wall_item">


        <a href="javascript:;" class="J_unlike del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>"></a>



        <a href="javascript:;" class="J_delitem del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>" data-aid="<?php echo ($album["id"]); ?>"></a>


        <!--图片-->
        <ul class="pic">
            <li>
                <a href="<?php echo U('mall/item/index', array('id'=>$item['id']));?>" title="<?php echo ($item["title"]); ?>" target="_blank">
<img alt="<?php echo ($item["title"]); ?>" class="J_img J_decode_img" data-uri="<?php echo base64_encode(attach(get_thumb($item['img'], '_m'), 'item'));?>" >
                </a>
                <span class="p">¥<?php echo ($item["price"]); ?></span>
                <a href="javascript:;" class="J_joinalbum addalbum_btn" data-id="<?php echo ($item["id"]); ?>"></a>
            </li>
        </ul>
        <!--操作-->
        <div class="favorite"> 
            <a href="javascript:;" class="J_likeitem like" data-id="<?php echo ($item["id"]); ?>" >12</a>
            <div class="J_like_n like_n"><a href="" target="_blank">55</a><i></i></div>
            
            <?php if($item['comments'] > 0): ?><span class="creply_n">(<a href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank">2</a>)</span><?php endif; ?>
            <a class="creply" href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank">777</a> 
        </div>
        <!--作者-->

        <div class="author clearfix">
            <a href="<?php echo U('mall/mine/index',array('id'=>$item[user][doname]));?>" target="_blank">
                <img class="J_card avt fl r3" src="<?php echo ($item[user][face]); ?>" data-uid="<?php echo ($item["uid"]); ?>" />
            </a>
             <div class="user_info">
 				<a href="<?php echo U('mall/mine/index',array('id'=>$item[user][doname]));?>" class="J_card clr6 bold" target="_blank" data-uid="<?php echo ($item["userid"]); ?>"><?php echo ($item[user][username]); ?></a>
                <p class="share_info">分享了<span class="clrff8"><?php echo ($item[sharenum]); ?></span>个搭配</p>
             </div>
        </div>

        <!--说明-->
        <p class="intro clr6"><?php echo ($item["intro"]); ?></p>
        <!--评论-->
 		<?php if(!empty($item['comment_list'])): ?><ul class="rep_list">
            <?php $__FOR_START_25601__=0;$__FOR_END_25601__=C('pin_item_cover_comments');for($i=$__FOR_START_25601__;$i < $__FOR_END_25601__;$i+=1){ if(!empty($item['comment_list'][$i])): ?><li class="rep_f">
                <a href="" target="_blank">
                    <img src="" class="J_card avt fl r3" alt="<?php echo ($item['comment_list'][$i]['uname']); ?>" data-uid="">
                </a>
                <p class="rep_content"><a href="" class="J_card n" target="_blank" data-uid="">dfas</a>  你发的东西确实很好看哦</p>
            </li><?php endif; } ?>
        </ul><?php endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        
        <?php if(isset($show_load)): ?><div id="J_wall_loading" class="wall_loading tc gray"><span>加载中。。。</span></div><?php endif; ?>
        
        <?php if(isset($page_bar)): ?><div id="J_wall_page" class="wall_page" <?php if(isset($show_page)): ?>style="display:block;"<?php endif; ?>>
                <div class="page_bar"><?php echo ($page_bar); ?></div>
            </div><?php endif; ?>

        
    </div>
		
        
    	
     
        
    </div>
</div>



<script type="text/javascript" src="__STATIC_JS__/wall.js"></script>
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


</body>
</html>