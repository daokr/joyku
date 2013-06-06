<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class developModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
			array('title','require','标题必须填写',1),
			array('desc','require','应用描述必须填写'),
			array('apptype','require','应用类型必须填写'),
			array('applogo','require','请上传一张Logo图片吧'),
			array('appfile','require','请上传附件包'),
			array('package_name','/^[a-zA-Z]{1}[a-zA-Z0-9\-_]{0,14}$/','应用包名必须是英文'),
	);
	// 自动填充设置
	protected $_auto	 =	 array(
			array('status','0',self::MODEL_INSERT),
			array('uptime','time',self::MODEL_UPDATE,'function'),
			array('addtime','time',self::MODEL_INSERT,'function'),
			array('uptime','time',self::MODEL_INSERT,'function'),
	);
	
	//获取单个应用信息
	public function getOneApp($where,$order='',$limit=''){
		$result = $this->where($where)->order($order)->limit($limit)->find();
		if($result){
	
			$result['user'] = D('user')->getOneUser($result['userid']);

			if (!is_file(C('ik_attach_path') . $result['applogo'])) {
				$result['icon_100'] = __ROOT__ . "/Public/images/appdef.jpg";
			}else{
				$result['icon_100'] = attach($result['applogo']);
			}
			return $result;
		}
		return false;
	}
	// 获取所有应用
	public function getAppByMap($where,$order='',$limit=''){
		$arr = $this->field('appid')->where($where)->order($order)->limit($limit)->select();
		if($arr){
			foreach($arr as $item){
				$result[] = $this->getOneApp(array('appid'=>$item['appid']),$order,$limit);
			}
			return $result;
		}
		return false;		
	}
	// 下载过这个应用的人
	public function getDownUser($where,$order='',$limit=''){
		$arr = M('develop_down')->where($where)->order($order)->limit($limit)->select();
		if($arr){
			foreach($arr as $key=>$item){
				$result[] = D('user')->getOneUser($item['userid']);
			}
			return $result;
		}
		return false;		
	}
	//系统默认类别
	public function getTypeList(){
		$type = array(
					array('id'=>'1','name'=>'应用'),
					array('id'=>'2','name'=>'插件'),
					array('id'=>'3','name'=>'模版皮肤'),
				);
		return $type;
	}
	// 投票
	public function appVote($userid, $appid){
		$is_like = M('develop_vote')->where(array('userid'=>$userid, 'appid'=>$appid))->count('*');
		if($is_like > 0){
			//已经喜欢过了 执行取消操作
			$is_del = M('develop_vote')->where(array('userid'=>$userid, 'appid'=>$appid))->delete();
			if($is_del){
				$this->where ( array ('appid' => $appid) )->setDec ('count_vote');
				$collectNum = $this->where ( array ('appid' => $appid) )->getField('count_vote');
				$arrJson = array('r'=>1, 'num'=>$collectNum);
			}
		}else{
			//执行喜欢
			$data = array('userid'=>$userid, 'appid'=>$appid, 'addtime'=>time());
			if (false !== M('develop_vote')->create ( $data )) {
				$cid = M('develop_vote')->add ();
				if ($cid) {
					// 更新收藏数
					$this->where ( array ('appid' => $appid) )->setInc ('count_vote');
					$collectNum = $this->where ( array ('appid' => $appid) )->getField('count_vote');
					$arrJson = array('r'=>0, 'num'=>$collectNum);
				}
			}
		}
		return $arrJson;
	}
}