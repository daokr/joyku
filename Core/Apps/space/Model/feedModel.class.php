<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class feedModel extends Model
{
	// 自动填充设置
	protected $_auto	 =	 array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);

	public function addFeed($data){
		if(!false == $this->create($data)){
			$id = $this->add();
			return $id;
		}else{
			return false;
		}
	}
	public function addFeedData($feedid,$tpl,$tpldata){
		//添加模版数据
		$fdata = array(
				'feedid' => $feedid,
				'template' => $tpl,
				'feeddata' => serialize($tpldata),
		);
		$res = M('feed_data')->add($fdata);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
}