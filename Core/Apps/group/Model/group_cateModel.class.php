<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com 修复于小组分类
*/
class group_cateModel extends Model
{
	// 自动验证设置
	protected $_validate	 =	 array(
			array('catename','require','分类名称必须填写',1),
			array('catename','','分类名称已经存在！',0,'unique',1),
			
	);
	// 获取子类
	public function getReferCate($referid) {
		$where = array('referid'=>$referid);
		$result = $this->where ( $where )->select ();
		return $result;
	}
	// 获取父类
	public function getParentCate() {
		$where = array('referid'=>0);
		$result = $this->where ( $where )->select ();
		return $result;
	}
	//获取单个分类
	public function getOneCate($cateid){
		$where = array('cateid'=>$cateid);
		$result = $this->where ( $where )->find ();
		return $result;		
	}	
}