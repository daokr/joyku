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
	var applogo = $(that).find('input[name=applogo]').val();
	var appfile = $(that).find('input[name=appfile]').val();
	if (title == '' || desc == '' || package_name == '' || applogo == '' || appfile=='') {
	   tips('标题、内容、包名、应用logo,应用附件包 、各项都必须填写'); return false;
	}
	if(package_name !=''){
		if(!format.test(package_name))
		{
			tips('应用包名称必须是英文'); return false;
		}	
	} 
	$(that).find('input[type=submit]').val('正在提交^_^').attr('disabled',true);
}
