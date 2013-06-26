<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
 * @Email:160780470@qq.com
 */
class eventAction extends locationbaseAction {
	public function _initialize() {
		parent::_initialize ();
		// 访问者控制
		if (! $this->visitor->is_login && in_array ( ACTION_NAME, array (
				'create',
	
		) )) {
			$this->redirect ( 'public/user/login' );
		} else {
			$this->userid = $this->visitor->info ['userid'];
		}
		$this->area_mod = D ( 'area' );
		$this->user_mod = D ( 'user' );
		$this->cate_mod = D ( 'event_cate' );
		$this->mod = D('event');
	}
		
	public  function index(){
		$this->display();
	}
	//创建
	public  function create(){
		$loc = $this->_get('loc','trim'); 
		//获取大分类
		$arrCate = $this->cate_mod->getAllCate();
		
		$currtCity = $this->area_mod->getOneAreaBypy($loc); //当前所在城市
		$arrCity = $this->area_mod->getHotCity();

		if(IS_POST){
			//接收数据
			$data['userid'] = $this->userid;
			$data['title'] = $this->_post('title','trim,t');
			$data['cateid'] = $this->_post('cateid','intval');
			$data['subcateid'] = $this->_post('subcateid','intval','0');
			$data['content'] = $this->_post('content','trim');
			$data['coordinate'] = $this->_post('coordinate','trim'); //坐标
			$data['direction'] = $this->_post('direction','trim',''); //乘车路线
			
			//地址
			$data['loc_id'] = $this->_post('loc_id','intval');
			$data['city'] = $this->_post('city','trim');
			$data['district_id'] = $this->_post('district_id','intval');
			$data['region_id'] = $this->_post('region_id','intval','0');
			$data['street_address'] = $this->_post('street_address','trim');
			
			
			$data['begin_date'] = $this->_post('begin_date','trim,sstrtotime','');
			$data['begin_time'] = $this->_post('begin_time','trim','');
			$data['end_date']   = $this->_post('end_date','trim,sstrtotime','');
			$data['end_time']   = $this->_post('end_time','trim','');
			
			$data['repeat_type'] = $this->_post('repeat_type','trim','');
			$data['repeat_time'] = $this->_post('repeat_time','trim','');
			
			$data['more_begin_day'] = $this->_post('more_begin_day','trim','');
			$data['more_end_day'] = $this->_post('more_end_day','trim','');
			$data['one_begin_time'] = $this->_post('one_begin_time','trim','');
			$data['one_end_time'] = $this->_post('one_end_time','trim','');
			
			$data['week_begin_day'] = $this->_post('week_begin_day','trim','');
			$data['week_end_day'] = $this->_post('week_end_day','trim','');
			$data['week_begin_time'] = $this->_post('week_begin_time','trim','');
			$data['week_end_time'] = $this->_post('week_end_time','trim','');	

			$data['week_mon'] = $this->_post('week_mon','trim',''); //on 代表选中
			$data['week_tue'] = $this->_post('week_tue','trim','');
			$data['week_wed'] = $this->_post('week_wed','trim','');
			$data['week_thu'] = $this->_post('week_thu','trim','');
			$data['week_fri'] = $this->_post('week_fri','trim','');
			$data['week_sat'] = $this->_post('week_sat','trim','');
			$data['week_sun'] = $this->_post('week_sun','trim','');
			
			//费用
			$data['fee'] = $this->_post('fee','intval'); // 0 免费 1收费
			$data['fee_detail'] = $this->_post('fee_detail','trim','');
			
			//审核 添加时间
			$data['isaudit'] = 1; // 0已审核  1审核中
			$data['addtime'] = time();
			
			//检测
			if(mb_strlen ( $data['title'], 'utf8' ) < 2) $this->ajaxReturn(array('r'=> false,'html'=>'活动标题写的太少了！'));
			if(mb_strlen ( $data['content'], 'utf8' ) > 50000) $this->ajaxReturn(array('r'=> false,'html'=>'活动详情写的太多了！'));
			if(mb_strlen ( $data['content'], 'utf8' ) < 10) $this->ajaxReturn(array('r'=> false,'html'=>'活动详情写的太少了！'));
			
			//开始创建
			if(!false == $this->mod->create($data)){
				
				$id = $this->mod->add(); 
			}
			$jsonData = array();
			if($id>0){
				$jsonData = array(
					'r'=> true,
					'jumpurl' => U('event/upload_poster',array('id'=>$id)),	
				);
			}else{
				$jsonData = array(
						'r'=> false,
						'html' => '活动创建失败！请重新创建。',
				);
			}
			$this->ajaxReturn($jsonData);
		}
		
		$this->assign('arrCate',$arrCate);
		$this->assign('currtCity',$currtCity);
		$this->assign('arrCity',$arrCity);
		$this->_config_seo (array('title'=>'创建同城活动','subtitle'=>$currtCity['areaname']));
		$this->display();
	}
	//第二步 上传海报
	public function upload_poster(){
		$eventid = $this->_get('id','intval');
		$strEvent = $this->mod->getOneEvent($eventid);
		//判断是否是创建者
		if($strEvent['userid'] != $this->userid){
			$this->error('你没有权限访问这个页面');
		}
		if(IS_POST){ 
			if (! empty ( $_FILES ['picfile']['name'] )) { 
				//保存文件夹
				$data_dir = date ( 'Y/md/H' );
				//上传
				$result = savelocalfile(
						$_FILES['picfile'],
						'event/poster/'.$data_dir,
						array('width'=>'200,70','height'=>'300,90'),
						array('jpg','gif','png','jpeg'),
						md5($eventid)
						);
				if($result['file']){
					//先更新
					$dataposter = array('orgimg'=>$result['file'],'midimg'=>$result['img_200_300'],'smallimg'=>$result['img_70_90']);
					$this->mod->where(array('eventid'=>$eventid))->setField('poster',serialize($dataposter));
				}
				$this->assign('imgSrc',attach($result['file']));
				$this->assign('imgpath',$result['file']);
				$this->assign('eventid',$eventid);
				$this->_config_seo (array('title'=>'上传或更改海报','subtitle'=>'同城活动'));
				$this->display();
			}else{ 
				//获取截图位置
				$imgpath = $this->_post('imgpath','trim');
				$imgpos = $this->_post('imgpos','trim');
				$imgpos = explode(',', $imgpos); 
				$poster = array();
				if($imgpos && $imgpath){
					
					$_IKIMAGECONFIG = array(
							'thumbcutmode' => 4, // 裁剪模式  0是默认模式     1左或上剪切模式    2中间剪切模式    3右或下剪切模式  4专用裁剪
							'thumbcutstartx' => $imgpos[0], //x 坐标
							'thumbcutstarty' => $imgpos[1], //y 坐标
							'thumbcutW' => $imgpos[2], //w 坐标
							'thumbcutH' => $imgpos[3], //h 坐标
							'thumboption' => 4, //8 宽度最佳缩放  4 综合最佳缩放 16 高度最佳缩放
					);
					if($imgpos[2]>200){
						$poster = array(
									'orgimg'=> $imgpath,
									'midimg'=> makethumb($imgpath, array(200,300), '',  $_IKIMAGECONFIG),
									'smallimg'=> makethumb($imgpath, array(70,90), '',  $_IKIMAGECONFIG),
								);
					}else{
						$poster = array(
								'orgimg'=> $imgpath,
								'midimg'=> makethumb($imgpath, array($imgpos[2],$imgpos[3]), '',  $_IKIMAGECONFIG),
								'smallimg'=> makethumb($imgpath, array(70,90), '',  $_IKIMAGECONFIG),
						);
					}
					//提交成功
					if($poster){
						$this->mod->where(array('eventid'=>$eventid))->setField('poster',serialize($poster));
						$this->redirect('event/show',array('id'=>$eventid));
					}
				}else{
					$this->error('请上传图片！');
				}
			}

		}else{
			$this->assign('imgSrc',$strEvent['orgimg']);
			if($strEvent['poster']){
				$poster_img = unserialize($strEvent ['poster']);
				$this->assign('imgpath',$poster_img ['orgimg']);
			}else{
				$this->assign('imgpath','');
			}
			$this->assign('eventid',$eventid);
			$this->_config_seo (array('title'=>'上传或更改海报','subtitle'=>'同城活动'));
			$this->display();
		}
	}
	//审核
	public function preview(){
		$eventid = $this->_get('id');
		$strEvent = $this->mod->getOneEvent($eventid);
		//判断是否是创建者
		if($strEvent['userid'] != $this->userid){
			$this->error('你没有权限访问这个页面');
		}
		$this->assign('eventid',$eventid);
		$this->_config_seo (array('title'=>'成功创建活动','subtitle'=>'同城活动'));
		$this->display();
	}
	//显示
	public function show(){
		$id = $this->_get('id','intval');
		$strEvent = $this->mod->getOneEvent($id);
		if(!$strEvent){ $this->error('呃...你想访问的页面不存在');}
		$this->assign('strEvent',$strEvent);
		$this->_config_seo (array('title'=>$strEvent['title'],'subtitle'=>'同城活动'));
		$this->display();
	}
	//ajax获取子分类
	public function ajax_subcate() {
		$type = $this->_post ( 'ik' );
		$oneid = $this->_post ( 'oneid' );
		switch ($type) {
			case 'two' :
				//获取标签
				$strTag = $this->cate_mod->field('tag')->where(array('cateid'=>$oneid))->find();
				$strTag = unserialize($strTag['tag']);
				$taghtml = $subcatehtml = '';
				if(!empty($strTag)){
					foreach ($strTag as $item){
						$taghtml .='<span class="event-tag">'.$item.'</span>';
					}
					$jsonData['tag'] =$taghtml;
				}else{
					$jsonData['tag'] ='';
				}
				//子类
				$arrCate = $this->cate_mod->getAllsubCate ( $oneid );
				if ($arrCate) {
					$subcatehtml .=  '<select id="subtype" class="basic-input" name="subcateid">';
					$subcatehtml .=  '<option value="0">请选择</option>';
					foreach ( $arrCate as $item ) {
						$subcatehtml .=  '<option value="' . $item ['cateid'] . '">' . $item ['catename'] . '</option>';
					}
					$subcatehtml .=  "</select>";
					$jsonData['subcate'] = $subcatehtml;
				} else {
					$jsonData['subcate'] ='';
				}
				$this->ajaxReturn($jsonData,'JSON');
				break;
		}
	}
	//ajax 获取map
	public function get_address(){
		
		$this->ajaxReturn(0);
	}
	//列表页
	public function lists(){
		/**查询显示 格式模式
		 * future-all 将来全部
		 * today-all 今天
		 * tomorrow-all 明天
		 * weekend-all  周末
		 * week-all 最近一周
		 * **/
		$type = $this->_get('type');
		$time = $this->_get('time','week');
		//模式判断下
		if(C('URL_MODEL')==0){
			$param =  explode('-', $type);
			$time = $param[0];
			$type = $param[1];		
		}
		switch ($time) {
			case 'week' :
				//查询
				//$map = array('isaudit'=>0);//通过审核
				$map['isaudit'] = 1;
				$map['end_date'] = array('elt',sstrtotime(date("Y-m-d",strtotime("+1 week"))));	
				break;			
		}
		//显示列表
		$pagesize = 10;
		$count = $this->mod->field('eventid')->where($map)->order('addtime DESC')->count();
		$pager = $this->_pager($count, $pagesize);
		$arrLists =  $this->mod->field('eventid')->where($map)->order('addtime DESC')->limit($pager->firstRow.','.$pager->listRows)->select();
		if(!empty($arrLists)){
			foreach($arrLists as $key=>$item){
				$arrList[] = $this->mod->getOneEvent($item['eventid']);
			}
		}
		//获取全部一级分类
		$parentCate = $this->cate_mod->getAllCate();
		//获取时间列表
		$timelist = array(
				'future'=>array('url'=>U('event/lists',array('type'=>'future-'.$type)),'name'=>'全部'),
				'today'=>array('url'=>U('event/lists',array('type'=>'today-'.$type)),'name'=>'今天'),
				'tomorrow'=>array('url'=>U('event/lists',array('type'=>'tomorrow-'.$type)),'name'=>'明天'),
				'weekend'=>array('url'=>U('event/lists',array('type'=>'weekend-'.$type)),'name'=>'周末'),
				'week'=>array('url'=>U('event/lists',array('type'=>'week-'.$type)),'name'=>'最近一周'),
		);
		$this->assign('pageUrl', $pager->fshow());
		$this->assign('list', $arrList);
		$this->assign('parentCate', $parentCate);
		$this->assign('timelist', $timelist);
		$this->_config_seo (array('title'=>'最近一周的同城活动','subtitle'=>'北京'));
		$this->display();
	}

	
}