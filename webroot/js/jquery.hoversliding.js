;(function ($) {
    $.fn.extend({
        hoverSliding: function (options) {
            var defaults = { //default values for plugin options
                duration: 500,
                width: '45%',
                height: '300',
                boxEasing: 'swing',
                boxtype: 'peek', // with type "captionfull", "caption", "slideright", "thecombo", "slidedown", "peek"
                titleHeight: ''
            }
            var opts = $.extend(defaults, options);
            return this.each(function () {
                var objParent = $(this).addClass('box-wrapper');
                var obj = $(this).children().addClass('vtem-boxgrid ' + opts.boxtype).width(opts.width);
                if (opts.boxtype == 'caption' || opts.boxtype == 'captionfull')
                    obj.children('div').addClass('vtem-slideItem');
                else
                    obj.children('img').addClass('vtem-slideItem');
                obj.each(function () {
                    var objChild = $(this);
                    if (opts.boxtype == 'caption') {
                        if (opts.titleHeight != '') boxTitle = parseFloat(opts.titleHeight);
                        else boxTitle = parseFloat(objChild.find('.boxTitle').outerHeight()) + 20;
                    } else boxTitle = 0;
                    //SET HEIGHT FOR MODULE
                    if (opts.height.indexOf('%') != -1) {
                        var startH = Math.round(parseFloat(objChild.width()) / (100 / parseFloat(opts.height)));
                        var boxHeight = parseFloat(startH);
                    } else if (opts.height == 'auto') {
                        boxHeight = parseFloat(objChild.find('.box-caption').children().outerHeight());
                    } else {
                        boxHeight = parseFloat(opts.height);
                    }
                    objChild.css({'height': boxHeight, 'float': 'left'});
                    switch (opts.boxtype) {
                        case 'caption':
                            var boxTopIn = 0, boxLeftIn = 0, boxLeftOut = 0;
                            var boxTopOut = boxHeight - boxTitle;
                            objChild.find('.vtem-slideItem').css('top', boxTopOut);
                            break;
                        case 'captionfull':
                            var boxTopIn = boxTitle;
                            var boxTopOut = boxHeight;
                            var boxLeftIn = 0, boxLeftOut = 0;
                            objChild.find('.vtem-slideItem').css('top', boxTopOut);
                            break;
                        case 'slidedown':
                            var boxTopIn = -(boxHeight);
                            var boxTopOut = boxTitle;
                            var boxLeftIn = 'auto', boxLeftOut = 'auto';
                            break;
                        case 'peek':
                            var boxTopIn = boxHeight;
                            var boxTopOut = boxTitle;
                            var boxLeftIn = 'auto', boxLeftOut = 'auto';
                            break;
                        case 'slideright':
                            var boxTopIn = 'auto', boxTopOut = 'auto';
                            var boxLeftIn = objChild.width();
                            var boxLeftOut = 0;
                            break;
                        case 'thecombo':
                            var boxTopIn = boxHeight;
                            var boxLeftIn = objChild.width();
                            var boxLeftOut = 0, boxTopOut = 0;
                            break;
                    }
                    objChild.hover(function () {
                        $('.vtem-slideItem', objChild).stop().animate({
                            'top': boxTopIn,
                            'left': boxLeftIn
                        }, opts.duration, opts.boxEasing);
                    }, function () {
                        $('.vtem-slideItem', objChild).stop().animate({
                            'top': boxTopOut,
                            'left': boxLeftOut
                        }, opts.duration, opts.boxEasing);
                    });
                });

            });
        }
    });
})(jQuery);
