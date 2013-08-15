<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class noteModel extends Model
{
	// 自动填充设置
	protected $_auto	 =	 array(
			array('addtime','time',self::MODEL_INSERT,'function'),
	);

	//获取一条日记
	public function getOneNote($map){
		$res = $this->where($map)->find();
		return $res;
	}
	//获取个人分类
	public function getCateByuserid($userid){
		$res = $this->where(array('userid'=>$userid))->find();
		return $res;
	}
}