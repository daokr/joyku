$(function() {
  var bn_status_more = $('.bn-status-more');
  var status_cate = $('.status-cate');
  bn_status_more.click(function(e) {
	var el = $(this);
	el.parent().toggleClass('status-more-active');
	return false;
  });
  $('html').click(function(e) {
	if (!$(e.target).hasClass('cate-list-title')) {
		status_cate.removeClass('status-more-active');
	}
  });
});
$(function(){
	var l = $("#isay-label");
	var h = $("#isay-cont");
	var p = $("#db-isay");
	var B = $(".btn-group");
	var subtn = $('#isay-submit');
	var pic = $('#isay-upload-inp');
	var pic_act = $('#isay-act-field');
	var url_act = $('#isay-url-field');
	var action = '';
	function s(z) {
		var y = z.target; // html element
		var x = z.type; // object
		var w = $(y);

		p.addClass('active focus');
		l.hide();
		h.height(h.attr('data-minheight'));
		h.focus();
	}
	function j(i) {
		s && s(i)
	}	
	setTimeout(function() {
		if (h.val()) {
			l.hide()
		}
	}, 50);
	$("#isay-upload-inp").one("change", j);
	h.one("focus", j);
	p.one("click", j);
	h.bind('blur',function(){
		if(h.val()==0){
			l.show();
			p.removeClass('focus');
		}
	});
	h.bind('focus',function(){
		p.addClass('focus');
		l.hide();		
	});
	h.bind('keyup',function(){
		checktext()
	});
	function checktext(){
		if(h.val()!=0 && action!='sharesite'){
			p.removeClass('isay-disable');
			subtn.removeAttr('disabled');
		}else{
			p.addClass('isay-disable');
			subtn.attr('disabled', true);
		}
	}
	p.find('a').live('click',function(){
		var t = $(this),len = h.val().length; 
		action = t.attr('data-action');
		t.parent().siblings().removeClass('active');
		t.parent().addClass('active');		
		if(action=='topic'){
			h.focus();
			var val = h.val(),
			selection = h.get_selection(),
			sel = selection.text,
			start = selection.start,
			end = selection.end;
			
			if (val.charAt(start - 1) == '#' && val.charAt(end) == '#') return;
			
			var rep = '#' + (sel || '话题') + '#';
			h.value = val.substring(0, start) + rep + val.substring(end, len);
			h.val(h.value)
			if (sel === '') {
				h.set_selection(start + 1, start + 3);
			}
			
		}
		//分享网址
		if(action=='sharesite'){
			var in_url = '';
			var html = '<div class="field"><div class="bd active"><input type="text" name="url" class="inp-text url" value="http://" id="isay-inp-url"><span class="bn-flat"><input type="button" class="bn-preview" value="输入网址"></span></div></div>';
			url_act.html(html);
			in_url = url_act.find('input[name=url]');
			h.blur();
			in_url.focus();
			p.removeClass('focus');
			p.addClass('act-share field-up acting isay-disable');
			in_url.live('focus',function(){
				url_act.find('.bd').addClass('active');
			});
			in_url.live('blur',function(){
				url_act.find('.bd').removeClass('active');
			});
			subtn.attr('disabled', true);
		}
		//分享动态
		if(action == 'main'){
			checktext();
			p.removeClass('act-share field-up acting');
		}
		
	});
	//网址解析
	p.find('.bn-preview').live('click',function(){
		var g = $("#isay-inp-url"), v = $.trim(g.val());
		if(v!=0 && v !='' && v!='http://'){
			if(1==1){
				url_act.find('.bd').before('<div class="hd"><input value="爱客网_爱客开源社区程序" name="title" class="field-title" style="width: 563px;"></div>');
				url_act.find('.bd').html('http://www.ikphp.com');
				url_act.find('.bd').after('<a class="bn-x isay-cancel" href="javascript:void(0);" style="display:block" data-action="sharesite">×</a>');
				url_act.find('.bd').removeClass('active');
				p.removeClass('isay-disable');	
			}else{
				url_act.find('.bd').html('<div class="error">这个网址无法识别。 <a data-action="sharesite" href="javascript:void(0);">重新输入</a></div>');
				subtn.attr('disabled', true);
			}
		}else{
			url_act.find('.bd').addClass('active');
			return;
		}
	})
	
	IK.uplaodPic = function(){
		var html = '<div class="field"><div class="bd"><div style="padding-left:0;" class="waiting"><img src="http://127.0.0.1/joyku/data/upload/article/2013/0628/17/20130628172523SLAl_500_500.jpg?v=1373436689"></div><input type="hidden" value="http://img3.douban.com/view/status/small/public/a4530e6a5dd828c.jpg" name="uploaded"></div><a class="bn-x isay-cancel" href="javascript:void(0);">×</a></div>';
		//开始ajax
		if(1==1){
			pic_act.html(html);
			h.blur();
			p.addClass('acting');
		}
	}

	
});

