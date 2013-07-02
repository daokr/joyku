<?php if (!defined('THINK_PATH')) exit(); if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="J_item wall_item">
    
        <!--图片-->
        <ul class="pic">
            <li>
                <a href="<?php echo U('space/photos/show', array('id'=>$item['photoid']));?>">
					<img class="J_img J_decode_img" data-uri="<?php echo ($item[simg]); ?>" >
                </a>
            </li>
        </ul>

    </div><?php endforeach; endif; else: echo "" ;endif; ?>