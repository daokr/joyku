<?php if (!defined('THINK_PATH')) exit(); if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="J_item wall_item">


        <a href="javascript:;" class="J_unlike del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>"></a>



        <a href="javascript:;" class="J_delitem del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>" data-aid="<?php echo ($album["id"]); ?>"></a>


        <!--图片-->
        <ul class="pic">
            <li>
                <a href="<?php echo U('mall/item/index', array('id'=>$item['id']));?>" title="<?php echo ($item["title"]); ?>" target="_blank">
<img alt="<?php echo ($item["title"]); ?>" class="J_img J_decode_img" data-uri="<?php echo base64_encode(attach(get_thumb($item['img'], '_m'), 'item'));?>">
                </a>
                <span class="p">¥<?php echo ($item["price"]); ?></span>
                <a href="javascript:;" class="J_joinalbum addalbum_btn" data-id="<?php echo ($item["id"]); ?>"></a>
            </li>
        </ul>
        <!--操作-->
        <div class="favorite"> 
            <a href="javascript:;" class="J_likeitem like" data-id="<?php echo ($item["id"]); ?>" >12</a>
            <div class="J_like_n like_n"><a href="" target="_blank">55</a><i></i></div>
            
            <?php if($item['comments'] > 0): ?><span class="creply_n">(<a href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank">2</a>)</span><?php endif; ?>
            <a class="creply" href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank">777</a> 
        </div>
        <!--作者-->

        <div class="author clearfix">
            <a href="#" target="_blank">
                <img class="J_card avt fl r3" src="http://www.ikphp.com/data/upload/face/000/00/00/c81e728d9d4c2f636f067f89cc14862c_48_48.jpg?v=1368699000" data-uid="<?php echo ($item["uid"]); ?>" />
            </a>
             <a href="#" class="J_card clr6 bold" target="_blank" data-uid="<?php echo ($item["uid"]); ?>">小麦</a><br>
        </div>

        <!--说明-->
        <p class="intro clr6">[满49包邮]南极人包芯丝加档连裤袜丝袜 露趾袜鱼嘴袜 T档连裤袜</p>
        <!--评论-->

        <ul class="rep_list">


            <li class="rep_f">
                <a href="<?php echo U('space/index', array('uid'=>$item['comment_list'][$i]['uid']));?>" target="_blank">
                    <img src="http://s8.mogujie.cn/pic/130516/52957_kqyw6vklnjbg2stwgfjeg5sckzsew_272x275.jpg" class="J_card avt fl r3" alt="<?php echo ($item['comment_list'][$i]['uname']); ?>" data-uid="<?php echo ($item['comment_list'][$i]['uid']); ?>">
                </a>
                <p class="rep_content"><a href="<?php echo U('space/index', array('uid'=>$item['comment_list'][$i]['uid']));?>" class="J_card n" target="_blank" data-uid="<?php echo ($item['comment_list'][$i]['uid']); ?>">dfas</a>  你发的东西确实很好看哦</p>
            </li>

        </ul>

    </div><?php endforeach; endif; else: echo "" ;endif; ?>