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
                            <div class="opt"><a style="margin-left:10px; margin-right:10px" target="_blank" href="<?php echo U('public/oauth/index', array('mod'=>'qq'));?>"><img align="absmiddle" src="__PUBLIC__/images/connect_qq.png" title="QQ登录"> 登录</a> | <a style="margin-left:10px" target="_blank" href="<?php echo U('public/oauth/index', array('mod'=>'sina'));?>"><img align="absmiddle" src="__PUBLIC__/images/connect_sina_weibo.png" title="新浪微博"> 登录</a> | <a style="margin-left:10px" target="_blank" href="https://www.douban.com/service/auth2/auth?

client_id=06a4db86856445d313ee9293902cd179&redirect_uri=http://www.ikphp.com&response_type=token&scope=douban_basic_common"><img align="absmiddle" src="__PUBLIC__/images/connect_douban.png" title="豆瓣登录"> 登录</a></div>
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
        	活跃用户
            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
            <!--<span class="pl">&nbsp;(
                    <a href="#">更多</a>
                ) </span>-->
    		</h2>
			<div class="online">
				<?php if(is_array($arrHotUser)): foreach($arrHotUser as $key=>$item): ?><dl class="obu">
	                <dt>
	                    <a href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>">
	                    <img alt="<?php echo ($item[username]); ?>" class="m_sub_img" src="<?php echo ($item[face]); ?>" width="48" />
	                    </a>
	                    <?php if($item[isonline] == 1): ?><div class="border-arrow" title="在线用户"></div><?php endif; ?>
	                </dt>
	                <dd>
	                    <div class="uname"><a href="<?php echo U('space/index/index',array('id'=>$item[doname]));?>"><?php echo ($item[username]); ?></a></div>
                        <span class="follow"><?php echo ($item[count_follow]); ?> 人关注</span>
	                </dd>
	            </dl><?php endforeach; endif; ?>
                <br clear="all">
			</div>
            
        </div>
        <div class="main">
        	<div class="mod">
				<h2>
			        热点内容
			            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
			    </h2>
				<div class="albums">
				    <ul>
                      <?php if(is_array($arrPhoto)): foreach($arrPhoto as $key=>$item): ?><li>
				      <div class="pic">
				          <a href="<?php echo U('space/photos/album',array('id'=>$item['albumid']));?>"><img alt="" data-origin="#" src="<?php echo ($item[simg]); ?>"></a>
				      </div>
				      <div class="tit"><a href="<?php echo U('space/photos/album',array('id'=>$item['albumid']));?>"><?php echo ($item[albumname]); ?></a></div>
				      <span class="num"><?php echo ($item[count_photo]); ?> 张照片</span>
				      </li><?php endforeach; endif; ?>                                                                
				    </ul>
				</div>
  				<div class="notes">
					<ul>
                    <?php if(is_array($arrNote)): foreach($arrNote as $key=>$item): if($key < 2): ?><li>
                        <div class="title">
                            <span class="author">
                            <?php echo ($item[user][username]); ?>的日记
                            </span><a href="<?php echo U('space/notes/show',array('id'=>$item[noteid]));?>"><?php echo ($item[title]); ?></a>
                        </div>
                        <p><?php echo getsubstrutf8(t($item[content]),0,50); ?>...</p>
                        </li>
                    	<?php else: ?>
						<li><a href="<?php echo U('space/notes/show',array('id'=>$item[noteid]));?>"><?php echo ($item[title]); ?></a></li><?php endif; endforeach; endif; ?>
					</ul>
				</div>
  
                  
        	</div>
        </div>
    </div>
</div>


