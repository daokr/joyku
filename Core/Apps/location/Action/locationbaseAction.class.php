<?php

class locationbaseAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();

       //生成导航
       $this->assign('arrNav',$this->_nav());
    }
	protected  function _nav(){
		// 导航
		if($this->visitor->info['userid']){
			$arrNav['mine'] = array('name'=>'我的同城', 'url'=>U('location/mine/index',array('id'=>$this->visitor->info['doname'])));
		}
		$arrNav['lists'] = array('name'=>'同城活动', 'url'=>U('location/event/lists'));
		$arrNav['explore'] = array('name'=>'主办方', 'url'=>U('location/hosts/explore'));
		return $arrNav;
	}
	

}