<?php

class backendAction extends Action {

    function _initialize() {
    	C ( 'SHOW_RUN_TIME', false ); // 运行时间显示
    	C ( 'SHOW_PAGE_TRACE', false );
        //检查认证识别号
        if ( 'public' != strtolower(MODULE_NAME)) {
	        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
	            redirect(__GROUP__.'/public/login');
	        }
        }
        //网站后台seo
        $this->assign('title','IKPHP网站管理');
        $ik_soft_info = array(
        		'ikphp_version' => IKPHP_VERSION,
        		'ikphp_year' => IKPHP_YEAR,
        		'ikphp_site_name' => IKPHP_SITENAME,
        		'ikphp_site_url' => IKPHP_SITEURL,
        		'ikphp_email' => IKPHP_EMAIL,
        		 
        );
        $this->assign('ikphp', $ik_soft_info);
    }
    protected function title($title){
    	$this->assign('title', $title);
    }
    //更新配置文件
    protected function update_config($new_config, $config_file = '') {
    	if (is_writable($config_file)) {
    		$config = require $config_file;
    		$config = array_merge($config, $new_config);
    		file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
    		@unlink(RUNTIME_FILE);
    		return true;
    	} else {
    		return false;
    	}
    }

}