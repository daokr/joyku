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
        //APP静态文件地址
        $replace['__APP_STATIC__'] = __ROOT__.'/Core/Apps/'.GROUP_NAME.'/Static';
        
        $content = str_replace(array_keys($replace),array_values($replace),$content);
        return $content;
    }
}