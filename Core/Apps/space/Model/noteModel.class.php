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
		$result = $this->where($map)->find();
		return $result;
	}
	//获取指定条数的日记
	public function getNotes($map,$limit = 10,$field='',$order='addtime desc'){
		$result = $this->field($field)->where($map)->order($order)->limit($limit)->select();
		return $result;
	}
	//获取推荐日记
	public function getRecommendNote($limit){
		$res = $this->where(array('isrecommend'=>1))->order('addtime desc')->limit($limit)->select();
		if($res){
			foreach($res as $key=>$item){
				$result[] = $item;
				$result[$key]['user'] = D('user')->getOneUser($item['userid']);
				$result[$key]['content'] = ikhtml_text('note', $item['noteid'], $item['content']);
			}
			return $result;
		}else{
			return false;
		}
	}
	public function delete(){
		
	}

}