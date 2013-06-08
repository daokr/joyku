<?php

defined('THINK_PATH') or exit();
/**
 * 行为扩展：模板内容输出替换
 */
class content_replaceBehavior extends Behavior {

    public function run(&$content){
        $content = $this->_replace($content);
    }

    private function _replace($content) {
        $replace = array();
        //爱客专用后台admin 静态文件地址
        $replace['__ADMIN_STATIC__'] = __ROOT__.'/Core/Apps/admin/Static';
        //APP静态文件地址
        $replace['__APP_STATIC__'] = __ROOT__.'/Core/Apps/'.GROUP_NAME.'/Static';
        //网站地址 带 / 如：http://www.ikphp.com/
        $replace['__SITE_URL__'] = C('ik_site_url');
        
        //网站应用风格路径
        $replace['__STATIC_CSS__'] = C('ik_site_url').'Core/Apps/'.GROUP_NAME.'/Static/css';
        //网站应用风格图片路径
        $replace['__STATIC_IMG__'] = C('ik_site_url').'Core/Apps/'.GROUP_NAME.'/Static/images';
        //网站应用风格图片路径
        $replace['__STATIC_JS__'] = C('ik_site_url').'Core/Apps/'.GROUP_NAME.'/Static/js';
        
        //网站基本风格
        $basecss = 'Public/theme/'.C('ik_site_theme').'/base.css';
        //APP风格默认样式
        $appcss = 'Core/Apps/'.GROUP_NAME.'/Static/css/style.css';
        
        //APP风格下的module样式
        $appmodulecss = 'Core/Apps/'.GROUP_NAME.'/Static/css/'.MODULE_NAME.'.css';
        
        if(is_file($basecss)){
        	$sitecss = '@import url('.C('ik_site_url').$basecss.');';
        	
        }
        if(is_file($appcss)){
        	$sitecss .= '@import url('.C('ik_site_url').$appcss.');';
        	
        }
        if(is_file($appmodulecss)){
        	$sitecss .= '@import url('.C('ik_site_url').$appmodulecss.');';
        }
        //开始替换css
        $replace['__SITE_THEME_CSS__'] = $sitecss;
        //扩展js
        $appextendjs = 'Core/Apps/'.GROUP_NAME.'/Static/js/extend.func.js';
        if(is_file($appextendjs)){
        	$replace['__EXTENDS_JS__'] = '<script src="'.C('ik_site_url').$appextendjs.'" type="text/javascript"></script>';
        }else{
        	$replace['__EXTENDS_JS__'] = '';
        }
        
        //APP下的MODULE_NAME 对应的js
        $appmodulejs = 'Core/Apps/'.GROUP_NAME.'/Static/js/'.MODULE_NAME.'.js';
        if(is_file($appmodulejs)){
        	$replace['__EXTENDS_JS__'] .= '<script src="'.C('ik_site_url').$appmodulejs.'" type="text/javascript"></script>';
        }
        
        $content = str_replace(array_keys($replace),array_values($replace),$content);
        return $content;
    }
}