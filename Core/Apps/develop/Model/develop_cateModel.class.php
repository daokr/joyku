<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class develop_cateModel extends Model {
	// 自动验证设置

	// 获取全部分类
	public function getCateList($limit=''){
		$list= $this->order('orderid asc')->limit($limit)->select();
		if(!empty($list)){
			return $list;
		}	
		return false;
	}
	// 根据cateid 获取单个分类
	public function getOneCate($cateid){
		$strCate = $this->where(array('cateid'=>$cateid))->find();
		if(!empty($strCate)){
			return $strCate;
		}	
		return false;
	}
}