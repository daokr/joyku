function selectTheme(obj,theme){
	$(obj).addClass('on').siblings().removeClass();
	$('#ikTheme').attr('href',siteUrl+'Public/theme/'+theme+'/base.css');
	var date = new Date();
    date.setTime(date.getTime()+(30*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
	document.cookie = "ikTheme="+theme+expires+";path=/";
}

$(function(){
	var MyTime=null; 
	var currtNum = 1;
	var ctro = $('.head-ctrls'), focusbar = $('.head-slides');
	var item = focusbar.find('.item'),iteml = item.length;itemw = item.eq(0).width();
	//自动
	var autoShow = function(){
		//设定时间
		MyTime = setInterval(function(){
			showFocusImg(currtNum);
			currtNum++;
			if(currtNum==iteml){currtNum=0;}
		} , 3000);	
	};	
	//初始
	focusbar.width(iteml*itemw);focusbar.find('.item').show();
	ctro.find('li').bind('click',function(){
		currtNum = $('.head-ctrls li').index(this);
		ctro.find('li').eq(currtNum).addClass('on').siblings().removeClass('on');
		focusbar.animate({"margin-Left":-(itemw*currtNum)},'slow');
		clearInterval(MyTime);
	});
	$('.head-ctrls , .head-slides').hover(
		 function(){
			if(MyTime){clearInterval(MyTime);}
		 },
		 function(){
			 autoShow();
		 }
	);
	var showFocusImg = function(i){
		$('.head-ctrls').find('li').eq(i).addClass('on').siblings().removeClass('on');		 
		$('.head-slides').animate({"margin-Left":-(itemw*i)},'slow');		
	}	
	autoShow();
});

