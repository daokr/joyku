// JavaScript Document
function searchForm(obj)
{
	var keyword = $(obj).find('input[name=q]'); 
	if( keyword.val() =='')
	{
		return false;
	}
	return true;
}
$(function(){
	$('#search_bar input[name=q]').bind('click',function(){
		if($(this).val()!=''){
			$(this).css({"color":"#000"});	
		}
	});	
	$('#search_bar input[name=q]').bind('change',function(){
		if($(this).val()!=''){
			$(this).css({"color":"#000"});	
		}
	});
	$('#search_bar input[name=q]').bind('blur',function(){
		if($(this).val()!=''){
			$(this).css({"color":"#000"});	
		}
	});
});

(function() {
  var mask;
  var popup;
  var current = '';
  var popup_mark = 'g_reg'

  var init_popup = function() {
    mask = $('<div class="popup-reg-mask"></div>').appendTo('body');
    mask.css('height', $(document).height());
    popup = $('#g-popup-reg');
    popup.find('.lnk-close').click(function(e) {
        e.preventDefault();
        popup.slideUp(400);;
        mask.hide();
        if (window.POPUP_REG) {
          window.name = window.name || popup_mark;
        }
    });
    if ($.browser.msie && ($.browser.version|0) === 6) {
        var win = $(window).scroll((function() {
            var timer;
            var doc = document.body;
            return function() {
                if (timer) {
                    window.clearTimeout(timer);
                }
                timer = window.setTimeout(function() {
                    popup.css({
                      top: (doc.scrollTop + win.height()/2 - popup.height()/2) + 'px'
                    });
                }, 20);
            };
        })()).trigger('scroll');
    }
  };

  var show_popup = function() {
    if (popup) {
      popup.show();;
      mask.show();
    } else {
      $('#g-popup-reg').show();
      init_popup();
    }
  };
  //公用登录
  IKCOM.init_show_login = function (e) {
    var node = $(e);
    node.click(function(e) {
      e.preventDefault();
      show_popup();
      if (current !== 'login') { 
        popup.find('iframe').attr('src', show_login_url);
      }
      current = 'login';
    });
  };
  //公用注册
  IKCOM.init_show_register = function (e) {
    var node = $(e);
    node.click(function(e) {
      e.preventDefault();
      show_popup();
      if (current !== 'register') {
        popup.find('iframe').attr('src', show_register_url);
      }
      current = 'register';
    });
  };
    // 有些页面会自动弹注册框
  if (window.POPUP_REG) {
    $(function() {
      show_popup();
      popup.find('iframe').attr('src', show_register_url);
      current = 'register';
    });
  }
  
})();

