<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class user_photo_albumModel extends Model
{
	// 自动验证设置
	protected $_validate	 =	 array(
			array('albumname','require','相册名称必须填写',1)
			
	);
	// 自动填充设置
	protected $_auto	 =	 array(
			array('uptime','time',self::MODEL_UPDATE,'function'),
			array('addtime','time',self::MODEL_INSERT,'function'),
			array('uptime','time',self::MODEL_INSERT,'function'),
	);


}