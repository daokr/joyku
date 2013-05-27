<?php
class publicAction extends Action {
	// 用户登录页面
	public function login() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
		}else{
			$this->redirect('index/index');
		}
	}
	// 用户登出
	public function logout() {
		if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
			$this->success('登出成功！',__URL__.'/login/');
		}else {
			$this->error('已经登出！');
		}
	}
	
	// 登录检测
	public function checkLogin() {
		if(empty($_POST['admin_email'])) {
			$this->error('帐号错误！');
		}elseif (empty($_POST['admin_password'])){
			$this->error('密码必须！');
		}
		//生成认证条件
		$map            =   array();
		// 支持使用绑定帐号登录
		$map['admin_email']	= $_POST['admin_email'];
		$map["status"]	=	array('gt',0);
		$authInfo = M('admin')->where($map)->find();
		//使用用户名、密码和状态的方式进行认证
		if(false === $authInfo) {
			$this->error('帐号不存在或已禁用！');
		}else {
			if($authInfo['password'] != md5($_POST['admin_password'])) {
				$this->error('密码错误！');
			}
			$_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['userid'];
			$_SESSION['email']	=	$authInfo['email'];
			$_SESSION['username']		=	$authInfo['username'];
			$_SESSION['lastLoginTime']		=	$authInfo['last_time'];
			
			//保存登录信息
			M('admin')->where(array('userid'=>$authInfo['userid']))->save(array('last_time'=>time(), 'last_ip'=>get_client_ip()));
			$this->success('登录成功！',__GROUP__.'/index/index');
	
		}
	}

}