<!--小组-->
<div id="anony-group" class="section">
	<div class="wrapper">
    	<div class="sidenav">
			  <h2 class="section-title"><a href="<?php echo U('group/index');?>">小组</a></h2>
			  <div class="side-links nav-anon">
			      <ul>
					<li><a href="<?php echo U('group/index/explore');?>">发现小组</a></li>
					<li><a href="<?php echo U('group/index/explore_topic');?>">发现话题</a></li>
                    <li><a href="<?php echo U('group/index/nearby');?>">北京话题</a></li>      
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
				······
				<span class="pl">&nbsp;(
				        <a href="<?php echo U('group/index/explore');?>">更多</a>
				    ) </span>
				</h2>
    			<div class="mod">
	            <?php if(is_array($arrRecommendGroup)): foreach($arrRecommendGroup as $key=>$item): ?><div class="sub-item">
	            <div class="pic">
	            <a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>">
	            <img src="<?php echo ($item[icon_48]); ?>" alt="<?php echo ($item[groupname]); ?>" width="48" height="48">
	            </a>
	            </div>
	            <div class="info">
	            <a href="<?php echo U('group/index/show',array('id'=>$item[groupid]));?>"><?php echo ($item[groupname]); ?></a> (<?php echo ($item[count_user]); ?>/<font color="orange"><?php echo ($item[count_topic]); ?></font>)             
	            <p><?php echo ($item[groupdesc]); ?></p>
	            </div>
	            </div><?php endforeach; endif; ?>                
                </div>                                                                                                                                                                              
        </div>

    </div>
</div>

