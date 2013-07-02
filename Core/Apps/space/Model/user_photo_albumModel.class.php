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
	
	//获取相册列表
	public function getAlbums($map,$order='addtime desc',$limit = '')
	{
		$res = $this->where($map)->order($order)->limit($limit)->select();
		if($res){
			foreach($res as $key=>$item){
				$result[] = $item;
				if($item['path']){
					$ext =  explode ( '.', $item['albumface']);
					//图片大小
					$result[$key]['simg'] =  attach($item['path'].$ext[0].'_'.C('ik_simg.width').'_'.C('ik_simg.height').'.jpg');
					$result[$key]['mimg'] =  attach($item['path'].$ext[0].'_'.C('ik_mimg.width').'_'.C('ik_mimg.height').'.jpg');
				}
			}
			return $result;
		}else{
			return false;
		}
	}
	//获取一个相册
	public function getOneAlbum($id){
		$res = $this->where(array('albumid'=>$id))->find();
		if($res){
			return $res;
		}else{
			return false;
		}		
	}
}