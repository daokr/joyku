function tips(c){ $.dialog({content: '<font style="font-size:14px;">'+c+'</font>',fixed: true, width:300, time:1500});}
function succ(c){ $.dialog({icon: 'succeed',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
function error(c){$.dialog({icon: 'error',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}

$(function(){
	$('.a_share').bind('click',function(){
	var ajaxurl = $(this).attr('href');
	var templ_link ='<form class="frm-addlink" action="javascript:;">'+
                '<div class="item">'+
                '<label>宝贝网址：</label><input name="href" type="text" value="" placeholder="将商品网址粘贴到这里">'+
				'</div>'+			
            '</form>';
	pop_win([
	'<div class="rectitle"><span class="m">分享宝贝</span></div>',
	'<div class="panel">',
	'<div class="item tips" id="errtips" style="background-color:#fff;text-align:left;height:16px"></div>',
	'<div class="item" style="text-align:left;font-size:14px;">',
	'目前支持：淘宝网、天猫、京东，其他网站会陆续推出。',
	'</div>',
	templ_link,
	'</div>',
	'<div class="bn-layout"><input type="button" value="确定" class="confirmbtn">',
	'<input type="button" value="取消" class="cancellinkbtn" onclick="pop_win.close();" ></div>'].join('') );
	
	var addlink = function(frm, o){
            var gurl = $.trim(frm.find('input[name=href]').val());
            if(gurl !== ''){
             //url = /^http:\/\//.test(url)? url:"http://"+url;
              //执行ajax
              if(!ikUtil.isURl(gurl)) { 
				  $('#errtips').css({'color':'red','background-color':'#F8F8F8'}).html('不是一个有效的商品地址！'); 
				  return false; 
			  }
			 
				$.ajax({
					type: 'post',
					url: ajaxurl,
					data: {
						url: encodeURIComponent(gurl)  //编码传送
					},
					dataType:'json',
					beforeSend: function() {
					   $('#errtips').css('color','green').html('正在抓取中。。');
					},					
					success: function(data) { 
						if(res.r){
							$('#errtips').html(res.html)
						}else{
							$('#errtips').html(res.html)
						}
						pop_win.close();
					}
				});			  
			  
            }
		 return false; 
    };
	
	$('.pop_win .confirmbtn').live('click',function(){
		addlink( $('.frm-addlink'), pop_win);	
	});
		return false;;
	})
});

//新建检查
function createCheck(that)
{
	var name = $(that).find('input[name=title]').val();
	var desc = $(that).find('textarea[name=content]').val();
	var arrimport = $(that).find('select[name=cateid]').val();
	
	
	if(name == ''){tips('专辑名称必须填写'); return false;}
	if(desc == ''){tips('专辑描述必须填写'); return false;}
	if(arrimport == 0){ tips('请选择一个分类吧！'); return false;}
	
	$(that).find('input[type=submit]').val('正在提交^_^').attr('disabled',true);

}
var ikUtil = {
            getStrLength: function(str) {
                str = $.trim(str);
                var length = str.replace(/[^\x00-\xff]/g, "**").length;
                return parseInt(length / 2) == length / 2 ? length / 2: parseInt(length / 2) + .5;
            },
            empty: function(str) {
                return void 0 === str || null === str || "" === str
            },
            isURl: function(str) {
                return /([\w-]+\.)+[\w-]+.([^a-z])(\/[\w-.\/?%&=]*)?|[a-zA-Z0-9\-\.][\w-]+.([^a-z])(\/[\w-.\/?%&=]*)?/i.test(str) ? !0 : !1
            },
            isEmail: function(str) {
                return /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(str);
            },
            minLength: function(str, length) {
                var strLength = $.qupai.util.getStrLength(str);
                return strLength >= length;
            },
            maxLength: function(str, length) {
                var strLength = $.qupai.util.getStrLength(str);
                return strLength <= length;
            },
            redirect: function(uri, toiframe) {
                if(toiframe != undefined){
                    $('#' + toiframe).attr('src', uri);
                    return !1;
                }
                location.href = uri;
            },
            base64_decode: function(input) {
                var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                var output = "";
                var chr1, chr2, chr3 = "";
                var enc1, enc2, enc3, enc4 = "";
                var i = 0;
                //if(typeof input.length=='undefined')return '';
                if(input.length%4!=0){
                    return "";
                }
                var base64test = /[^A-Za-z0-9\+\/\=]/g;
                
                if(base64test.exec(input)){
                    return "";
                }
                
                do {
                    enc1 = keyStr.indexOf(input.charAt(i++));
                    enc2 = keyStr.indexOf(input.charAt(i++));
                    enc3 = keyStr.indexOf(input.charAt(i++));
                    enc4 = keyStr.indexOf(input.charAt(i++));
                    
                    chr1 = (enc1 << 2) | (enc2 >> 4);
                    chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                    chr3 = ((enc3 & 3) << 6) | enc4;
                    
                    output = output + String.fromCharCode(chr1);
                    
                    if (enc3 != 64) {
                        output+=String.fromCharCode(chr2);
                    }
                    if (enc4 != 64) {
                        output+=String.fromCharCode(chr3);
                    }
                    
                    chr1 = chr2 = chr3 = "";
                    enc1 = enc2 = enc3 = enc4 = "";
                
                } while (i < input.length);
                return output;
            }
		};
		
		