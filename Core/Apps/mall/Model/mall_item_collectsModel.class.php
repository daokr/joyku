<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * 修改时间2013年6月25日 收藏的商品表
* @Email:160780470@qq.com
*/
class mall_item_collectsModel extends Model {
	// 喜欢收藏的人数
	public function countLike($itemid) {
		$where = array('itemid'=>$itemid);
		$result = $this->where ( $where )->count ( '*' );
		return $result;
	}
	// 是否已经喜欢过
	public function isLike($userid,$itemid) {
		$where = array('userid'=>$userid, 'itemid'=>$itemid);
		$result = $this->where ( $where )->count ( '*' );
		if($result){
			return true;
		}else{
			return false;
		}
	}
	// 谁收藏或喜欢了该帖
	public function likeItemUser($itemid,$limit = 6){
		
		$where = array('itemid'=>$itemid);
		$arrCollectUser = $this->where ( $where )->order('addtime')->limit($limit)->select();
		if(is_array($arrCollectUser)){
			foreach($arrCollectUser as $item){
				$strUser = D('user')->getOneUser($item['userid']);
				$arrUser[] = $strUser;
			}
		}
		return $arrUser;		
	}
	//根据用户id 查询他收藏的帖子
	public function getUserCollectItem($userid, $limit){
		$where = array('userid'=>$userid);
		$result = $this->where ( $where )->order('addtime desc')->limit($limit)->select();
		return  $result;
	}
	//收藏/取消收藏 该帖子
	public function collectItem($userid, $itemid){
		$is_like = $this->where(array('userid'=>$userid, 'itemid'=>$itemid))->count('*');
		if($is_like > 0){
			//已经喜欢过了 执行取消操作
			$is_del = $this->where(array('userid'=>$userid, 'itemid'=>$itemid))->delete();
			if($is_del){
				D('mall_item')->where ( array ('id' => $itemid) )->setDec ('likes');
				$collectNum = D('mall_item')->where ( array ('id' => $itemid) )->getField('likes');
				$arrJson = array('r'=>1, 'num'=>$collectNum);
			}
		}else{
			//执行喜欢
			$data = array('userid'=>$userid, 'itemid'=>$itemid, 'addtime'=>time());
			if (false !== $this->create ( $data )) {
				$cid = $this->add ();
				if ($cid) {
					// 更新收藏数
					D('mall_item')->where ( array ('id' => $itemid) )->setInc ('likes');
					$collectNum = D('mall_item')->where ( array ('id' => $itemid) )->getField('likes');
					$arrJson = array('r'=>0, 'num'=>$collectNum);
				}
			}	
		}
		return $arrJson;
	}
	//根据topicid删除 收藏
	public function delCollectItem($itemid){
		$where = array('itemid'=>$itemid);
		$this->where($where)->delete();
		return true;
	}

}