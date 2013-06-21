<?php

class mineAction extends mallbaseAction {

	private $strUser = null;
	
    public function _initialize() {
        parent::_initialize();
        			
        $this->user_mod = D ( 'user' );
        $this->item_mod = D ( 'mall_item' );
        $this->item_orig = D( 'mall_item_orig' );
        $this->item_img = D('mall_item_img');

        $doname = $this->_get ( 'id','trim' );
        $userid = $this->user_mod->where ( array ('doname' => $doname) )->getField ( 'userid' );
        if (empty ( $userid )) {
        	$this->error ( '呃...你想要的东西不在这儿' );
        }
        $this->strUser = $this->user_mod->getOneUser ( $userid );
        $this->assign ( 'strUser', $this->strUser );
        //导航
        $this->assign ( 'mine_nav', $this->getMineNav() );
    }
    public function index(){
    	$this->redirect('mall/mine/ablum',array('id'=>$this->strUser['doname']));
    }    
    public function ablum(){
    	
    	$this->_config_seo (array('title'=>$this->strUser['username'].'的专辑','subtitle'=>'爱客商城'));
    	$this->display();
    }
    public function item() {  
    	//我的分享
    	$sort = $this->_get('sort', 'trim', 'new');
    	switch ($sort) {
    		case 'hot':
    			$order = 'likes DESC';
    			break;
    		case 'new':
    			$order = 'id DESC';
    			break;
    	}
    	$where = array('userid' => $this->strUser['userid']);
    	$field = 'id,userid,title,intro,img,price,likes,comments';

    	$this->waterfall($where, $order, $field);
    	$this->assign('sort', $sort);
    	
    	$this->_config_seo (array('title'=>$this->strUser['username'].'的分享','subtitle'=>'爱客商城'));
    	$this->display();
    }
    public function getMineNav(){
    	$user = $this->strUser;
    	$nav['ablum'] = array('name'=>'我的专辑', 'url'=>U('mall/mine/ablum',array('id'=>$user['doname'])));
		$nav['item'] = array('name'=>'我的分享', 'url'=>U('mall/mine/item',array('id'=>$user['doname'])));
		return $nav;
    }

}