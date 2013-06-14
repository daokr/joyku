<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="160780470@qq.com" />
<meta name="Copyright" content="<?php echo ($ikphp["ikphp_site_name"]); ?>" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" type="text/css" href="__ADMIN_STATIC__/css/style.css" />
<script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script src="__ADMIN_STATIC__/js/common.js" type="text/javascript"></script>
</head>
<body>
<div class="midder">
<h2><?php echo ($title); ?></h2>
    <div>
    <form action="__GROUP__/setting/theme" method="post">
    <ul class="themelist">
       <?php if(is_array($arrTheme)): $i = 0; $__LIST__ = $arrTheme;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <label>
            <img src="__PUBLIC__/theme/<?php echo ($vo); ?>/preview.jpg"><br />
            	<?php if(C('ik_site_theme') == $vo): ?><input type="radio" checked="checked" name="site_theme" value="<?php echo ($vo); ?>" /> <?php echo ($vo); ?>
                <?php else: ?>
                <input type="radio" name="site_theme" value="<?php echo ($vo); ?>" /> <?php echo ($vo); endif; ?>
            </label>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>	
    </ul>

    <div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>
    </form>
    </div>

</div>
</body>
</html>