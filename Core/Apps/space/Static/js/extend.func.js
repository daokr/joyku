function tips(c){ $.dialog({content: '<font style="font-size:14px;">'+c+'</font>',fixed: true, width:300, time:2000});}
function succ(c){ $.dialog({icon: 'succeed',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
function error(c){$.dialog({icon: 'error',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}

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