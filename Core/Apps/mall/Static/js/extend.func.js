function tips(c){ $.dialog({content: '<font style="font-size:14px;">'+c+'</font>',fixed: true, width:300, time:1500});}
function succ(c){ $.dialog({icon: 'succeed',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
function error(c){$.dialog({icon: 'error',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}

$(function(){
	$('.a_share').bind('click',function(){
	var ajaxurl = $(this).attr('data-url');
	var templ_link ='<div class="frm-addlink">'+
                '<div class="item">'+
                '<label>宝贝网址：</label><input name="href" type="text" value="" placeholder="将商品网址粘贴到这里">'+
				'</div>'+			
            '</div>';
	pop_win([
	'<div class="rectitle"><span class="m">分享宝贝</span></div>',
	'<div class="panel">',
	'<div class="item tips" id="errtips" style="background-color:#fff;text-align:left;height:16px"></div>',
	'<div class="item" style="text-align:left;font-size:14px;">',
	'目前支持：淘宝网、天猫、京东，其他网站会陆续推出。',
	'</div>',
	templ_link,
	'</div>',
	'<div class="bn-layout"><input type="button" value="确定" class="confirmbtn" onclick="addlink(\'.frm-addlink\',\''+ajaxurl+'\')">',
	'<input type="button" value="取消" class="cancellinkbtn" onclick="pop_win.close();" ></div>'].join('') );
	})
	
});
function addlink(frm,ajaxurl){
	var frm = $(frm);
	var gurl = $.trim(frm.find('input[name=href]').val());
	if(gurl !== ''){
	 //url = /^http:\/\//.test(url)? url:"http://"+url;
	  //执行ajax
	  if(!$.ikphp.util.isURl(gurl)) { 
		  $('#errtips').css({'color':'red','background-color':'#F8F8F8'}).html('不是一个有效的商品地址！'); 
		  return false; 
	  }
		$.ajax({
			type: 'post',
			url: ajaxurl,
			data: {
				url: gurl  //编码传送
			},
			dataType:'JSON',
			beforeSend: function() {
			   $('#errtips').css('color','green').html('正在抓取中。。');
			},					
			success: function(res) { 
				if(res.r==1){
					$('#errtips').css({'color':'red','background-color':'#F8F8F8'}).html(res.html); 
				}else{
					buildHtml(res.html);
					//pop_win.close();
				}
				
			}
		});			  
	  
	}
}
function buildHtml(data){
	var plist = '<ul>';
	for(var i=0; i<data.imgs.length;i++){
		plist += '<li><a href="javascript:;"><img src="'+data.imgs[i].url+'" width="100" heigth="100"></a></li>';
	}
	plist += '</ul>';
	
	pop_win([
	'<div class="rectitle"><span class="m">嗯~ 就是它吧</span></div>',
	'<div class="panel propanel"><div class="frm-fetch" id="frm-fetch">',
	'<div class="item"><label>宝贝名称：</label><input name="title" type="text" value="'+data.title+'" maxlength="100"></div>',
	'<div class="item"><label>评论一下：</label><textarea name="intro" placeholder="喜欢它什么呢？" maxlength="150">很喜欢这个宝贝！</textarea></div>',
	'<div class="item"><label>宝贝标签：</label><input name="tags" type="text" value="'+data.tags+'"></div>',
	'<div class="item"><label>宝贝图片：</label><div class="proList">'+plist+'</div></div>',
	'</div></div>',
	'<div class="bn-layout"><input type="button" value="确定" class="confirmbtn" id="publishitem">',
	'<input type="button" value="取消" class="cancellinkbtn" onclick="pop_win.close();" ></div>'].join('') );
	
	$('.pop_win #publishitem').live('click',function(){
		fetch_item( $('.frm-fetch'), data.itemobj);	
	});
}
function fetch_item(obj,item){
		var form = obj;
		var	intro = form.find('input[name=intro]').val(),
			title = form.find('input[name=title]').val(),
			tags = form.find('input[name=tags]').val();
		//安全检查
		
		$.ajax({
			url: siteUrl + 'index.php?app=mall&m=item&a=publish_item',
			type: 'POST',
			data: {
				item: item,
				intro: intro,
				title: title,
				tags:tags
			},
			dataType: 'json',
			success: function(res){
					pop_win([
					'<div class="rectitle"><span class="m">提示：</span></div>',
					'<div class="panel propanel">',
					'<div class="result_bar"><p>'+res.html+'</p></div>',
					'</div>'].join('') );
					
			}
		});
}

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

};		
(function($){
    $.ikphp = $.ikphp || {version: "v1.0.0"},
    $.extend($.ikphp, {
        util: {
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
        },
		ui:{
				decode_img: function(context) {
					$('.J_decode_img', context).each(function(){
						var uri = $(this).attr('data-uri')||"";
						$(this).attr('src', $.ikphp.util.base64_decode(uri));  
					});
				}
		}
    });
})(jQuery);		