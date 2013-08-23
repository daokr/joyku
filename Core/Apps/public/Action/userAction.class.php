<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class userAction extends userbaseAction {
	public function _initialize() {
		parent::_initialize ();
		$this->user_mod = D ( 'user' );
		$this->role_mod = M ( 'user_role' );
			// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'setbase',
				'setcity',
				'setdoname',
				'setface',
				'setpassword',
				'settag',
				'unfollow',
				'userfollow',
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
	}
	public function setbase() {
		
		if (IS_POST) {
			foreach ( $_POST as $key => $val ) {
				$_POST [$key] = Input::deleteHtmlTags ( $val );
			}
			$data ['username'] = $this->_post ( 'username', 'trim' );
			$data ['sex'] = $this->_post ( 'sex', 'intval' );
			$data ['signed'] = $this->_post ( 'signed', 'trim' );
			$data ['address'] = $this->_post ( 'address', 'trim' );
			$data ['phone'] = $this->_post ( 'phone', 'trim' );
			$data ['blog'] = $this->_post ( 'blog', 'trim' );
			$data ['about'] = $this->_post ( 'about', 'trim' );
			
			if (empty ( $data ['username'] )) {
				$this->error ( L ( 'username_not_null' ) );
			}
			if (mb_strlen ( $data ['username'], 'utf8' ) < 2 || mb_strlen ( $data ['username'], 'utf8' ) > 14) {
				$this->error ( L ( 'username_length_tip' ) );
			}
			$user_mod = D ( 'user' );
			$username = $this->visitor->get ( 'username' );
			// 用户名唯一性
			if ($data ['username'] != $username) {
				if ($user_mod->name_exists ( $data ['username'] ))
					$this->error ( L ( 'username_exists' ) );
			}
			if (false !== $user_mod->where ( array (
					'userid' => $this->visitor->info ['userid'] 
			) )->save ( $data )) {
				$this->success ( L ( 'user_info' ) . L ( 'edit_success' ) );
			} else {
				$this->error ( L ( 'user_info' ) . L ( 'edit_failed' ) );
			}
		} else {
			
			$info = $this->visitor->get ();
			$strarea = D ( 'area' )->getArea ( $info ['areaid'] );
			
			$this->assign ( 'info', $info );
			$this->assign ( 'strarea', $strarea );
			$this->_config_seo (array('title'=>'基本设置','subtitle'=>'用户'));
			$this->display ();
		}
	
	}
	
	public function setface() {
		if (IS_POST) {
			
			if (! empty ( $_FILES ['picfile'] )) {
				$data_dir = date ( 'Y/md/H/' );
				$file_name = md5 ( $this->visitor->info ['userid'] );
				//会员头像规格
				$avatar_size = explode(',', C('ik_avatar_size'));
	            //会员头像保存文件夹
	            $uid = abs(intval($this->visitor->info['userid']));
	            $suid = sprintf("%09d", $uid);
	            $dir1 = substr($suid, 0, 3);
	            $dir2 = substr($suid, 3, 2);
	            $dir3 = substr($suid, 5, 2);
	            $avatar_dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
	            //上传头像
	            $result = savelocalfile($_FILES['picfile'],'face/'.$avatar_dir,array('width'=>C('ik_avatar_size'),'height'=>C('ik_avatar_size')),
	            		array('jpg','gif','png'),
	            		md5($uid));
				
			    if ($result['error']) {
	                $this->error($result['error']);
	            } else {
					$this->success('头像修改成功！');
	            }	
			}
			
		}else{
			$info = $this->visitor->get ();
			$this->assign ( 'info', $info );
			$this->_config_seo (array('title'=>'会员头像','subtitle'=>'用户'));
			$this->display ();			
		} 
	}
	public function setdoname() {
		$userid = $this->userid;
		$strUser = $this->user_mod->getOneUser($userid);
		
		if (IS_POST) {
			$doname = $this->_post ( 'doname', 'trim' );
			if(empty($doname))
			{
				$this->error ("个性域名不能为空！");
			}else if(strlen($doname)<2)
			{
				$this->error ("个性域名至少要2位数字、字母、或下划线(_)组成！");
			
			}else if(!preg_match ( '/^[a-zA-Z]{1}[a-zA-Z0-9\-_]{0,14}$/', $doname ))
			{
				$this->error ("个性域名必须是数字、字母或下划线(_)组成！");
			}
			$ishave = $this->user_mod->haveDoname($doname);
			if($ishave)
			{
				$this->error ("该域名已经被其他人抢注了,请试试别的吧！");
			}else{
				$this->user_mod->where(array('userid'=>$userid))->save(array('doname'=>$doname));
				$this->error ("个性域名修改成功！");
			}
		
		} else {
			$this->assign ( 'strUser', $strUser );
			$this->_config_seo (array('title'=>'个性域名','subtitle'=>'用户'));
			$this->display ();	
		}
	}
	public function setcity() {
		if (IS_POST) {
			
			$user_mod = D ( 'user' );
			$oneid = $this->_post ( 'oneid', 'intval' );
			$twoid = $this->_post ( 'twoid', 'intval' );
			$threeid = $this->_post ( 'threeid', 'intval' );
			
			if ($oneid != 0 && $twoid == 0 && $threeid == 0) {
				$areaid = $oneid;
			} elseif ($oneid != 0 && $twoid != 0 && $threeid == 0) {
				$areaid = $twoid;
			} elseif ($oneid != 0 && $twoid != 0 && $threeid != 0) {
				$areaid = $threeid;
			} else {
				$areaid = 0;
			}
			
			if (false !== $user_mod->where ( array (
					'userid' => $this->visitor->info ['userid'] 
			) )->save ( array (
					'areaid' => $areaid 
			) )) {
				$this->success ( L ( 'user_area' ) . L ( 'edit_success' ) );
			} else {
				$this->error ( L ( 'user_area' ) . L ( 'edit_failed' ) );
			}
		
		} else {
			$info = $this->visitor->get ();
			$area_mod = D ( 'area' );
			$strarea = $area_mod->getArea ( $info ['areaid'] );
			// 调出省份数据
			$arrOne = $area_mod->getReferArea ( 0 );
			
			$this->assign ( 'strarea', $strarea );
			$this->assign ( 'arrOne', $arrOne );
			$this->_config_seo (array('title'=>'常居地修改','subtitle'=>'用户'));
			$this->display ();
		}
	}
	public function area() {
		$type = $this->_get ( 'ik' );
		$oneid = $this->_get ( 'oneid' );
		$area_mod = D ( 'area' );
		switch ($type) {
			case 'two' :
				$arrArea = $area_mod->getReferArea ( $oneid );
				if ($arrArea) {
					echo '<select id="twoid" name="twoid" class="txt">';
					echo '<option value="0">请选择</option>';
					foreach ( $arrArea as $item ) {
						echo '<option value="' . $item ['areaid'] . '">' . $item ['areaname'] . '</option>';
					}
					echo "</select>";
				} else {
					echo '';
				}
				break;
			
			case 'three' :
				$twoid = $this->_get ( 'twoid' );
				$arrArea = $area_mod->getReferArea ( $twoid );
				if ($arrArea) {
					echo '<select id="threeid" name="threeid" class="txt">';
					echo '<option value="0">请选择</option>';
					foreach ( $arrArea as $item ) {
						echo '<option value="' . $item ['areaid'] . '">' . $item ['areaname'] . '</option>';
					}
					echo "</select>";
				} else {
					echo '';
				}
				break;
		}
	}

	public function setpassword() {
		$userid = $this->userid;
		if($userid == 0) $this->error ('你应该出发去火星报到啦。');
		$strUser = $this->user_mod->getOneUser($userid);
		
		if (IS_POST) {
			$oldpwd = $this->_post('oldpwd','trim');
			$newpwd = $this->_post('newpwd','trim');
			$renewpwd = $this->_post('renewpwd','trim');
			
			if($newpwd != $renewpwd) $this->error('两次输入新密码密码不一样！');
			if($newpwd=='' || $renewpwd=='')  $this->error ("所有项都不能为空！");
			$count_user_bind = M('user_bind')->where(array('uid'=>$userid))->count('*');
			if($count_user_bind>0 && md5(md5('')) == $strUser['password']){
				//如果第三方
				//更新密码
				$this->user_mod->where(array('userid'=>$userid))->save(array('password'=>md5($newpwd)));
				
			}else{
				if($oldpwd == '')  $this->error ("旧密码不能为空！");
				if(md5($oldpwd) != $strUser['password']) $this->error("旧密码输入有误！");
				$this->user_mod->where(array('userid'=>$userid))->save(array('password'=>md5($newpwd)));
			}
			
			$this->success("密码修改成功！");
			
		} else {
			$count_user_bind = M('user_bind')->where(array('uid'=>$userid))->count('*');
			if($count_user_bind>0 &&  md5(md5('')) == $strUser['password']){
				$ispassword = false;
			}else{
				$ispassword = true;
			}
			$this->assign('ispassword',$ispassword);
			$this->assign('strUser',$strUser);
			$this->_config_seo (array('title'=>'密码修改','subtitle'=>'用户'));
			$this->display ();
		}
	}
	
	public function login() {
		$this->visitor->is_login && $this->redirect ( 'space/index/index', array (
				'id' => $this->visitor->info ['doname'] 
		) );
		if (IS_POST) {
			$email = $this->_post ( 'email', 'trim' );
			$password = $this->_post ( 'password', 'trim' );
			if (empty ( $email )) {
				$this->error ( L ( 'email_not_null' ) );
			}
			if (empty ( $password )) {
				$this->error ( L ( 'password_not_null' ) );
			}
			// 连接用户中心
			$passport = $this->_user_server ();
			$uid = $passport->auth ( $email, $password );
			if (! $uid) {
				$this->error ( $passport->get_error () );
			}
			//权限控制
			if($uid>0){
				$query = $this->user_mod->field('isenable')->where(array('userid'=>$uid))->find();
				if($query['isenable']==1){
					$this->error('由于你在该网站发布不良信息或其他错误操作，该账号已经被冻结！如有请疑问联系站长！');
					exit();
				}
			}
			// 登陆
			$this->visitor->login ( $uid );
			// 登陆完成钩子
			$tag_arg = array (
					'uid' => $uid,
					'uname' => $this->visitor->info['username'],
					'action' => 'login',
					'actionname' => '登录'
			);
			tag ( 'login_end', $tag_arg );
			// 同步登陆
			$synlogin = $passport->synlogin ( $uid );
			// 跳转到登陆前页面（执行同步操作）
			$ret_url = $this->_post ( 'ret_url', 'trim', C('ik_site_url'));
			//header ( "Location: " . $ret_url);
			$this->redirect($ret_url);
		
		} else {
			// 来路
			$ret_url = isset ( $_SERVER ['HTTP_REFERER'] ) ? $_SERVER ['HTTP_REFERER'] : __APP__;
			$this->assign ( 'ret_url', $ret_url );
			
			$this->_config_seo ( array (
					'title' => '会员登录'
			) );
			$this->display ();
		}
	}
	public function register() {
		$this->visitor->is_login && $this->redirect ( 'space/index/index', array (
				'id' => $this->visitor->info ['doname'] 
		) );
		if (IS_POST) {
			//快捷注册
			$simple = $this->_get ( 'simple', 'trim', 0);
			
			$captcha = $this->_post ( 'authcode', 'trim' );
			$username = $this->_post ( 'username', 'trim' );
			$email = $this->_post ( 'email', 'trim' );
			$password = $this->_post ( 'password', 'trim' );
			$repassword = $this->_post ( 'repassword', 'trim' );
			//简单注册没有二次密码
			
			if($simple == 0){
				if ($password != $repassword) {
					$this->error ( L ( 'inconsistent_password' ) ); // 确认密码
				}
			}
			if (empty($username)){
				$this->error('用户名名称不能为空!');
			}elseif (empty($email)){
				$this->error('Email不能为空!');
			}elseif (empty($captcha)){
				$this->error('验证码不能为空!');
			}
			if(session('authcode') != md5($_POST['authcode'])) {
				$this->error('验证码错误！');
			}
			// 连接用户中心
			$passport = $this->_user_server ();
			// 注册
			$uid = $passport->register ( $username, $password, $email );
			//修复bug 禁用js用户可以登录
			!$uid && $this->error($passport->get_error());
			// 注册完成钩子 改变积分
			$tag_arg = array (
					'uid' => $uid,
					'uname' => $username,
					'action' => 'register',
					'actionname' => '注册'
			);
			tag ( 'register_end', $tag_arg );
			// 登陆
			$this->visitor->login ( $uid );
			// 登陆完成钩子
			$tag_arg = array (
					'uid' => $uid,
					'uname' => $username,
					'action' => 'login',
					'actionname' => '登录'
			);
			tag ( 'login_end', $tag_arg );
			// 同步登陆
			$synlogin = $passport->synlogin ( $uid );
			$this->redirect ( 'space/index/index', array (
					'id' => $this->visitor->info ['doname'] 
			) );
		} else {
			$this->_config_seo ( array (
					'title' => '会员注册'
			) );
			$this->display ();
		}
	}
	/**
	 * 检测用户
	 */
	public function check() {
		$type = $this->_get ( 't' );
		$user_mod = D ( 'user' );
		switch ($type) {
			case 'email' :
				$email = $this->_get ( 'email', 'trim' );
				echo $user_mod->email_exists ( $email ) ? 'false' : 'true';
				break;
			
			case 'username' :
				$username = $this->_get ( 'username', 'trim' );
				echo $user_mod->name_exists ( $username ) ? 'false' : 'true';
				break;
		}
	}
	/**
	 * 用户退出
	 */
	public function logout() {
		$this->visitor->logout ();
		// 同步退出
		$passport = $this->_user_server ();
		$synlogout = $passport->synlogout ();
		// 跳转到退出前页面（执行同步操作）
		$this->redirect ( 'public/user/login' );
	}
	// 关注某人
	public function userfollow(){
		$userid = $this->userid;
		$userid_follow = $this->_get('userid');//要关注人的id
		if(empty($userid_follow)){ $this->error('操作错误！');}
		$isuser = $this->user_mod->isUser($userid_follow);
		if(!$isuser){
			$this->error('不存在该用户！');
		}
		$isFollow = $this->user_mod->isFollow($userid,$userid_follow);
		if($isFollow){
			$this->error("请不要重复关注同一用户！");
		}else{
			//执行关注
			$data = array('userid'=>$userid, 'userid_follow'=>$userid_follow, 'addtime'=>time());
			$this->user_mod->follow_user($userid, $userid_follow);			
			//发送消息
			
			$doname = $this->user_mod->where(array('userid'=>$userid_follow))->getField('doname');
			// 来路
			if(isset ( $_SERVER ['HTTP_REFERER'] )) {
				$this->redirect($_SERVER ['HTTP_REFERER']);
			}else{
				$this->redirect ( 'space/index/index', array('id'=>$doname));
			}
		}
	}
	// 取消关注某人
	public function unfollow(){
		$type = $this->_get ( 'd', 'trim' );
		
		$userid = $this->userid;	
		if (! empty ( $type )) {
			switch ($type) {
				// ajax 取消
				case "user_nofollow_ajax" :
					$userid_follow = $this->_post('userid'); //要取消关注人的id
					$isunFollow = $this->user_mod->isunFollow($userid,$userid_follow);
					//执行取消关注
					if($isunFollow){
						$this->user_mod->unfollow_user($userid, $userid_follow);
						$cout_follow = $this->user_mod->field('count_follow')->where(array('userid'=>$userid))->find();
						$arrJson = array('r'=>1, 'num'=>$cout_follow['count_follow']);
					}else{
						$cout_follow = $this->user_mod->field('count_follow')->where(array('userid'=>$userid))->find();
						$arrJson = array('r'=>0, 'num'=>$cout_follow['count_follow']);
					}
					header("Content-Type: application/json", true);
					echo json_encode($arrJson);
					break;			
			}
		
		} else {
			$userid_follow = $this->_get('userid'); //要取消关注人的id
			$isunFollow = $this->user_mod->isunFollow($userid,$userid_follow);			
			if(!$isunFollow){
				$this->error("已经取消关注该用户了！");
			}
			if(empty($userid_follow)){
				$this->error('操作错误！');
			}
			$isuser = $this->user_mod->isUser($userid_follow);
			if(!$isuser){
				$this->error('不存在该用户！');
			}
			//执行取消关注
			$this->user_mod->unfollow_user($userid, $userid_follow);
	
			$doname = $this->user_mod->where(array('userid'=>$userid_follow))->getField('doname');
			$this->redirect ( 'space/index/index', array('id'=>$doname));
		}
	}
	// 被关注列表
	public function followed(){
		$userid = $this->_get('userid');
		$strUser = $this->user_mod->getOneUser($userid);
		if(!empty($strUser['userid'])){
			//关注我的人
			$arrFollowedUsers = $this->user_mod->getUserFollow($userid);
			foreach($arrFollowedUsers as $key=>$item){
				$arrFollowedUser[$key] = $item;
				$isfollow = $this->user_mod->isFollow($this->userid,$item['userid']);
				$arrFollowedUser[$key]['isfollow'] = empty($isfollow) ? 0 : 1; //我是否已经关注过他  0表示没关注 1 关注了
			}
			if($userid == $this->userid)
			{
				$title = '关注我的人';
			}else{
				$title = '关注'.$strUser['username'].'的人';
			}
		}else{
			$this->error('您访问的页面不存在！');
		}
		
		$this->assign ( 'strUser', $strUser );
		$this->assign ( 'arrFollowedUser', $arrFollowedUser );		
		$this->_config_seo ( array (
				'title' => $title,
				'subtitle' => '用户'
		) );
		$this->display ();
	}
	// 我关注的人
	public function follow(){
		$userid = $this->_get('userid');
		$strUser = $this->user_mod->getOneUser($userid);
		if(!empty($strUser['userid'])){
			//我关注的人
			$arrFollowUser = $this->user_mod->getfollow_user($userid);
			if($userid == $this->userid)
			{
				$title = '我关注的人';
			}else{
				$title = $strUser['username'].'关注的人';
			}
		}else{
			$this->error('您访问的页面不存在！');
		}
		
		$this->assign ( 'strUser', $strUser );
		$this->assign ( 'arrFollowUser', $arrFollowUser );
		$this->_config_seo ( array (
				'title' => $title,
				'subtitle' => '用户'
		) );
		$this->display ();
	}
	/**
	 * 绑定旧用户
	 */
	public function binduser(){
		if(cookie('user_bind_info')){
			$user = object_to_array(cookie('user_bind_info'));
			if(IS_POST){
				$ikemail = $this->_post('ikemail','trim');
				$ikpassword = $this->_post('ikpassword','trim');
				$strUser = $this->user_mod->where(array('email'=>$ikemail))->find();
				//检查email和用户名
				if(md5($ikpassword) != $strUser['password']){
					$this->error("旧密码输入有误！");
				}else{
					// 连接用户中心
					$passport = $this->_user_server ();
					//开始执行绑定表
					$oauth = new oauth($user['type']);
					$bind_info = array(
							'ik_uid' => $strUser['userid'],
							'keyid' => $user['keyid'],
							'bind_info' => $user['bind_info'],
					);
					$oauth->bindByData($bind_info);
					//清理绑定COOKIE
					cookie('user_bind_info', NULL);
					// 登陆
					$this->visitor->login ( $strUser['userid'] );
					// 同步登陆
					$synlogin = $passport->synlogin ( $strUser['userid'] );
					$this->redirect ( 'space/index/index', array (
							'id' => $this->visitor->info ['doname']
					) );
				}
			}			
		}else{
			$this->redirect('public/oauth/index',array('mod'=>'qq'));
		}		
	}
	/**
	 * 用户绑定新增
	 */
	public function binding() {
		if(cookie('user_bind_info')){
			
			$user = object_to_array(cookie('user_bind_info'));
			if(IS_POST){
				$email = $this->_post('email','trim');
				$username = $this->_post('username','trim');
				//检查email和用户名
				$ishave = $this->user_mod->where(array('email'=>$email))->count('*');
				if ($ishave>0) {
					$this->error('该Email已经被使用了！');
				}else{
					// 连接用户中心
					$passport = $this->_user_server ();
					// 注册
					$uid = $passport->register ( $username, md5(''), $email );
					//开始执行绑定表
					$oauth = new oauth($user['type']);
	                $bind_info = array(
	                    'ik_uid' => $uid,
	                    'keyid' => $user['keyid'],
	                    'bind_info' => $user['bind_info'],
	                );
	                $oauth->bindByData($bind_info);
	                //清理绑定COOKIE
	                cookie('user_bind_info', NULL);
					// 登陆
					$this->visitor->login ( $uid );
					// 同步登陆
					$synlogin = $passport->synlogin ( $uid );
					$this->redirect ( 'space/index/index', array (
							'id' => $this->visitor->info ['doname']
					) );					
				}
			}
			
			$this->assign('user', $user);
			$this->_config_seo ( array (
					'title' => '完善信息',
					'subtitle' => '绑定帐号'
			) );
			$this->display();
		}else{
			$this->redirect('public/oauth/index',array('mod'=>'qq'));
		}

	}	
	public function captcha() {
		//$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
		import("ORG.Util.Captcha");
		//Image::buildImageVerify(4,1,$type);
		$captcha = new Captcha();
		$captcha->CreateImage();
	}
	//ajax登录
	public function ajaxlogin(){
		//统计用户数
		$count_user = $this->user_mod->count('*');
		$this->assign ( 'count_user', $count_user );		
		$jump = $_SERVER['HTTP_REFERER'];
		$this->assign('jump',$jump);
		$this->display('login_form');	
	}
	//ajax注册	
	public function ajaxregister(){
		//统计用户数
		$count_user = $this->user_mod->count('*');
		$this->assign ( 'count_user', $count_user );	
		$jump = $_SERVER['HTTP_REFERER'];
		$this->assign('jump',$jump);
		$this->display('reg_form');
		
	}
	//找回密码服务
	public function forgetpwd(){
		if(IS_POST){
			$email	= $this->_post('email','trim');
			$emailNum = $this->user_mod->where(array('email'=>$email))->find();

			if($email==''){
				$this->error('Email输入不能为空^_^');
			}elseif(empty($emailNum)){
				$this->error('Email不存在，你可能还没有注册^_^');
			}else{
			
				//随机MD5加密
				$resetpwd = md5(rand());
			
				$this->user_mod->where(array('email'=>$email))->setField('resetpwd', $resetpwd);
				
				$subject = C('ik_site_title').'会员密码找回';
				
				$reseturl = C('ik_site_url').'index.php?app=public&m=user&a=resetpwd&mail='.$email.'&set='.$resetpwd;
				$content = '您的登录信息：<br />Email：'.$email.'<br />重设密码链接：<br /><a href="'.$reseturl.'">'.$reseturl.'</a>';
				
				$mailObject = new mail(F('setting'));
				
				$result = $mailObject->postMail($email, $subject, $content);
				if($result == '0'){
					$this->error("找回密码所需信息不完整^_^");
				}elseif($result == '1'){
					$this->error("系统已经向你的邮箱发送了邮件，请尽快查收^_^");
				}
					
			}
		}
		$this->_config_seo ( array (
				'title' => '找回密码'
		) );
		$this->display();
	}
	public function resetpwd(){

		if(IS_POST){
			$email 	= trim($_POST['email']);
			$pwd 	= trim($_POST['pwd']);
			$repwd	= trim($_POST['repwd']);
			$resetpwd = trim($_POST['resetpwd']);
			
			if($email=='' || $pwd=='' || $repwd=='' || $resetpwd==''){
				$this->error("你应该去火星生活啦！");
			}elseif($pwd != $repwd){
				$this->error("2次密码输入不一致！");
			}elseif(strlen($pwd)<6){
				$this->error("密码至少要6位！");
			}
				
			$userNum = $this->user_mod->where(array('email'=>$email,'resetpwd'=>$resetpwd))->find();
			if(empty($userNum)){
				$this->error("你应该去火星生活啦！");
			}else{
				$this->user_mod->where(array('email'=>$email))->setField('password', md5($pwd));
				$this->success('密码重新设置成功了；请登录！',C('ik_site_url'));
				
			}
		}else{
			$email = trim($_GET['mail']);
			$resetpwd = trim($_GET['set']);
			
			$userNum = $this->user_mod->where(array('email'=>$email,'resetpwd'=>$resetpwd))->find();
			
			if($email=='' || $resetpwd==''){
				$this->error("你应该去火星生活啦！");
			}elseif(empty($userNum)){
				$this->error("你应该去火星生活啦！");
			}
			
			$this->assign('email',$email);
			$this->assign('resetpwd',$resetpwd);
			
			$this->_config_seo ( array (
					'title' => '重设密码'
			) );
			$this->display();
		}
		

	}
	// 用户等级
	public function role(){
		$arrRole = $this->role_mod->select();
		$this->assign('arrRole',$arrRole);

		$this->_config_seo ( array (
				'title' => '会员等级'
		) );
		$this->display();		
	}
	// 用户积分
	public function score(){
		$id = $this->_get('id','intval');
		$strUser = $this->user_mod->getOneUser($id);

		$score_log_mod = M('user_score_log');
		$map['uid'] = $id;
		$count = $score_log_mod->where($map)->count();
		$pager = $this->_pager($count, 20);
		$list = $score_log_mod->where($map)->order('id DESC')->limit($pager->firstRow.','.$pager->listRows)->select();
		$this->assign('list',$list);
		$this->assign('pageUrl', $pager->fshow());
	
		$this->_config_seo ( array (
				'title' => $strUser['username'].'的积分'
		) );
		$this->display();
	}
}