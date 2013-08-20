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
				'edit',
				'delete',
				'recomment',
				'addcomment',
				'delcomment',
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		//应用所需 mod
		$this->user_mod = D('user');
		$this->note_mod = D('note');
		$this->comment_mod = D('note_comment');
	}
	//日记首页
	public function index(){
		$userid = $this->_get('id','trim,intval');
		$userid > 0 && $user = $this->user_mod->getOneUser($userid);
		if(!empty($user)){
			 if($this->userid == $userid){
			 	$title = '我的日记';
			 }else{
			 	$title = $user['username'].'的日记';
			 }
		}else{
			$this->error('呃...你想访问的页面不存在');
		}
				
		//查询条件 
		$map['userid'] = $userid;
		$map['title'] = array('NEQ','');
		//显示列表
		$pagesize = 20;
		$count = $this->note_mod->where($map)->order('addtime desc')->count('noteid');
		$pager = $this->_pager($count, $pagesize);
		$arrNoteid =  $this->note_mod->field('noteid')->where($map)->order('addtime desc')->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrNoteid as $key=>$item){
			$arrNote [] = $this->note_mod->getOneNote(array('noteid'=>$item['noteid']));
			$arrNote [$key]['content'] = ikhtml_text('note', $item['noteid'], $arrNote[$key]['content']);
		}
		
		$this->assign('arrNote',$arrNote);
		$this->assign('pageUrl', $pager->fshow());
		
		//最多阅读
		$hotNotes = $this->note_mod->getHotNotes($userid,8);
		$this->assign('hotNotes', $hotNotes);
		
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
		$strNote = $this->note_mod->getOneNote(array('userid'=>$userid,'title'=>''));
		if(!$strNote){
			//新增一条
			$data['userid'] = $userid;
			$data['cateid'] = 0;
			$data['isaudit'] = 0;
			$noteid = $this->note_mod->add($data); 
			$strNote['noteid'] = $noteid;
		}
		//浏览该照片
		$type = 'note';
		$arrPhotos = D('images')->getImagesByTypeid($type, $strNote['noteid']);
		$this->assign('arrPhotos',$arrPhotos);

		
		$this->assign('strNote',$strNote);
		$this->_config_seo ( array (
				'title' => '新加日记',
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display();
	}
	public function update(){
		$userid = $this->userid;
		$noteid = $this->_post('noteid','intval','trim');
		//查询
		$strNote = $this->note_mod->getOneNote(array('userid'=>$userid,'noteid'=>$noteid));
		//开始添加
		if($strNote){
			$data['title']   = $this->_post ( 'title' );
			$data['content'] = $this->_post ( 'content' );
			$data['privacy'] = $this->_post ( 'privacy' ); //隐私
			$data['isreply'] = $this->_post ( 'isreply' ); //是否允许评论
			$data['isaudit'] = 1; //设置为已审核
			
			if(empty($strNote['addtime'])){
				$data['addtime'] = time(); //如果存在时间不更新
			}

			//安全性判断
			if(empty($data ['title']) || empty($data ['content'])){
				$this->error('标题、内容都必须填写！');
			}elseif (mb_strlen($data ['title'],'utf8')>60){
				$this->error('标题太长了，最多60个字！');
			}elseif (mb_strlen($data ['content'],'utf8')>20000){
				$this->error('文章内容太长了！');
			}
			//开始更新
			$this->note_mod->where(array('noteid'=>$noteid))->save($data);
			$this->redirect('space/notes/show',array('id'=>$noteid));
		}else{
			$this->error('呃...你没有权限访问该页面');
		}
	}
	public function edit(){
		$userid = $this->userid;
		$noteid = $this->_get('id','intval','trim');
		//查询预先数据
		$strNote = $this->note_mod->getOneNote(array('noteid'=>$noteid,'userid'=>$userid));
		if(!$strNote){$this->error('呃...你没有权限访问该页面');}
		
		//浏览该照片
		$type = 'note';
		$arrPhotos = D('images')->getImagesByTypeid($type, $noteid);
		$this->assign('arrPhotos',$arrPhotos);
		
		$this->assign('strNote',$strNote);
		$this->_config_seo ( array (
				'title' => '编辑日记',
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );		
		$this->display();
	}
	public function delete(){
		$userid = $this->userid;
		$noteid = $this->_get('id','intval','trim');
		$strNote = $this->note_mod->getOneNote(array('noteid'=>$noteid,'userid'=>$userid));
		if(!$strNote){$this->error('呃...你没有权限删除该日记');}
		
		$this->note_mod->deleteOneNote($noteid);
		$this->redirect('space/notes/index',array('id'=>$userid));
	}
	//日记显示页
	public function show(){
		$id = $this->_get('id','intval','trim');
		$strNote = $this->note_mod->getOneNote(array('noteid'=>$id));
		if(!$strNote){
			$this->error('呃...你想访问的页面不存在');
		}
		$strNote ['content'] = nl2br ( ikhtml('note',$id,$strNote['content'],1));
		
		$strNote ['user'] = $this->user_mod->getOneUser($strNote['userid']);
		
		$arrNotes = $this->note_mod->getNotes(array('userid'=>$strNote['userid']),10);
		
		//浏览数+1
		if($this->userid != $strNote['userid']){
			$this->note_mod->where(array('noteid'=>$id))->setInc('count_view');
		}
		

		// 调用公用评论模板
		$action_url = array(
						'deleteurl' => 'space/notes/delcomment',
						'recomment' => U('space/notes/recomment'),
						'addcomment' => U('space/notes/addcomment'),
						'showurl' => 'space/notes/show',
					);
		R('public/comment/view',array($this->comment_mod,$strNote,'noteid',$action_url));
		
		$this->assign('strNote',$strNote);
		$this->assign('arrNotes',$arrNotes);
		$this->_config_seo ( array (
				'title' => $strNote['title'],
				'subtitle'=> '_日记_'.C('ik_site_title'),
				'keywords' => ikscws($strNote ['title']),
				'description'=> getsubstrutf8(t($strNote['content']),0,200),
		) );
		$this->display();
	} 
	// 添加评论
	public function addcomment(){
		$id	= $this->_post('id','intval');
		$content	= $this->_post('content','trim');
		$page	= $this->_post('p','intval','1');
		if(empty($content)){
				
			$this->error('没有任何内容是不允许你通过滴^_^');
	
		}elseif(mb_strlen($content,'utf8')>10000){
	
			$this->error('发这么多内容干啥,最多只能写10000千个字^_^,回去重写哇！');
	
		}else{
			//执行添加
			$data = array(
					'noteid'	=> $id,
					'userid'	=> $this->userid,
					'content'	=> ikwords($content),
					'addtime'	=> time(),
			);
			if (false !== $this->comment_mod->create ( $data )) {
				$commentid = $this->comment_mod->add ();
				if($commentid>0){
					$this->note_mod->where(array('noteid'=>$id))->setInc('count_comment');
					$this->redirect ( 'space/notes/show', array (
							'id' => $id,
							'p'  => $page,
					) );
				}

			}
		}
	
	}
	// 回复评论
	public function recomment(){
		$objid = $this->_post('objid');
		$referid = $this->_post('referid');
		$content = $this->_post('content');
		//安全性检查
		if( mb_strlen($content, 'utf8') > 10000)
		{
			echo 1;
			exit ();
		}
		//执行添加
		$data = array(
				'noteid'	=> $objid,
				'userid'	=> $this->userid,
				'referid'	=> $referid,
				'content'	=> ikwords($content), // ajax 提交过来数据的转一下
				'addtime'	=> time(),
		);
		if (false !== $this->comment_mod->create ( $data )) {
			$commentid = $this->comment_mod->add ();
			echo 0;
		}
	}
	// 删除某条评论
	public function delcomment(){
		$commentid = $this->_get('commentid','intval');
		$userid = $this->userid;
		$strComment = $this->comment_mod->where(array('commentid'=>$commentid))->find();
		$strNote = $this->note_mod->getOneNote(array('noteid'=>$strComment['noteid']));
	
		// 只有应用发布人 可以删除 其他权限不允许删除
		if($strNote['userid']==$userid || $strComment['userid']==$userid){
			$this->comment_mod->delComment($commentid);
			$this->note_mod->where(array('noteid'=>$strComment['noteid']))->setDec('count_comment'); //评论减1
			$this->redirect ( 'space/notes/show#comment', array (
					'id' => $strComment['noteid'],
			) );
		}
	
	}	
	
	
}