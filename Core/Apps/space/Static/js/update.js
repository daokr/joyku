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
	function s(z) {
		var y = z.target; // html element
		var x = z.type; // object
		var w = $(y);

		p.addClass('active focus');
		l.hide();
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
		if(h.val()!=0){
			p.removeClass('isay-disable');
		}else{
			p.addClass('isay-disable');
		}
	});
	
	if(location.search){
			
	}
	
	
});