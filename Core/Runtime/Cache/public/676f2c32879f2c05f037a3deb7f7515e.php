<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__THEME__/js/editor/kindeditor-4.1.4/kindeditor.js?v=2012"></script>
<!--发布样式 begi-->
<div class="contents">
<textarea  name="<?php echo ($contentName); ?>"  cols="" rows="20" id="<?php echo ($contentName); ?>" style="width:<?php echo ($width); ?>; margin-bottom:10px;"><?php echo ($value); ?></textarea>
</div>
<script>
	//E	=	KISSY.Editor( "content" );
	E = KISSY.Editor( "<?php echo ($contentName); ?>" ,'photo' , false);
	E._focusToEnd();
</script>