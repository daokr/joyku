function tips(c){ $.dialog({content: '<font style="font-size:14px;">'+c+'</font>',fixed: true, width:300, time:1500});}
function succ(c){ $.dialog({icon: 'succeed',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
function error(c){$.dialog({icon: 'error',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}

$(function(){
	$('input[name=apptype]').bind('click',function(){
		var val = $(this).val();
		if(val==3){
			$('.tbodyitem').hide();
		}else{
			$('.tbodyitem').show();
		}
	})
})

function checkForm(that){
	var title = $(that).find('input[name=title]').val();
	var desc = $(that).find('input[name=desc]').val();
	var package_name = $(that).find('input[name=package_name]').val();
	var format = /^[a-zA-Z]{1}[a-zA-Z0-9\-_]{0,14}$/;
	var url = $.trim($(that).find('input[name=appsite]').val());
	
	if(url !== ''){
	  url = /^http:\/\//.test(url)? url:"http://"+url;
	  $(that).find('input[name=appsite]').val(url);
	}
			
	if (title == '' || desc == '') {
	   tips('应用标题、详细描述、包名、各项都必须填写'); return false;
	}
	if(package_name !=''){
		if(!format.test(package_name))
		{
			tips('应用包名称必须是英文'); return false;
		}	
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
// 有用投票
function postvote(that){
	var url = $(that).attr('data-url');
	var counter = $(that).parent().find('.counter');;
	$.post(url,{} ,function(res){
		
		if(res.r==1)
		{	
			counter.html(res.num);
			$(that).removeClass('digged');					
		}else if(res.r==0)
		{
			counter.html(res.num);
			$(that).addClass('digged');	
		}		
	},'json')	
}