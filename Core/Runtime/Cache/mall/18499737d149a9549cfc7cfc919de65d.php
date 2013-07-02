<?php if (!defined('THINK_PATH')) exit(); if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="J_item wall_item">


        <a href="javascript:;" class="J_unlike del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>"></a>



        <a href="javascript:;" class="J_delitem del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>" data-aid="<?php echo ($album["id"]); ?>"></a>


        <!--图片-->
        <ul class="pic">
            <li>
                <a href="<?php echo U('mall/item/index', array('id'=>$item['id']));?>" title="<?php echo ($item["title"]); ?>" target="_blank">
<img alt="<?php echo ($item["title"]); ?>" class="J_img J_decode_img" data-uri="<?php echo base64_encode(attach(get_thumb($item['img'], '_m'), 'item'));?>" >
                </a>
                <span class="p">¥<?php echo ($item["price"]); ?></span>
                <a href="javascript:;" class="J_joinalbum addalbum_btn" data-id="<?php echo ($item["id"]); ?>"></a>
            </li>
        </ul>
        <!--操作-->
        <div class="favorite"> 
            <a href="javascript:;" class="J_likeitem like" data-id="<?php echo ($item["id"]); ?>" >喜欢</a>
            <div class="J_like_n like_n"><a href="<?php echo U('mall/item/index', array('id'=>$item['id']));?>" target="_blank"><?php echo ($item[likes]); ?></a><i></i></div>
            
            <?php if($item['comments'] > 0): ?><span class="creply_n">(<a href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank"><?php echo ($item[comments]); ?></a>)</span><?php endif; ?>
            <a class="creply" href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank">评论</a> 
        </div>
        <!--作者-->

        <div class="author clearfix">
            <a href="<?php echo U('mall/mine/index',array('id'=>$item[user][doname]));?>" target="_blank">
                <img class="J_card avt fl r3" src="<?php echo ($item[user][face]); ?>" data-uid="<?php echo ($item["uid"]); ?>" />
            </a>
             <div class="user_info">
 				<a href="<?php echo U('mall/mine/index',array('id'=>$item[user][doname]));?>" class="J_card clr6 bold" target="_blank" data-uid="<?php echo ($item["userid"]); ?>"><?php echo ($item[user][username]); ?></a>
                <p class="share_info">分享了<span class="clrff8"><?php echo ($item[sharenum]); ?></span>个搭配</p>
             </div>
        </div>

        <!--说明-->
        <p class="intro clr6"><?php echo ($item["intro"]); ?></p>
        <!--评论-->
 		<?php if(!empty($item['comment_list'])): ?><ul class="rep_list">
            <?php $__FOR_START_13481__=0;$__FOR_END_13481__=C('pin_item_cover_comments');for($i=$__FOR_START_13481__;$i < $__FOR_END_13481__;$i+=1){ if(!empty($item['comment_list'][$i])): ?><li class="rep_f">
                <a href="" target="_blank">
                    <img src="" class="J_card avt fl r3" alt="<?php echo ($item['comment_list'][$i]['uname']); ?>" data-uid="">
                </a>
                <p class="rep_content"><a href="" class="J_card n" target="_blank" data-uid="">dfas</a>  你发的东西确实很好看哦</p>
            </li><?php endif; } ?>
        </ul><?php endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>