function checkAlbum(that){
	var title = $(that).find('input[name=albumname]').val();
	var desc = $(that).find('input[name=albumdesc]').val();
		
	if (title == '') {
	   tips('相册名称不能为空，且不超过20字'); return false;
	}else if(desc ==''){
	   tips('相册描述不能为空，且不超过128字'); return false;
	}

	$(that).find('input[type=submit]').val('正在提交^_^').attr('disabled',true);
}
//安全性检测 回应帖子
function checkComment(obj)
{

	if($(obj).find('textarea[name=content]').val() == ''){ error('你回应的内容不能为空'); return false;}
	if($(obj).find('textarea[name=content]').val().length > 2000){ error('你已经输入了<font color="red">'+$(obj).find('textarea[name=content]').val().length+'</font>个字；你回应的内容不能超过<font color="red">2000</font>个字。');return false;}
	
	$(obj).find('input[type=submit]').val('正在提交^_^').attr('disabled',true);
	
	return true;
}
//Ctrl+Enter 回应

function keyComment(obj,event)
{
     if(event.ctrlKey == true)
	 {
		if(event.keyCode == 13)
		if(checkComment(obj))
		{
			$(obj).submit();
		}
		return false;
	}
}
/*显示隐藏回复*/
function commentOpen(id,gid)
{
	$('#rcomment_'+id).slideToggle('fast');
}
function keyRecomment(rid,tid,event)
{
     if(event.ctrlKey == true)
	 {
		if(event.keyCode == 13)
		recomment(rid,tid);
		return false;
	}
}
//回复评论
function recomment(obj,rid,tid){

	c = $('#recontent_'+rid).val();
	if(c==''){tips('回复内容不能为空');return false;}
	var url = $(obj).attr('data-url');
	$('#recomm_btn_'+rid).hide();
	$.post(url,{referid:rid,objid:tid,content:c} ,function(rs){
				if(rs == 0)
				{
					succ('回复成功');
					window.location.reload();
				}else if( rs == 1){
					
					tips('回复内容写这么多干啥，删除点吧老大^_^')
					$('#recomm_btn_'+rid).show();
				}
	})
}