<!--文章-->
<div id="anony-article" class="section">
	<div class="wrapper">
    	<div class="sidenav">
			  <h2 class="section-title"><a href="<?php echo U('article/index/index');?>">阅读</a></h2>
			  <div class="side-links nav-anon">
			      <ul>
					<?php if(is_array($articleChannel)): foreach($articleChannel as $key=>$item): ?><li><a href="<?php echo U('article/index/channel',array('nameid'=>$item[nameid]));?>"><?php echo ($item[name]); ?></a></li><?php endforeach; endif; ?>  
			      </ul>
			  </div>
		</div> 
        <div class="side">
		<div class="mod">
		
		    <h2>
		        热门标签
		            &nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·
		    </h2>
		
            <div class="article-cate-mod">
            <div class="cate article-cate">
              <ul>
              <li class="cate-label">[文学]</li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'小说'));?>">小说</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'随笔'));?>">随笔</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'散文'));?>">散文</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'日本文学'));?>">日本文学</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'童话'));?>">童话</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'诗歌'));?>">诗歌</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'名著'));?>">名著</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'港台'));?>">港台</a></li>
              </ul>
            </div>
            <div class="cate article-cate">
              <ul>
              <li class="cate-label">[趣味]</li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'漫画'));?>">漫画</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'绘本'));?>">绘本</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'推理'));?>">推理</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'青春'));?>">青春</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'言情'));?>">言情</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'科幻'));?>">科幻</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'武侠'));?>">武侠</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'奇幻'));?>">奇幻</a></li>
              </ul>
            </div>
            <div class="cate article-cate">
              <ul>
              <li class="cate-label">[文化]</li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'历史'));?>">历史</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'哲学'));?>">哲学</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'传记'));?>">传记</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'设计'));?>">设计</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'建筑'));?>">建筑</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'电影'));?>">电影</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'回忆录'));?>">回忆录</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'音乐'));?>">音乐</a></li>
              </ul>
            </div>
            <div class="cate article-cate">
              <ul>
              <li class="cate-label">[生活]</li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'旅行'));?>">旅行</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'励志'));?>">励志</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'职场'));?>">职场</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'美食'));?>">美食</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'教育'));?>">教育</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'灵修'));?>">灵修</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'健康'));?>">健康</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'家居'));?>">家居</a></li>
              </ul>
            </div>

            <div class="cate article-cate">
              <ul>
              <li class="cate-label">[科技]</li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'科普'));?>">科普</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'互联网'));?>">互联网</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'编程'));?>">编程</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'交互设计'));?>">交互设计</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'算法'));?>">算法</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'通信'));?>">通信</a></li>
              <li><a href="<?php echo U('article/index/explore',array('tag'=>'神经网络'));?>">神经网络</a></li>
              </ul>
            </div>
            </div>		   
           
		</div>
		</div>
        <div class="main">
        	<div class="mod">
            
            	<?php if(is_array($arrArticle)): foreach($arrArticle as $key=>$item): ?><div class="artitem">
	            	<h2 class="content-title"><?php echo ($item[cname]); ?></h2>
					<ul class="artlist">
                   		<?php if(is_array($item["alist"])): foreach($item["alist"] as $key=>$aitem): if($key == 0): ?><li class="first">
                        	
	                    	<div class="pic">
                               
                                <a href="<?php echo U('article/index/show',array('id'=>$aitem[aid]));?>">
                                    <img width="135" height="90" alt="" src="<?php echo ($aitem[photo][simg]); ?>">
                                </a>
	                        </div>
                            
					        <div class="cont">
					            <h3><a title=""  href="<?php echo U('article/index/show',array('id'=>$aitem[aid]));?>">
                                <?php echo getsubstrutf8(t($aitem[title]),0,20); ?>
                                </a>
                                </h3>
					            <p><?php echo getsubstrutf8(t($aitem[content]),0,20); ?> <a href="<?php echo U('article/index/show',array('id'=>$aitem[aid]));?>">详细</a></p>
					        </div>
					    </li>
                        <?php else: ?>
					    <li><a title="#" href="<?php echo U('article/index/show',array('id'=>$aitem[aid]));?>">
                        <?php echo getsubstrutf8(t($aitem[title]),0,20); ?></a></li><?php endif; endforeach; endif; ?>
					</ul>
                    
                </div><?php endforeach; endif; ?>

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
				        <a href="<?php echo U('location/event/lists');?>">同城活动</a>
				    </li>
				    
				    <li>
				        <a href="<?php echo U('location/hosts/explore');?>">主办方</a>
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
					<?php if(is_array($arrEventCateList)): foreach($arrEventCateList as $key=>$item): ?><div class="cate events-cate">
                      <ul>
                        
                        <li class="cate-label"><a href="<?php echo U('location/event/lists',array('type'=>'week-'.$item[parentCate][enname]));?>"><?php echo ($item[parentCate][catename]); ?>»</a></li>
                        <?php if(is_array($item[childCate])): foreach($item[childCate] as $ckey=>$citem): ?><li><a href="<?php echo U('location/event/lists',array('type'=>'week-'.$citem[cateid]));?>"><?php echo ($citem[catename]); ?></a></li><?php endforeach; endif; ?>
                      </ul>
                    </div><?php endforeach; endif; ?>
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
                    <?php if(is_array($hotEvent)): foreach($hotEvent as $key=>$item): ?><li>
					      <div class="pic">
					        <a  href="<?php echo U('location/event/show',array('id'=>$item[eventid]));?>">
					            <img width="70" alt="<?php echo ($item[title]); ?>" src="<?php echo ($item[midimg]); ?>">
					        </a>
					      </div>
					      <div class="info">
					        <div class="title">
					          <a title="<?php echo ($item[title]); ?>"  href="<?php echo U('location/event/show',array('id'=>$item[eventid]));?>">
					            <?php echo ($item[title]); ?>
					          </a>
					        </div>
					        <div class="datetime">
					            <?php echo date('m月',$item[begin_date]); echo date('d日',$item[begin_date]); ?> <?php echo ($item[begin_week_day]); ?> <?php echo ($item[begin_time]); ?> - <?php echo ($item[end_time]); ?>
					        </div>
					        <address title="朝阳北路101号楼朝阳大悦城4F-54 ">
					         <?php echo ($item[street_address]); ?>
					        </address>
					        <div class="follow">
					          10人关注
					        </div>
					      </div>
					    </li><?php endforeach; endif; ?> 
                    	                                                                       
                    </ul>
                </div>
            </div>
            
    </div>
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