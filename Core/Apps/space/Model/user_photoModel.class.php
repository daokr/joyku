<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class user_photoModel extends Model
{
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );

	//添加照片
    public function addPhoto($file,$userid) {
    	$data_dir = date ( 'Y/md/H' );
    	$result = savelocalfile($file,'photo/' . $data_dir,
    			array (
    					'width'=>C('ik_simg.width').','.C('ik_mimg.width').','.C('ik_bimg.width'),
    					'height'=>C('ik_simg.height').','.C('ik_mimg.height').','.C('ik_bimg.height')
    			),
    			array('jpg','jpeg','png','gif'));
    	
    	
    }
    //获取照片
    public function getPhotos($map,$order='addtime desc',$limit=''){
    	
    }
    //获取单张图片
    public function getOnePhoto($map){
    	
    }


}