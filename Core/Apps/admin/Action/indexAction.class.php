<?php
class indexAction extends backendAction {
	// 检查用户是否登录
	protected function checkUser() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->error('没有登录',__GROUP__.'/index/login');
		}
	}
	//左侧菜单
	public function left() {
	
		$ik = $this->_get ( 'ik', 'trim' );
		if(empty($ik)){
			$ik = 'index';
		}
		//生成应用管理菜单 获取 应用Tpl 下的left_menu.html
	
/* 		$filename = APPS_PATH . '/' . $ik . '/Appinfo/admin_menu.php';
		if(is_file($filename)){
			$info = include_once $filename;
			foreach ($info as $key=>$item){
				echo $item['submenu']['name'];
	
			}
		} */
		 
		$this->assign('ik', $ik);
		$this->display();
	}	
	public function main(){
		// 检测文件夹权限
		$message = array();
		if (is_dir('./install')) {
			$message[] = array(
					'type' => 'error',
					'content' => "您还没有删除 install 文件夹，出于安全的考虑，我们建议您删除 install 文件夹。",
			);
		}
		if (APP_DEBUG == true) {
			$message[] = array(
					'type' => 'error',
					'content' => "您网站的 DEBUG 没有关闭，出于安全考虑，我们建议您关闭程序 DEBUG。",
			);
		}
		if (!function_exists("curl_getinfo")) {
			$message[] = array(
					'type' => 'error',
					'content' => "系统不支持 CURL ,将无法采集数据。",
			);
		}
		$this->assign('message', $message);
		//gd版本信息
		if (! function_exists ( "gd_info" )) {
			$gd = '不支持,无法处理图像';
		}
		if (function_exists ( gd_info )) {
			$gd = @gd_info ();
			$gd = $gd ["GD Version"];
			$gd ? '&nbsp; 版本：' . $gd : '';
		}
		$system = array(
				'pinphp_version' => IKPHP_VERSION . ' RELEASE '. IKPHP_RELEASE .' [<a href="'.IKPHP_SITEURL.'" class="blue" target="_blank">查看最新版本</a>]',
				'server_domain' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
				'server_os' => PHP_OS,
				'web_server' => $_SERVER["SERVER_SOFTWARE"],
				'php_version' => PHP_VERSION,
				'mysql_ver' => mysql_get_server_info (),
				'server_language' => $_SERVER[HTTP_ACCEPT_LANGUAGE],
				'gd_info' => $gd,
				'document_root' => $_SERVER[DOCUMENT_ROOT],
				'upload_max_filesize' => '表单允许' . ini_get ( 'post_max_size' ) . '，上传总大小' . ini_get ( 'upload_max_filesize' ),
				'max_execution_time' => ini_get('max_execution_time') . '秒',
				'safe_mode' => (boolean) ini_get('safe_mode') ?  L('yes') : L('no'),
				'zlib' => $_SERVER[HTTP_ACCEPT_ENCODING],
				'curl' => function_exists("curl_getinfo") ? L('yes') : L('no'),
				'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no')
		);
		$this->assign('system', $system);
		$this->display();
	
	}
}