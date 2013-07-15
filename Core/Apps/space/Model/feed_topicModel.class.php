<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class feed_topicModel extends Model
{
	// 自动填充设置
	protected $_auto	 =	 array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	
	public function addTopic($data){
		$str = $this->where($data)->find();
		if(empty($str)){
			$id = $this->add($data);
			$this->where(array('topicid'=>$id))->setInc('count_topic');
			return $id;
		}else{
			$this->where($data)->setInc('count_topic');
			return $str['topicid'];
		}
	}
	public function getOneTopic($map){
		$res = $this->where($map)->find();
		return $res;
	}
}