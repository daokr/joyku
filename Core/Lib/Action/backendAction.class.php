<?php

class backendAction extends Action {

    function _initialize() {
    	//C ( 'SHOW_RUN_TIME', false ); // 运行时间显示
    	//C ( 'SHOW_PAGE_TRACE', false );
    	//消除所有的magic_quotes_gpc转义
    	import("ORG.Util.Input");
    	import("ORG.Util.Page");
    	import("ORG.Util.Dir");
    	Input::noGPC();
    	//初始化网站配置
    	$this->fcache('setting');  	
        //检查认证识别号
        if ( 'public' != strtolower(MODULE_NAME)) {
	        if(!isset($_SESSION[C('USER_AUTH_KEY')])) { 
	            $this->redirect('admin/public/login');
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
        //当前app名称
        $this->assign('module_name',strtolower(MODULE_NAME));
        //当前action名称
        $this->assign('action_name',strtolower(ACTION_NAME));
        //网站后台导航栏
        $this->app_mod = D ( 'app' );
        $this->assign('admin_top_nav', $this->_getAdminNav());
        
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
    /**
     * 后台台分页统一
     */
    protected function _pager($count, $pagesize) {
    	$pager = new Page($count, $pagesize);
    	$pager->rollPage = 10;
    	$pager->setConfig('prev', '<前页');
    	$pager->setConfig('next', '后页>');
    	$pager->setConfig('theme', '%upPage% %first% %linkPage% %end% %downPage%');
    	return $pager;
    }
    /**
     * 后台App导航菜单
     *
     */
    protected function _getAdminNav(){
    	$arrApp = $this->app_mod->field('app_name,app_alias,admin_entry')->order(array('display_order asc'))->select();
    	return $arrApp;
    }
    //新增一个写缓存的方法
    protected function fcache($filename){
    	if (!empty($filename) && false === $setting = F($filename)) {
    		$res = M($filename)->getField('name,data');
    		foreach ($res as $key=>$val) {
    			$setting['ik_'.$key] = unserialize($val) ? unserialize($val) : $val;
    		}
    		F($filename,$setting);//写缓存
    	}
    	C(F($filename));//读缓存配置
    }

}