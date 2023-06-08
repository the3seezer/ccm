jQuery.preloadImages = function()
{
	for(var i = 0; i<arguments.length; i++)
	jQuery("<img>").attr("src", arguments[i]);
}
jQuery.preloadImages("key.gif");
jQuery.preloadImages("keyo.gif");
jQuery.preloadImages("rss.gif");
jQuery.preloadImages("rsso.gif");
jQuery.preloadImages("sel.gif");
jQuery.preloadImages("selo.gif");

jQuery(document).ready(function(){
	
	$("#iconbar li img").hover(
		function(){
			var iconName = $(this).attr("src");
			var origen = iconName.split(".")[0];
			$(this).attr({src: "" + origen + "o.gif"});
			$(this).parent().parent().animate({ width: "130px" }, {queue:false, duration:"normal"} );
			$(this).parent().parent().find("span").animate({opacity: "show"}, "fast");
		}, 
		function(){
			var iconName = $(this).attr("src");
			var origen = iconName.split("o.")[0];
			$(this).attr({src: "" + origen + ".gif"});			
			$(this).parent().parent().animate({ width: "30px" }, {queue:false, duration:"normal"} );
			$(this).parent().parent().find("span").animate({opacity: "hide"}, "fast");
		});
});
