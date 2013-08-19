<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 * 公用评论回复 修改时间 2013.8.20
 */
class commentAction extends frontendAction {
	//显示评论
	public function view($comment_mod,$ojbName,$idName,$action_url){ 
		
		$strObj = $ojbName;
		$strObj['id'] = $ojbName [$idName];
		$strObj['showurl'] = $action_url['showurl'];
		
		$page = $this->_get('p','intval',1);
		$sc = $this->_get('sc','trim','asc');
		$isauthor = $this->_get('isauthor','trim','0');

		//查询条件 是否显示
		$map[$idName] = $ojbName [$idName];
		if($isauthor){
			$map['userid']  = $ojbName ['userid'];
			$author = array('isauthor'=>0,'text'=>'查看所有回应');
		}else{
			$author = array('isauthor'=>1,'text'=>'只看楼主');
		}
		
		//显示列表
		$pagesize = 30;
		$count = $comment_mod->where($map)->order('addtime '.$sc)->count();
		$pager = $this->_pager($count, $pagesize);
		$arrComment =  $comment_mod->where($map)->order('addtime '.$sc)->limit($pager->firstRow.','.$pager->listRows)->select();
		
		foreach($arrComment as $key=>$item){
			$commentList[] = $item;
			$commentList[$key]['user'] = D('user')->getOneUser($item['userid']);
			$commentList[$key]['content'] = h($item['content']);
			if($item['referid']>0){
				$recomment = $comment_mod->recomment($item['referid']);
				$commentList[$key]['recomment'] = $recomment;
			}
		}

		$this->assign('pageUrl', $pager->fshow());
		$this->assign('commentList', $commentList);
		$this->assign ( 'sc', $sc );
		$this->assign ( 'author', $author );
		$this->assign ( 'isauthor', $isauthor );
		$this->assign ( 'page', $page );
		// 数据
		$this->assign('strObj',$strObj);
		$this->assign('action',$action_url);

	}
}