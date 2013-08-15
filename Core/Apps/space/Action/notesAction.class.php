<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class notesAction extends spacebaseAction {
	public function _initialize() {
		parent::_initialize ();
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'create',
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		//应用所需 mod
		$this->user_mod = D('user');
		$this->note_mod = D('note');
	}
	//日记首页
	public function index(){
		$userid = $this->_get('id','trim,intval');
		$userid > 0 && $user = $this->user_mod->getOneUser($userid);
		if(!empty($user)){
			$title = $user['username'].'的日记';
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
		
		$this->_config_seo ( array (
				'title' => $title,
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => '网络日记,记事本,日记,日志,相册',
				'description'=> '把生活中的点点滴滴都记录下来吧；分享生活中有意义的事情，留住青春，珍藏您一生的记忆！',
		) );		
		$this->display();
	}
	//新加日记
	public function create(){
		$userid = $this->userid;
		//查询预先数据
		$strNote = $this->note_mod->getOneNote(array('userid'=>$userid,'cateid'=>'0'));
		if($strNote){
			//存在
		}else{
			//新增一条
			$data['userid'] = $userid;
			$data['cateid'] = 0;
			$data['isaudit'] = 0;
			$noteid = $this->note_mod->add($data); echo $this->note_mod->getLastSql();
			$strNote['noteid'] = $noteid;
		}
		//获取个人分类
		$arrCate = 
		
		$this->assign('strNote',$strNote);
		
		$this->_config_seo ( array (
				'title' => '新加日记',
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display();
	}
	
	
}