<?php
/**
 * 前台控制器基类
 *
 * @author 小麦
 */
class frontendAction extends baseAction {

    protected $visitor = null;
    
    public function _initialize() {
        parent::_initialize();
        //网站状态
        //初始化访问者
        $this->_init_visitor();
        $this->app_mod = D('app');
        //第三方登陆模块
        //$this->_assign_oauth();
        //网站导航选中
        //$this->assign('nav_curr', '');
        //判断是否已被卸载
        $this->_isuninstall($this->app_name);
        //网站导航
        $this->assign('topNav',$this->_topnav());
        $this->assign('arrNav',$this->_nav($this->app_name));
        $this->assign('logo',$this->_navlogo($this->app_name));
    }
    /**
     * 初始化访问者
     */
    private function _init_visitor() {
    	$this->visitor = new user_visitor();
    	$userid = $this->visitor->info['userid'];
    	$count_msg_unread = D('message')->where(array('touserid'=>$userid,'isread'=>0,'isinbox'=>0))->count();
    	$count_new_msg = $count_msg_unread>0 ? $count_msg_unread : 0;
    	$this->assign('count_new_msg', $count_new_msg);
    	$this->assign('visitor', $this->visitor->info);
    	$this->assign('count_online_user', $this->visitor->getOnlineUserCount());
    }
    /**
     * 连接用户中心
     */
    protected function _user_server() {
    	$passport = new passport(C('ik_integrate_code'));
    	return $passport;
    }
    /**
     * SEO设置
     */
    protected function _config_seo($seo_info = array(), $data = array()) {
    	$page_seo = array(
    			'title' => C('ik_site_title'),
    			'subtitle' => C('ik_site_subtitle'),
    			'keywords' => C('ik_site_keywords'),
    			'description' => C('ik_site_desc')
    	);
    	$page_seo = array_merge($page_seo, $seo_info);
    	//开始替换
    	$searchs = array('{site_name}', '{site_title}', '{site_keywords}', '{site_desc');
    	$replaces = array(C('ik_site_title'), C('ik_site_subtitle'), C('ik_site_keywords'), C('ik_site_desc'));
    	preg_match_all("/\{([a-z0-9_-]+?)\}/", implode(' ', array_values($page_seo)), $pageparams);
    	if ($pageparams) {
    		foreach ($pageparams[1] as $var) {
    			$searchs[] = '{' . $var . '}';
    			$replaces[] = $data[$var] ? strip_tags($data[$var]) : '';
    		}
    		//符号
    		$searchspace = array('((\s*\-\s*)+)', '((\s*\,\s*)+)', '((\s*\|\s*)+)', '((\s*\t\s*)+)', '((\s*_\s*)+)');
    		$replacespace = array('-', ',', '|', ' ', '_');
    		foreach ($page_seo as $key => $val) {
    			$page_seo[$key] = trim(preg_replace($searchspace, $replacespace, str_replace($searchs, $replaces, $val)), ' ,-|_');
    		}
    	}
    	$this->assign('seo', $page_seo);
    }
    /**
     * 前台分页统一
     */
    protected function _pager($count, $pagesize) {
    	$pager = new Page($count, $pagesize);
    	$pager->rollPage = 5;
    	$pager->setConfig('prev', '<前页');
    	$pager->setConfig('next', '后页>');
    	$pager->setConfig('theme', '%upPage% %first% %linkPage% %end% %downPage%');
    	return $pager;
    } 
    // 顶部次导航
    protected  function _topnav(){
    	$arrNav = array ();
		$arrNav['index'] = array('name'=>'首页', 'url'=>C('ik_site_url'));
		$arrApp = $this->app_mod->field('app_name,app_alias,app_entry')->where(array('status'=>'1'))->order(array('display_order asc'))->select();
		foreach($arrApp as $item){
			if(empty($item['app_entry'])){
				$item['app_entry'] = 'index/index';
			}
			$arrNav[$item['app_name']] = array('name'=>$item['app_alias'], 'url'=>U($item['app_name'].'/'.$item['app_entry']));
		}
    	return $arrNav; 	
    }
	// 网站主导航
	protected  function _nav($app_name){
		if (! empty ( $app_name ) && $app_name == 'public') {
			$arrNav = array ();
			$arrNav['index'] = array('name'=>'首页', 'url'=>C('ik_site_url'));
			$arrApp = $this->app_mod->field('app_name,app_alias,app_entry')->where(array('status'=>'1'))->order(array('display_order asc'))->select();
			foreach($arrApp as $item){
				if(empty($item['app_entry'])){
					$item['app_entry'] = 'index/index';
				}
				$arrNav[$item['app_name']] = array('name'=>$item['app_alias'], 'url'=>U($item['app_name'].'/'.$item['app_entry']));
			}
			return $arrNav;
		}		
	}
	// 导航logo
	protected  function _navlogo($app_name){
		if (! empty ( $app_name )) {
			$arrLogo = array ();
			$strApp = $this->app_mod->where(array('app_name'=>$app_name))->find();
			if($strApp){
				$arrLogo = array('name'=>$strApp['app_alias'], 'url'=>U($app_name.'/'.$strApp['app_entry']), 'style'=>'site_logo nav_logo');
			}else{
				$arrLogo = array('name'=>'爱客开源', 'url'=>C('ik_site_url'), 'style'=>'site_logo');
			}
			return $arrLogo;
		}
	}
	// 判断应用是否已被卸载
	protected  function _isuninstall($app_name){
		if (! empty ( $app_name ) && !in_array($app_name, C('DEFAULT_APPS'))) {
			$strApp = $this->app_mod->where(array('app_name'=>$app_name,'status'=>'1'))->find();
			if(!$strApp){
				$this->error('厄，该应用不存在哦！或已被禁用！');
			}
		}
	}
  
}