<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class article_commentModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
			array('content','require','评论内容必须填写'),
	);
	
	//Refer二级循环，三级循环暂时免谈 获取评论
	public function recomment($referid){
		$where = array (
				'cid' => $referid,
		);
		$strComment = $this->where( $where )->find();
		$strComment['user'] = D('user')->getOneUser($strComment['userid']);
		$strComment['content'] = h($strComment['content']);
	
		return $strComment;
	}
	// 删除的单个或多个评论$commentid='1,2,3' 以逗号分隔
	public function delComment($commentid){
		$where['cid'] = array('exp',' IN ('.$commentid.') ');
		$arrComment = $this->field('aid')->where($where)->select();
		if($arrComment){
			$this->where($where)->delete();
			return true;
		}else{
			return false;
		}
	}
	// 获取指定 id 评论
	public function getCommentByAppid($appid,$order='addtime asc',$limit='1'){
		$arrComment = $this->where(array('aid'=>$appid))->order($order)->limit($limit)->select();
		if($arrComment){
			foreach ($arrComment as $key=>$item){
				$result[] = $item;
				$result[$key]['user'] = D('user')->getOneUser($item['userid']);
			}
			return $result;
		}else{
			return false;
		}		
	}
}