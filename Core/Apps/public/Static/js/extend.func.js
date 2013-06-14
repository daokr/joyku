function selectTheme(obj,theme){
	$(obj).addClass('on').siblings().removeClass();
	$('#ikTheme').attr('href',siteUrl+'Public/theme/'+theme+'/base.css');
	document.cookie="ikTheme="+theme+";path=/"; 
}