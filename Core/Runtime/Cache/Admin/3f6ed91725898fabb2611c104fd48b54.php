<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="160780470@qq.com" />
<meta name="Copyright" content="<?php echo ($ikphp["ikphp_site_name"]); ?>" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" type="text/css" href="__APP_STATIC__/css/style.css" />
<script src="__PUBLIC__/js/jquery.js" type="text/javascript"></script>
<script src="__APP_STATIC__/js/common.js" type="text/javascript"></script>
</head>
<body>
<div class="midder">
<h2><?php echo ($title); ?></h2>
    <div>
    <form action="__GROUP__/setting/url" method="post">
    <table>
        <tr>
            <td width="100">形式1：</td>
            <td>
            <?php if($config[URL_MODEL] == 0): ?><label><input type="radio" name="url_model" value="0" checked="select"/> index.php?m=article&a=show&id=1 </label>
            <?php else: ?>
            <label><input type="radio" name="url_model" value="0" /> index.php?m=article&a=show&id=1 </label><?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>形式2：</td>
            <td>
             <?php if($config[URL_MODEL] == 1): ?><label><input type="radio" name="url_model" value="1" checked="select"/>
            http://www.ikphp.com/index.php/article/show/id/1 (暂只支持apache环境的rewrite，非apache环境勿动)
            </label>
            <?php else: ?>
            <label><input type="radio" name="url_model" value="1" />
            http://www.ikphp.com/index.php/article/show/id/1 (暂只支持apache环境的rewrite，非apache环境勿动)
            </label><?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>形式3：</td>
            <td>
             <?php if($config[URL_MODEL] == 2): ?><label><input type="radio" name="url_model" value="2" checked="select"/>
            http://www.ikphp.com/article/show/id/1 (暂只支持apache环境的rewrite，非apache环境勿动)
            </label>
            <?php else: ?>
            <label><input type="radio" name="url_model" value="2" />
            http://www.ikphp.com/article/show/id/1 (暂只支持apache环境的rewrite，非apache环境勿动)
            </label><?php endif; ?>
            </td>
        </tr>                   
    </table>
    <div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>
    </form>
    </div>

</div>
</body>
</html>