<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class indexAction extends frontendAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'add',
				'delete',
				'edit',
				'publish',
				'addcomment',
				'recomment'.
				'delcomment',
				
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->mod = D ( 'article' );
		$this->cate_mod = D ( 'article_cate' );
		$this->item_mod = M ( 'article_item' );
		$this->channel_mod = D ( 'article_channel' );
		$this->comment_mod = D ( 'article_comment' );
		$this->user_mod = D ( 'user' );
		//生成导航
		$this->assign('arrNav',$this->_nav());
	}
	protected  function _nav(){
		// 文章导航
	    $arrChannel = D('article_channel')->getAllChannel(array('isnav'=>'0'));
	    foreach($arrChannel as $item){
	    	$arrNav[$item['nameid']] = array('name'=>$item['name'], 'url'=>U('article/index/channel',array('nameid'=>$item['nameid'])));
	    }
	    if($this->visitor->info['userid']){
	    	$arrNav['my_article'] = array('name'=>'我的文章', 'url'=>U('article/index/my_article'));
	    }
		return $arrNav;
	}
	// 文章
	public function index() {
		// 获取分类
		$arrCate = $this->cate_mod->getAllCate();
		
		
		//查询条件 是否审核
		$map = array('isaudit'=>'0');
		//显示列表
		$pagesize = 30;
		$count = $this->item_mod->where($map)->order('addtime desc')->count('itemid');
		$pager = $this->_pager($count, $pagesize);
		$arrItemid =  $this->item_mod->field('itemid')->where($map)->order('addtime desc')->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrItemid as $key=>$item){
			$arrArticle [] = $this->mod->getOneArticle($item['itemid']); 
		}
			
		$this->assign('pageUrl', $pager->fshow());		
		
		$this->assign ( 'arrCate', $arrCate );
		$this->assign ( 'arrArticle', $arrArticle );
		
		
		$this->_config_seo ( array (
				'title' => '最新美文',
				'subtitle'=>'阅读_'.C('ik_site_title'),
				'keywords' => '互联网,摄影,动漫,思考,阅读,旅游,时尚,居家,美食,数码,情感',
				'description'=> '可以通过投稿、发布优质文章，还可以关注最新博客日志，提供最新最好的实时动态美文。',
		) );
		$this->display ();
	}
	// 发表文章
	public function add() {
		$userid = $this->userid;
		// 获取资讯分类
		$arrChannel = $this->channel_mod->getAllChannel(array('isnav'=>'0'));
		$arrCate = ''; // 初始化下拉列表
		$arrCatename = array ();
		foreach ( $arrChannel as $key => $item ) {
			$arrCatename = $this->cate_mod->getCateByNameid ( $item ['nameid'] );  
			$arrCate .= '<optgroup label="' . $item ['name'] . '">';
			foreach ( $arrCatename as $key1 => $item1 ) {
				$arrCate .= '<option  value="' . $item1 ['cateid'] . '" >' . $item1 ['catename'] . '</option>';
			}
			$arrCate .= '</optgroup>';
		}

		$this->assign ( 'arrCate', $arrCate );
		
		$this->_config_seo ( array (
				'title' => '发表新文章',
				'subtitle'=>'阅读_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display ();
	}
	// 保存更新文章
	public function publish() {
		if (IS_POST) {
			$userid = $this->userid;
			$id = $this->_post ( 'id' );
			
			$item ['userid'] = $userid;
			$item ['cateid'] = $this->_post ( 'cateid', 'intval' );
			$item ['title'] = $this->_post ( 'title', 'trim' );
			$item ['addtime'] = time ();
				
			$data ['content'] = $this->_post ( 'content' );
			$data ['postip'] = get_client_ip ();
			$data ['newsauthor'] = $this->visitor->get ( 'username' );
			$data ['newsfrom'] = $this->_post ( 'newsfrom', 'trim', '' );
			$data ['newsfromurl'] = $this->_post ( 'newsfromurl', 'trim', '' );	

			//安全性判断
			if(empty($item ['title']) || empty($item ['cateid']) || empty($data ['content'])){
				$this->error('标题、分类、内容都必须填写！');
			}elseif (mb_strlen($item ['title'],'utf8')>50){
				$this->error('标题太长了！');
			}elseif (mb_strlen($data ['content'],'utf8')>20000){
				$this->error('文章内容太长了！');
			}
				
			if (empty ( $id )) {
				// 新增
				if (false !== $this->item_mod->create ( $item )) {
					$itemid = $data ['itemid'] = $this->item_mod->add ();
					if ($itemid > 0) {
						// 保存article
						if (false !== $this->mod->create ( $data )) {
							$id = $this->mod->add ();
							// 执行更新图片信息
							$arrSeqid = $this->_post ( 'seqid');
							$arrTitle = $this->_post ( 'photodesc');
							if(is_array($arrSeqid)){
								foreach($arrSeqid as $key=>$item){
									$seqid = $arrSeqid[$key];
									$imgtitle = empty($arrTitle[$key]) ? '' : $arrTitle[$key];
									$layout = $this->_post ( 'layout_'.$seqid);
									$dataimg = array('title'=>$imgtitle, 'align'=> $layout,'typeid'=>$id);
									$where = array('type'=>'article','typeid'=>'0','seqid'=>$seqid);
									D('images')->updateImage($dataimg,$where);

									// 更新 isphoto
									$this->item_mod->where(array('itemid'=>$itemid))->save(array('isphoto'=>1));
								}
							}
							/////////////执行更新图片信息结束//////////////////
							//执行更新视频信息
							$arrVideoseqid = $this->_post ( 'videoseqid');
							if(is_array($arrVideoseqid)){
								foreach($arrVideoseqid as $key=>$item){
									$seqid = $arrVideoseqid[$key];
									$title = $this->_post ( 'video_'.$seqid.'_title','trim','');
									$datavideo = array('title'=>$title, 'typeid'=>$id);
									$where = array('type'=>'article','typeid'=>'0','seqid'=>$seqid);
									D('videos')->updateVideo($datavideo,$where);
								}
							}
							
						}
					}
				}
			} else {
				// 更新
				$itemuserid = $this->item_mod->field('userid')->where ( array ('itemid' => $id) )->getField('userid');				
				if($itemuserid!=$userid){
					$this->error('非法操作！');
				}
				$this->mod->where ( array ('aid' => $id) )->save ( $data );
				$this->item_mod->where ( array ('itemid' => $id) )->save ( $item );
				// 执行更新图片信息
				$arrSeqid = $this->_post ( 'seqid');
				$arrTitle = $this->_post ( 'photodesc');
				if(is_array($arrSeqid)){
					foreach($arrSeqid as $key=>$item){
						$seqid = $arrSeqid[$key];
						$imgtitle = empty($arrTitle[$key]) ? '' : $arrTitle[$key];
						$layout = $this->_post ( 'layout_'.$seqid);
						$dataimg = array('title'=>$imgtitle, 'align'=> $layout,'typeid'=>$id);
						$where = array('type'=>'article','typeid'=>$id,'seqid'=>$seqid);
						D('images')->updateImage($dataimg,$where);
						// 更新 isphoto
						$this->item_mod->where(array('itemid'=>$itemid))->save(array('isphoto'=>1));
					}
				}
				/////////////执行更新图片信息结束//////////////////
				//执行更新视频信息
				$arrVideoseqid = $this->_post ( 'videoseqid' );
				if(is_array($arrVideoseqid)){
					foreach($arrVideoseqid as $key=>$item){
						$seqid = $arrVideoseqid[$key];
						$title = $this->_post ( 'video_'.$seqid.'_title','trim','');
						$datavideo = array('title'=>$title, 'typeid'=>$id);
						$where = array('type'=>'article','typeid'=>'0','seqid'=>$seqid);
						D('videos')->updateVideo($datavideo,$where);
					}
				}
				
			}
			
			$this->redirect ( 'article/index/show', array (
					'id' => $id 
			) );
		} else {
			$this->redirect ( 'article/index' );
		}
	}
	// 编辑文章
	public function edit(){
		$user = $this->visitor->get ();
		$id = $this->_get ( 'id' ); //文章id
		// 根据id获取内容
		$strArticle = $this->mod->where(array('aid' => $id))->find();
		if(is_array($strArticle)){
			$articleItem = $this->item_mod->where(array('itemid'=>$strArticle['itemid']))->find();
			//array_merge() 函数把两个或多个数组合并为一个数组
			$strArticle = array_merge($articleItem, $strArticle);
		}
		if($strArticle['userid']!=$user['userid']) $this->error('您没有权限编辑该文章');
		// 获取资讯分类
		$arrChannel = $this->channel_mod->select ();
		$arrCate = ''; // 初始化下拉列表
		$arrCatename = array ();
		foreach ( $arrChannel as $key => $item ) {
			$arrCatename = $this->cate_mod->getCateByNameid ( $item ['nameid'] );
			$arrCate .= '<optgroup label="' . $item ['name'] . '">';
			foreach ( $arrCatename as $key1 => $item1 ) {
				if($item1 ['cateid'] == $strArticle['cateid']){
					$arrCate .= '<option  value="' . $item1 ['cateid'] . '" selected>' . $item1 ['catename'] . '</option>';
				}else{
					$arrCate .= '<option  value="' . $item1 ['cateid'] . '" >' . $item1 ['catename'] . '</option>';
				}
			}
			$arrCate .= '</optgroup>';
		}
		//浏览该照片
		$type = 'article';
		$arrPhotos = D('images')->getImagesByTypeid($type, $id);
		//浏览改topic_id下的视频
		$arrVideos = D('videos')->getVideosByTypeid($type, $id);
		
		$this->assign ( 'arrCate', $arrCate );
		$this->assign ( 'strArticle', $strArticle );
		$this->assign ( 'arrPhotos', $arrPhotos );
		$this->assign ( 'arrVideos', $arrVideos );

		$this->_config_seo ( array (
				'title' => '编辑“'.$strArticle['title'].'”',
				'subtitle'=>'阅读_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display ('add');
	}
	// 编辑文章
	public function delete(){
		$user = $this->visitor->get ();
		$id = $this->_get ( 'id' , 'intval'); //文章id
		// 根据id获取内容
		$strArticle = $this->mod->getOneArticle($id);
		if($strArticle['userid']!=$user['userid']) $this->error('您没有权限删除该文章');
		// 执行删除
		$this->mod->delOneArticle($id);
		$this->success('删除成功！',U('article/index/index'));
	}
	// 文章详情页
	public function show() {
		$user = $this->visitor->get ();
		$id = $this->_get ( 'id', 'intval');
		// 根据id获取内容
		$strArticle = $this->mod->getOneArticle ( $id );
		! $strArticle && $this->error ( '呃...你想要的东西不在这儿' );
		
		// 浏览量加 +1
		if($strArticle ['userid']!=$user['userid']){
			$this->item_mod->where(array('itemid'=>$strArticle['itemid']))->setInc('count_view');
		}
		//上一篇帖子
		$upArticle = $this->mod->getOneArticle($id-1);
			
		//下一篇帖子
		$downArticle = $this->mod->getOneArticle($id+1);
		
		//获取评论
		$page = $this->_get('p','intval',1);
		$sc = $this->_get('sc','trim','asc');
		$isauthor = $this->_get('isauthor','trim','0');
		
		//查询条件 是否显示
		$map['aid'] = $strArticle ['aid'];
		if($isauthor){
			$map['userid']  = $strArticle ['userid'];
			$author = array('isauthor'=>0,'text'=>'查看所有回应');
		}else{
			$author = array('isauthor'=>1,'text'=>'只看楼主');
		}
		//显示列表
		$pagesize = 30;
		$count = $this->comment_mod->where($map)->order('addtime '.$sc)->count();
		$pager = $this->_pager($count, $pagesize);
		$arrComment =  $this->comment_mod->where($map)->order('addtime '.$sc)->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrComment as $key=>$item){
			$commentList[] = $item;
			$commentList[$key]['user'] = $this->user_mod->getOneUser($item['userid']);
			$commentList[$key]['content'] = h($item['content']);
			if($item['referid']>0){
				$recomment = $this->comment_mod->recomment($item['referid']);
				$commentList[$key]['recomment'] = $recomment;
			}
		}
		$this->assign('pageUrl', $pager->fshow());
		$this->assign('commentList', $commentList);
		$this->assign ( 'sc', $sc );
		$this->assign ( 'author', $author );
		$this->assign ( 'isauthor', $isauthor );
		$this->assign ( 'page', $page );
		//评论list结束
		
		//获取最新的 8文章
		$arrNewArticle = $this->mod->getArticleItemByMap('count_view desc','10');
		$this->assign ( 'arrNewArticle', $arrNewArticle );

		$this->assign ( 'strArticle', $strArticle );
		$this->assign ( 'upArticle', $upArticle );
		$this->assign ( 'downArticle', $downArticle );
		$this->assign ( 'strUser', $strArticle ['user'] );

		$this->_config_seo ( array (
				'title' => $strArticle ['title'],
				'subtitle'=> '阅读_'.C('ik_site_title'),
				'keywords' => ikscws($strArticle ['title']),
				'description'=> getsubstrutf8(t($strArticle['content']),0,200),
		) );
					
		$this->display ();
	}
	// 文章分类列表
	public function category(){
		$cateid = $this->_get('cateid','intval');
		$strCate = $this->cate_mod->getOneCate($cateid);
		!$strCate && $this->error ( '呃...你想要的东西不在这儿' );
		$strChannel = $this->channel_mod->where(array('nameid'=>$strCate['nameid']))->find();
		// 获取分类
		$arrCate = $this->cate_mod->getAllCate($strCate['nameid']);
		
		//查询条件 是否审核
		$map['cateid'] = $cateid;
		$map['isaudit'] = 0;
		//显示列表
		$pagesize = 30;
		$count = $this->item_mod->where($map)->order('orderid desc')->count('itemid');
		$pager = $this->_pager($count, $pagesize);
		$arrItemid =  $this->item_mod->field('itemid')->where($map)->order('orderid desc')->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrItemid as $key=>$item){
			$arrArticle [] = $this->mod->getOneArticle($item['itemid']);
		}
		$this->assign('pageUrl', $pager->fshow());
		$this->assign ( 'arrArticle', $arrArticle );
		///////////////////////////////
				

		$this->_config_seo ( array (
				'title' => $strChannel['name'].'-'.$strCate['catename'],
				'subtitle'=> '阅读_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->assign ( 'arrCate', $arrCate );
		$this->display ();
	}
	// 文章频道
	public function channel(){
		$nameid = $this->_get('nameid','trim');
		$strChannel = $this->channel_mod->where(array('nameid'=>$nameid))->find();
		!$strChannel && $this->error ( '呃...你想要的东西不在这儿' );
		// 获取分类
		$arrCate = $this->cate_mod->getAllCate($nameid);
		
		if(is_array($arrCate)){
			foreach($arrCate as $item){
				$arrCates[] = $item['cateid'];
			}
		}
		$strCates = implode(',',$arrCates);
		//查询条件 是否审核
		$map['cateid'] = array('exp',' IN ('.$strCates.') ');
		$map['isaudit'] = 0;
		//显示列表
		$pagesize = 30;
		$count = $this->item_mod->where($map)->order('orderid desc')->count('itemid');
		$pager = $this->_pager($count, $pagesize);
		$arrItemid =  $this->item_mod->field('itemid')->where($map)->order('orderid desc')->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrItemid as $key=>$item){
			$arrArticle [] = $this->mod->getOneArticle($item['itemid']); 
		}
			
		$this->assign('pageUrl', $pager->fshow());		
		$this->assign ( 'arrArticle', $arrArticle );
		
		$this->assign('arrCate',$arrCate);
		$this->_config_seo ( array (
				'title' => $strChannel['name'],
				'subtitle'=> '阅读_'.C('ik_site_title'),
				'keywords' => '',
				'description'=> '',
		) );
		$this->display ();
	}
	//我的文章
	public function my_article(){
		$userid = $this->userid;
		if($userid>0 && $strUser = $this->user_mod->getOneUser($userid)){
			
			$this->error('开发中。。。。。');
			
			$this->_config_seo ( array (
					'title' => '我的投稿',
					'subtitle'=> '阅读_'.C('ik_site_title'),
					'keywords' => '',
					'description'=> '',
			) );
			$this->display();
		}else{
			$this->error('你无权访问该页面！',U('public/user/login'));
		}
	}
	// 添加评论
	public function addcomment(){
		$aid	= $this->_post('aid','intval');
		$content	= $this->_post('content','trim');
		$page	= $this->_post('p','intval','1');
		if(empty($content)){
				
			$this->error('没有任何内容是不允许你通过滴^_^');
	
		}elseif(mb_strlen($content,'utf8')>10000){
	
			$this->error('发这么多内容干啥,最多只能写10000千个字^_^,回去重写哇！');
	
		}else{
			//执行添加
			$data = array(
					'aid'	=> $aid,
					'userid'	=> $this->userid,
					'content'	=> ikwords($content),
					'addtime'	=> time(),
			);
			if (false !== $this->comment_mod->create ( $data )) {
				$commentid = $this->comment_mod->add ();
				if($commentid>0){
					$this->item_mod->where(array('itemid'=>$aid))->setInc('count_comment');
					$this->redirect ( 'article/index/show', array (
							'id' => $aid,
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
				'aid'	=> $objid,
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
		$strComment = $this->comment_mod->where(array('cid'=>$commentid))->find();
		$strArticle = $this->mod->getOneArticle ( $strComment['aid'] );
	
		// 只有应用发布人 可以删除 其他权限不允许删除
		if($strArticle['userid']==$userid || $strComment['userid']==$userid){
			$this->comment_mod->delComment($commentid);
			$this->item_mod->where(array('itemid'=>$strComment['aid']))->setDec('count_comment'); //评论减1
			$this->redirect ( 'article/index/show#comment', array (
					'id' => $strComment['aid'],
			) );
		}
	
	}	
}