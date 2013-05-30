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
			//array('package_name','/^[A-Za-z]+$/','应用包名必须是英文',2),
			array('title','','标题已经存在',0,'unique',self::MODEL_INSERT),
	);
	// 自动填充设置
	protected $_auto	 =	 array(
			array('status','0',self::MODEL_INSERT),
			array('uptime','time',self::MODEL_UPDATE,'function'),
			array('addtime','time',self::MODEL_INSERT,'function'),
	);
}