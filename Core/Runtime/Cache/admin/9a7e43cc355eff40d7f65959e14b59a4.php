<?php if (!defined('THINK_PATH')) exit(); if($ik == 'index'): ?><li class="treemenu_on">
    <a style="outline:none;" hidefocus="true" href="javascript:void(0)" class="actuator">系统首页</a>
    <ul class="submenu" style="display: block;">
        <li><a style="outline:none;" hidefocus="true" class="submenuB" href="__GROUP__/index/main" target="MainIframe">首页</a></li>
        <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/cache/index" target="MainIframe">缓存管理</a></li>
        <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/words/lists" target="MainIframe">违禁词过滤</a></li>
        <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/tag/manage" target="MainIframe">标签管理</a></li>
        <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/area/manage" target="MainIframe">区域管理</a></li>
    </ul>   
</li>
<li class="treemenu_on">
    <a style="outline:none;" hidefocus="true" href="javascript:void(0)" class="actuator">前台管理</a>
    <ul class="submenu" style="display: block;">
        <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/home/page" target="MainIframe">单页管理</a></li>
    </ul> 
</li><?php endif; ?>

<?php if($ik == 'setting'): ?><li class="treemenu_on">
    <a style="outline:none;" hidefocus="true" href="javascript:void(0)" class="actuator">全局配置</a>
    <ul class="submenu" style="display: block;">
    <li><a style="outline:none;" hidefocus="true" class="submenuB" href="__GROUP__/setting/index" target="MainIframe">站点设置</a></li>
    <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/setting/url" target="MainIframe">链接形式</a></li>
    <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/setting/theme" target="MainIframe">网站风格</a></li>
    </ul>
</li><?php endif; ?>


<?php if($ik == 'user'): ?><li class="treemenu_on">
    <a style="outline:none;" hidefocus="true" href="javascript:void(0)" class="actuator">用户管理</a>
    <ul class="submenu" style="display: block;">
    <li><a style="outline:none;" hidefocus="true" class="submenuB" href="__GROUP__/user/manage" target="MainIframe">会员列表</a></li>
    <li><a style="outline:none;" hidefocus="true" class="submenuA" href="__GROUP__/user/score" target="MainIframe">积分管理</a></li>
    </ul>
</li><?php endif; ?>

<?php if($ik == 'oauth'): ?><li class="treemenu_on">
    <a style="outline:none;" hidefocus="true" href="javascript:void(0)" class="actuator">第三方应用</a>
    <ul class="submenu" style="display: block;">
    <li><a style="outline:none;" hidefocus="true" class="submenuB" href="<?php echo U('oauth/manage');?>" target="MainIframe">联合登录</a></li>
    <li><a style="outline:none;" hidefocus="true" class="submenuA" href="javascript:alert('开发中');" target="MainIframe">淘宝客</a></li>
    <li><a style="outline:none;" hidefocus="true" class="submenuA" href="javascript:alert('开发中');" target="MainIframe">UCenter</a></li>
    </ul>
</li><?php endif; ?>

<?php if($ik == 'apps'): ?><li class="treemenu_on">
        <a style="outline:none;" hidefocus="true" href="javascript:void(0)" class="actuator">应用管理</a>
        <ul class="submenu" style="display: block;">
        	<li><a style="outline:none;" hidefocus="true" class="submenuB" href="<?php echo U('admin/apps/uninstall');?>" target="MainIframe">未安装的应用</a></li>
        	<li><a style="outline:none;" hidefocus="true" class="submenuA" href="<?php echo U('admin/apps/installed');?>" target="MainIframe">已安装的应用</a></li>
        </ul>
    </li><?php endif; ?>