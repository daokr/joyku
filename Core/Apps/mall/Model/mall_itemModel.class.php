<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class mall_itemModel extends Model
{
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );

    /**
     * 发布一个商品
     * $item 商品信息
     * $album_id 专辑ID
     * $ac_id 专辑分类ID
     */
    public function publish($item, $album_id = 0, $ac_id = 0) {
        //已经存在？
        if ($this->where(array('key_id'=>$item['key_id']))->count()) {
            $this->error = '该商品已经存在';
            return false;
        }

        //来源
        !$item['orig_id'] && $item['orig_id'] = D('mall_item_orig')->get_id_by_url($item['url']);
        $this->create($item);
        $item_id = $this->add();
        if ($item_id) {
        	//商品相册处理
        	if (isset($item['imgs']) && $item['imgs']) {
        		$item_img_mod = D('mall_item_img');
        		foreach ($item['imgs'] as $_img) {
        			$_img['item_id'] = $item_id;
        			$item_img_mod->create($_img);
        			$item_img_mod->add();
        		}
        	}
        	//商品标签处理
        	if($item['tags']){
        		$tags = str_replace ( ' ', ' ', $item ['tags'] );
        		D('tag')->addTag('mall_item','itemid',$item_id,$tags);
        	}
        	
        	return $item_id;
        } else {
            $this->error = '发布商品失败';
            return false;
        }
    }


}