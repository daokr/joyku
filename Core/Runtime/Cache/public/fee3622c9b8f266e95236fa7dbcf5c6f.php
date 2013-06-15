<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
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
<!--<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21509482"></script>-->
</head>

<body>
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
<div class="midder">
    <?php if(empty($visitor[userid])): ?><div class="anony-nav">
            <div class="bd">
            <div class="reg">
            
            <strong>爱客社区</strong>
            <div>
            <b>爱客网开源社区程序，内容互动性强，交流更方便</b><br><em>简单</em><em>快捷</em><em>方便</em><em>建设本地化，垂直型社区；目前已有<cite><?php echo ($count_user); ?></cite>位用户加入！</em>
            </div>
            <a class="submit" href="<?php echo U('public/user/register');?>">＋加入我们</a>
            <a class="submit" href="<?php echo U('public/help/download');?>">↓源码下载</a>
            </div>
            
            <div class="login">
            <form action="<?php echo U('public/user/login');?>" method="post" name="lzform" id="lzform">
            <fieldset>
            <legend>登录</legend>
            <div class="item">
            <label>Email：</label><input type="email" tabindex="1" value="" name="email" class="txt">
            </div>
            <div class="item">
            <label>密码：</label><input type="password" tabindex="2" class="txt" name="password" > <a href="<?php echo U('public/user/forgetpwd');?>">忘记密码？</a>
            </div>
            
            <div class="item1">
            <label for="form_remember"><input type="checkbox" tabindex="3" id="form_remember" name="remember"> 记住我</label>
            </div>
            <div class="item1">
            <input type="hidden" name="cktime" value="2592000" />
            <input type="submit" tabindex="4" class="submit" value="登录" style="margin-left:10px">
            
            </div>
            </fieldset>
            </form>
            </div>
            
            </div>
        </div><?php endif; ?>

    <div class="mc">
    
        <div class="cleft">
        	<script>
            	$(function(){
					$('#aliimg').attr('src','__PUBLIC__/images/p/aliyun_'+(Math.ceil(Math.random()*3)+'.jpg'));
				})
            </script>
        	<div style="margin-bottom:10px;"><a href="http://www.aliyun.com/cps/rebate?from_uid=7HcNHf+G+v2FyspfxPRCOw==" target="_blank"><img src="__PUBLIC__/images/p/aliyun_1.jpg" style="border-radius:5px;" id="aliimg"/></a></div>
        
            <h2>推荐小组<span class="pl">&nbsp;(<a href="<?php echo U('group/index/explore');?>">全部</a>) </span></h2>
        
            <div style="overflow:hidden;">
            <?php if(is_array($arrRecommendGroup)): foreach($arrRecommendGroup as $key=>$item): ?><div class="sub-item">
            <div class="pic">
            <a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>">
            <img src="<?php echo ($item[icon_48]); ?>" alt="<?php echo ($item[groupname]); ?>">
            </a>
            </div>
            <div class="info">
            <a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a> (<?php echo ($item[count_user]); ?>/<font color="orange"><?php echo ($item[count_topic]); ?></font>)             
            <p><?php echo ($item[groupdesc]); ?></p>
            </div>
            </div><?php endforeach; endif; ?>
            </div>
            <div class="clear"></div>
  
       
            <h2>最热话题<span class="pl">&nbsp;(<a href="<?php echo U('group/index/explore_topic');?>">更多</a>) </span></h2>
            <div class="topic-list">
                <?php if(is_array($arrHotTopic)): foreach($arrHotTopic as $key=>$item): ?><dl>
                    <dt><a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><img src="<?php echo ($item[user][face]); ?>"/></a></dt>
                    <dd>
                        <header class="title"><a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>" title="<?php echo ($time[title]); ?>"><?php echo ($item[title]); ?></a></header>
                         <a href="<?php echo U('space/index/index',array('id'=>$item[user][doname]));?>"><?php echo ($item[user][username]); ?></a> <summary><?php echo getTime($item[addtime],time()) ?> 阅读 <?php echo ($item[count_view]); ?> 评论 <?php echo ($item[count_comment]); ?></summary>
                        <p>
                        <?php if($item[video]): ?><a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>" title="<?php echo ($time[title]); ?>"><img src="<?php echo ($item[video][imgurl]); ?>" class="fr"></a>
                        <?php else: ?>
                        <a href="<?php echo U('group/index/topic',array('id'=>$item[topicid]));?>" title="<?php echo ($time[title]); ?>"><img src="<?php echo ($item[img][simg]); ?>" class="fr"></a><?php endif; ?>
                        <?php echo ($item[content]); ?>
                        </p>
                    </dd>
                </dl><?php endforeach; endif; ?>
            </div>
        
        </div><!--//left-->
    
        <div class="cright">
            <h2>活跃用户</h2>
            <div class="indent">
            
           <?php if(is_array($arrHotUser)): foreach($arrHotUser as $key=>$item): ?><dl class="obu">
                <dt>
                    <a href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>">
                    <img alt="<?php echo ($item[username]); ?>" class="m_sub_img" src="<?php echo ($item[face]); ?>" width="48" />
                    </a>
                    <?php if($item[isonline] == 1): ?><div class="border-arrow" title="在线用户"></div><?php endif; ?>
                </dt>
                <dd>
                    <a href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>"><?php echo ($item[username]); ?></a>
                </dd>
            </dl><?php endforeach; endif; ?>
            <br clear="all"/>
            </div>

        	<div class="mod">
                <h2>
                        最近流行的应用
                            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
                </h2>
                <div class="th-app-pop">
                     <ul>
                     	<?php if(is_array($arrpopApp)): foreach($arrpopApp as $key=>$item): ?><li class="common-item">
                         <div class="pic">
                             <a href="<?php echo U('develop/index/show',array('id'=>$item[appid]));?>"><img width="48" src="<?php echo ($item[icon_100]); ?>"></a>
                         </div>
                         <div class="info">
                             <div class="title">
                               <a href="<?php echo U('develop/index/show',array('id'=>$item[appid]));?>"><?php echo ($item[title]); ?></a>
                             </div>
                             <div class="favs"><?php echo ($item[count_down]); ?>人用过 / <?php echo ($item[cate][catename]); ?></div>
                         </div>
                         </li><?php endforeach; endif; ?>
                     </ul>
                </div> 
            </div><!--//mod-->  
            
            <h2>最新创建小组&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·<span class="pl">&nbsp;(<a href="<?php echo U('group/index/explore');?>">全部</a>) </span></h2>
            <div class="line23">
            <?php if(is_array($arrNewGroup)): foreach($arrNewGroup as $key=>$item): ?><a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a> (<?php echo ($item[count_user]); if($item[uptime] > strtotime(date('Y-m-d 00:00:00'))): ?>/<font color="orange"><?php echo ($item[count_topic_today]); ?></font><?php endif; ?>)<br><?php endforeach; endif; ?>
            </div>

			<h2>最新文章&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·<span class="pl">&nbsp;(<a href="<?php echo U('article/index/index');?>">全部</a>) </span></h2>
			<div class="line23">
			<?php if(is_array($arrNewArticle)): foreach($arrNewArticle as $key=>$item): ?><a href="<?php echo U('article/index/show',array('id'=>$item[itemid]));?>"><?php echo ($item[title]); ?></a><br><?php endforeach; endif; ?>
			</div>
            
          
            

        
        
            <div class="clear"></div>
        </div><!--//right-->
    
    </div><!--//mc-->
</div><!--//midder-->
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
        <font color="green">ThinkPHP版本<?php echo (THINK_VERSION); ?></font>  目前有 <?php echo ($count_online_user); ?> 人在线 <script src="http://s6.cnzz.com/stat.php?id=5262498&web_id=5262498" language="JavaScript"></script><br />
        <span style="font-size:0.83em;">{__RUNTIME__}          </span>

        
       
        </p>   
    </div>
</div>
</footer>
<div id="styleBox"><a href="<?php echo U('public/index/style');?>">风格设置</a></div>
</body>
</html>