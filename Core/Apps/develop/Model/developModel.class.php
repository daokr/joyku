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
			array('title','','标题已经存在',0,'unique',self::MODEL_INSERT),
	);
	// 自动填充设置
	protected $_auto	 =	 array(
			array('status','0',self::MODEL_INSERT),
			array('uptime','time',self::MODEL_UPDATE,'function'),
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
	
	//获取单个应用信息
	public function getOneApp($where,$order='',$limit=''){
		$result = $this->where($where)->order($order)->limit($limit)->find();
		if($result){

			$result['text_desc'] = ikhtml_text('appscreen', $result['appid'], $result['desc']);
			$result['html_desc'] = ikhtml('appscreen', $result['appid'], $result['desc']);
			
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
}