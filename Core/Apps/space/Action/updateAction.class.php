<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * 邮箱:ikphp@sina.cn 微博 空间动态广播
 * 开发时间 2013.7.9 作者：小麦
 */
class updateAction extends spacebaseAction {
	public function _initialize() {
		parent::_initialize ();
		
		//应用所需 mod
		$this->user_mod = D('user');
		$this->feed_mod = D('feed');
		$this->ftopic_mod = D('feed_topic');
		$this->feed_img = M('feed_images');
	}
	//动态广播首页
	public function index(){
		if(! $this->visitor->is_login ) $this->redirect ( 'public/user/login' );
		$userid =  $this->visitor->info ['userid'];
		$user = $this->user_mod->getOneUser($userid);
		
		//获取feed
		$arrFeeds = 
		//查询条件 是否审核 是否已经删除
		$map = array('isaudit'=>'1','is_del'=>'0','userid'=>$userid);
		//显示列表
		$pagesize = 30;
		$count = $this->feed_mod->field('feedid')->where($map)->order('addtime desc')->count('feedid');
		$pager = $this->_pager($count, $pagesize);
		$arrItemid =  $this->feed_mod->where($map)->order('addtime desc')->limit($pager->firstRow.','.$pager->listRows)->select();
		foreach($arrItemid as $k=>$item){
			$arrFeed[] = $item;
			$strData = M('feed_data')->where(array('feedid'=>$item['feedid']))->find();
			$feeddata = unserialize(stripslashes($strData['feeddata']));
			if(is_array($feeddata)){
				foreach($feeddata as $key=>$itemTmp){
					$tmpkey = '{'.$key.'}';
					$tmpdata[$tmpkey] = $itemTmp;					
				}
			}
			$arrFeed[$k]['user'] = $this->user_mod->getOneUser($item['userid']);
			$arrFeed[$k]['content'] = strtr($strData['template'],$tmpdata);
		}

		$this->assign('pageUrl', $pager->fshow());
		$this->assign ( 'arrFeed', $arrFeed );
		
		$this->_config_seo ( array (
				'title' => '我的动态广播',
				'keywords' => '分享日记,分享动态信息,日记,宝贝,照片,最新动态',
				'description'=> '把生活中的点点滴滴都记录下来吧；提供图书、电影、音乐唱片的推荐、评论和价格比较，以及城市独特的文化生活！',
		) );		
		$this->display();
	}
	//发布
	public function publish(){
		if(! $this->visitor->is_login ) $this->redirect ( 'public/user/login' );
		$userid =  $this->visitor->info ['userid'];
		$username = $this->visitor->info ['username'];
		$doname = $this->visitor->info ['doname'];
		$share_link = $this->_post('share_link','trim',''); // 分享链接
		$share_name = $this->_post('share_name','trim',''); // 名称
		$photo_name = $this->_post('photo_name','');
		$comment = $this->_post('comment','trim'); // 150个字最多
		
		if(mb_strlen($comment,'utf8')>150){
			$this->error('输入的广播字数太多了；请不要超过150个字！');
		}
		$comment = str_replace("＃", "#", $comment);
		preg_match_all("/#([^#]*[^#^\s][^#]*)#/is",$comment,$arr);
		$arr = array_unique($arr[1]);
		
		//判断是有话题 添加话题
		if(!empty($arr)){
			foreach ($arr as $v){
				$dataTopic = array('topicname'=>trim(t($v)));
				$topicid = $this->ftopic_mod->addTopic($dataTopic);
			}
		}
		//feed数据
		$dataFeed = array(
				'userid' => $userid,
				'type'	 => 'post',
				'share_link' => $share_link,
				'share_name' => $share_name,
				);
		//$dataTpl
		$spaceUrl = U('space/index/index',array('id'=>$doname));
		$dataTpl = '<p class="text">{userinfo}{actname}{actinfo}</p><blockquote><p>{comment}</p></blockquote><div class="attachments">{attachments}</div>';
		$tplData['actname'] = ' 说：';
		$tplData['actinfo'] = '';
		$tplData['userinfo'] = '<a href="'.$spaceUrl.'">'.$username.'</a>';
		$tplData['comment'] = htmlspecialchars($comment);
		
		$feedid = $this->feed_mod->addFeed($dataFeed);
		//有图片则更新图片
		if($feedid && !empty($photo_name)){
			foreach ($photo_name as $item){
				$path = 'update/photo/'.$userid.'/';
				$dataImg = array('userid'=>$userid,'feedid'=>$feedid,'name'=>base64_decode($item),'path'=>$path);
				$this->feed_img->add($dataImg);
				//附件
				$ext =  explode ( '.', base64_decode($item));
				//图片大小
				$simg =  attach($path.$ext[0].'_130_130.jpg');
				$bimg =  attach($path.$ext[0].'_500_500.jpg');
				//附件图片
				$strimgs .= '<img src="'.$simg.'" data-src="'.$bimg.'">';
			}
			$this->feed_mod->where(array('feedid'=>$feedid))->setField('is_image', '1');
		}
		//模版附件
		$tplData['attachments'] = $strimgs;
		//添加模版数据
		$tplData = array_merge($dataFeed,$tplData);
		$this->feed_mod->addFeedData($feedid,$dataTpl, $tplData);
		$this->redirect('space/update/index');
	}
	public function uploadImg(){
		$userid =  $this->visitor->info ['userid'];
		$image = $_FILES ['image'];
		if(!empty($image['name']) && $userid){
			//传image
			$result = savelocalfile($image,'update/photo/'.$userid,
					array('width'=>'130,500','height'=>'130,500'),
					array('jpg','jpeg','png','gif'));
			if (!$result ['error']) {
				$arrJson = array(
						'photo_url'=>  attach($result['img_130_130']),
						'photo_name'=> base64_encode($result['filename']),
				);
				echo json_encode(array('r'=>1,'html'=>$arrJson));
				return ;
			}else{
				$arrJson = array('r'=>0, 'html'=> $result ['error']);
				echo json_encode($arrJson);
				return ;
			}			
		}
	}	
	
	
}