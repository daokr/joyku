function selectTheme(obj,theme){
	$(obj).addClass('on').siblings().removeClass();
	$('#ikTheme').attr('href',siteUrl+'Public/theme/'+theme+'/base.css');
	var date = new Date();
    date.setTime(date.getTime()+(30*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
	document.cookie = "ikTheme="+theme+expires+";path=/";

}