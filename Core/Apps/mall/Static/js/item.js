/**
 * @name 商品
 * @author 160780470 小麦
 * @url http://www.ikphp.com
 */
(function($){
    $.ikphp.item = {
        settings: {
            container: '#item_wall', //容器
            item_unit: '.item', //商品单元
        },
        init: function(options){
            options && $.extend($.ikphp.item.settings, options);
            var s = $.ikphp.item.settings;
            //单个
            $(s.container).imagesLoaded( function(){
                $(s.container).masonry({
                    itemSelector: s.item_unit
                });
                //$(s.item_unit).animate({opacity: 1});
            });
        }
    };
    $.ikphp.item.init();
})(jQuery);
