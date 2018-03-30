/*
	jQuery zAccordion Plugin v2.1.0
*/
;(function ($) {
    "use strict";
    $.fn.zAccordion = function (method) {
        var defaults = {
            timeout: 6000, /* Time between each slide (in ms). */
            width: '100%', /* Width of the container. This option is required. */
            slideWidth: null, /* Width of each slide in pixels or width of each slide compared to a 100% container. */
            tabWidth: '10%', /* Width of each slide's "tab" (when clicked it opens the slide) or width of each tab compared to a 100% container. */
            height: '50%', /* Height of the container. This option is required. */
            startingSlide: 0, /* Zero-based index of which slide should be displayed. */
            slideClass: null, /* Class prefix of each slide. If left null, no classes will be set. */
            easing: null, /* Easing method. */
            speed: 1200, /* Speed of the slide transition (in ms). */
            auto: true, /* Whether or not the slideshow should play automatically. */
            trigger: "click", /* Event type that will bind to the "tab" (click, mouseover, etc.). */
            pause: true, /* Pause on hover. */
            invert: false, /* Whether or not to invert the slideshow, so the last slide stays in the same position, rather than the first slide. */
            animationStart: function () {
            }, /* Function called when animation starts. */
            animationComplete: function () {
            }, /* Function called when animation completes. */
            buildComplete: function () {
            }, /* Function called after the accordion is finished building. */
            errors: false /* Display zAccordion specific errors. */
        }, helpers = {
            displayError: function (msg, e) {
                if (window.console && e) {
                    console.log("zAccordion: " + msg + ".");
                }
            },
            findChildElements: function (t) { /* Function to find the number of child elements. */
                if (t.children().get(0) === undefined) {
                    return false;
                } else {
                    return true;
                }
            },
            getNext: function (s, c) { /* Returns the 0-index of the next slide. */
                var next = c + 1;
                if (next >= s) {
                    next = 0;
                }
                return next;
            },
            fixHeight: function (o) {
                if ((o.height === null) && (o.slideHeight !== undefined)) { /* Removed slideHeight. */
                    o.height = o.slideHeight;
                    return true;
                } else if ((o.height !== null) && (o.slideHeight === undefined)) {
                    return true;
                } else if ((o.height === null) && (o.slideHeight === undefined)) {
                    return false;
                }
            },
            getUnits: function (o) {
                if (o !== null) {
                    if (o.toString().indexOf("%") > -1 || o.toString() == 'auto') {
                        return "%";
                    } else {
                        return "px";
                    }
                }
            },
            toInteger: function (o) {
                if (o !== null) {
                    if (o == 'auto')
                        return 100; // return 100%
                    else
                        return parseInt(o, 10);
                }
            },
            sizeAccordion: function (t, o) { /* Calculate the sizes of the tabs and slides */
                if ((o.tabWidthUnits === 'px' && o.widthUnits === '%') || (o.tabWidthUnits === '%' && o.widthUnits === '%')) {
                    if (o.tabWidthUnits === 'px')
                        o.tabWidth = 100 / ($(t).parent().width() / o.tabWidth);
                    if ((t.children().size() * o.tabWidth) >= 100)
                        o.tabWidth = 100 / t.children().size() - 2;
                    o.tabWidthUnits = '%';
                } else if ((o.tabWidthUnits === '%' && o.widthUnits === 'px') || (o.tabWidthUnits === 'px' && o.widthUnits === 'px')) {
                    if (o.tabWidthUnits === '%')
                        o.tabWidth = $(t).parent().width() / (100 / o.tabWidth);
                    if (((t.children().size() * o.tabWidth) >= o.width))
                        o.tabWidth = o.width / t.children().size() - 20;
                    o.tabWidthUnits = 'px';
                }
                if ((o.width > 100) && (o.widthUnits === "%")) {
                    helpers.displayError("width cannot be over 100%", o.errors);
                    return false;
                } else {
                    o.slideWidthUnits = o.widthUnits;
                    /* Set the units to be consistent */
                    if (o.widthUnits === "%") { /* Percentages */
                        o.slideWidth = 100 - ((t.children().size() - 1) * o.tabWidth);
                        /* Use 100% instead of the defined width */
                    } else { /* Pixels */
                        o.slideWidth = o.width - ((t.children().size() - 1) * o.tabWidth);
                    }
                    return true;
                }

            },
            timer: function (obj) {
                var n = obj.data("next") + 1;
                if (obj.data("pause") && obj.data("inside") && obj.data("auto")) {
                    try {
                        clearTimeout(obj.data("interval"));
                    } catch (e) {
                    }
                } else if (obj.data("pause") && !obj.data("inside") && obj.data("auto")) {
                    try {
                        clearTimeout(obj.data("interval"));
                    } catch (f) {
                    }
                    obj.data("interval", setTimeout(function () {
                        obj.children(obj.children().get(0).tagName + ":nth-child(" + n + ")").trigger(obj.data("trigger"));
                    }, obj.data("timeout")));
                } else if (!obj.data("pause") && obj.data("auto")) {
                    try {
                        clearTimeout(obj.data("interval"));
                    } catch (g) {
                    }
                    obj.data("interval", setTimeout(function () {
                        obj.children(obj.children().get(0).tagName + ":nth-child(" + n + ")").trigger(obj.data("trigger"));
                    }, obj.data("timeout")));
                }
            }
        }, methods = {
            init: function (options) {
                var f,
                    fixattr = ["slideWidth", "tabWidth", "startingSlide", "slideClass", "animationStart", "animationComplete", "buildComplete"];
                for (f = 0; f < fixattr.length; f += 1) {
                    if ($(this).data(fixattr[f].toLowerCase()) !== undefined) {
                        $(this).data(fixattr[f], $(this).data(fixattr[f].toLowerCase()));
                        $(this).removeData(fixattr[f].toLowerCase());
                    }
                }
                /* Add new properties to options. */
                options = $.extend(defaults, options, $(this).data());
                /* Check for a height */
                if (this.length <= 0) {
                    helpers.displayError("Selector does not exist", options.errors);
                    return false;
                } else if (!helpers.fixHeight(options)) {
                    helpers.displayError("height must be defined", options.errors);
                    return false;
                } else if (!helpers.findChildElements(this)) {
                    helpers.displayError("No child elements available", options.errors);
                    return false;
                } else if (options.speed > options.timeout) {
                    helpers.displayError("Speed cannot be greater than timeout", options.errors);
                    return false;
                } else {
                    /* Get the correct units */
                    options.heightUnits = helpers.getUnits(options.height);
                    options.height = helpers.toInteger(options.height);
                    options.widthUnits = helpers.getUnits(options.width);
                    options.width = helpers.toInteger(options.width);
                    options.slideWidthUnits = helpers.getUnits(options.slideWidth);
                    options.slideWidth = helpers.toInteger(options.slideWidth);
                    options.tabWidthUnits = helpers.getUnits(options.tabWidth);
                    options.tabWidth = helpers.toInteger(options.tabWidth);
                    if (options.slideClass !== null) {
                        options.slideOpenClass = options.slideClass + "-open";
                        /* Class of open slides. */
                        options.slideClosedClass = options.slideClass + "-closed";
                        /* Class of closed slides. */
                        options.slidePreviousClass = options.slideClass + "-previous";
                        /* Class of the slide that was previously open before a new one was triggered. */
                    }
                    /* Check for inconsistencies in size. */
                    if (!helpers.sizeAccordion(this, options)) {
                        return false;
                    } else {
                        return this.each(function () {
                            var o = options, obj = $(this), originals = [], /* inside = false, */ animate, tag,
                                childtag, size, previous = -1;
                            /* o: all of the options (defaults, user options, settings) */
                            animate = o.slideWidth - o.tabWidth;
                            /* Number of pixels yet do be displayed on a hidden slide. */
                            tag = obj.get(0).tagName;
                            /* Tag type of the container. */
                            childtag = obj.children().get(0).tagName;
                            /* Tag type of the children. */
                            size = obj.children().size();
                            /* Number of children. */
                            obj.data($.extend({}, {
                                auto: o.auto,
                                interval: null,
                                timeout: o.timeout,
                                trigger: o.trigger,
                                current: o.startingSlide,
                                previous: previous,
                                next: helpers.getNext(size, o.startingSlide),
                                slideClass: o.slideClass, /* Keeping this around right now only for the sake of the destroy function. */
                                inside: false,
                                pause: o.pause
                            })).addClass('vtem-drawer');
                            if (o.heightUnits === "%") {
                                var resizeHeightUnits = o.heightUnits;
                                var resizeHeight = o.height;
                                o.height = (obj.parent().get(0).tagName === "BODY") ? o.height * 0.01 * $(window).height() : obj.parent().width() / (100 / o.height);
                                o.heightUnits = "px";
                                /* Need to revert to pixels because CSS 100% height does not cooperate. */
                            }

                            /* Loop through each of the slides and set the layers. */
                            obj.children().each(function (childindex) {
                                var zindex, xpos, y;
                                xpos = o.invert ? xpos = ((size - 1) * o.tabWidth) - (childindex * o.tabWidth) : childindex * o.tabWidth;
                                /* Used for the position of each slide. */
                                originals[childindex] = xpos;
                                /* px position of each open slide. */
                                zindex = o.invert ? ((size - 1) - childindex) * 10 : childindex * 10;
                                /* Increase each slide's z-index by 10 so they sit on top of each other. */
                                if (o.slideClass !== null) {
                                    $(this).addClass(o.slideClass);
                                    /* Add the slide class to each of the slides. */
                                }
                                $(this).css({
                                    "top": 0,
                                    "z-index": zindex,
                                    "margin": 0,
                                    "padding": 0,
                                    "float": "left",
                                    "display": "block",
                                    "position": "absolute",
                                    "overflow": "hidden",
                                    "width": o.slideWidth + o.widthUnits,
                                    "height": o.height + o.heightUnits
                                });
                                if (childtag === "LI") {
                                    $(this).css({"text-indent": 0});
                                }
                                if (o.invert) {
                                    $(this).css({"right": xpos + o.widthUnits, "float": "right"});
                                } else {
                                    $(this).css({"left": xpos + o.widthUnits, "float": "left"});
                                }
                                if (childindex === (o.startingSlide)) {
                                    $(this).css("cursor", "default");
                                    if (o.slideClass !== null) {
                                        $(this).addClass(o.slideOpenClass);
                                    }
                                } else {
                                    $(this).css("cursor", "pointer");
                                    if (o.slideClass !== null) {
                                        $(this).addClass(o.slideClosedClass);
                                    }
                                    if ((childindex > (o.startingSlide)) && (!o.invert)) {
                                        y = childindex + 1;
                                        obj.children(childtag + ":nth-child(" + y + ")").css({
                                            left: originals[y - 1] + animate + o.widthUnits
                                        });
                                    } else if ((childindex < (o.startingSlide)) && (o.invert)) {
                                        y = childindex + 1;
                                        obj.children(childtag + ":nth-child(" + y + ")").css({
                                            right: originals[y - 1] + animate + o.widthUnits
                                        });
                                    }
                                }
                            });
                            /* Modify the CSS of the main container. */
                            obj.css({
                                "display": "block",
                                "height": o.height + o.heightUnits,
                                "width": o.width + o.widthUnits,
                                "padding": 0,
                                "position": "relative",
                                "overflow": "hidden"
                            });
                            /* If the container is a list, get rid of any bullets. */
                            if ((tag === "UL") || (tag === "OL")) {
                                obj.css({"list-style": "none"});
                            }
                            obj.hover(function () {
                                obj.data("inside", true);
                                /* If pause on hover, clear the timer. */
                                if (obj.data("pause")) {
                                    try {
                                        clearTimeout(obj.data("interval"));
                                    } catch (e) {
                                    }
                                }
                            }, function () {
                                obj.data("inside", false);
                                /* Restart the accordion when user moves mouse out of the slides. */
                                if (obj.data("auto") && obj.data("pause")) {
                                    helpers.timer(obj);
                                }
                            });
                            $(window).resize(function () {
                                if (resizeHeightUnits === "%")
                                    var startRH = obj.parent().width() / (100 / parseFloat(resizeHeight));
                                obj.height(startRH).children().height(startRH);
                            });
                            /* Set up the listener to change slides when triggered. */
                            obj.children().bind(o.trigger, function () {
                                /* Don't do anything if the slide is already open. */
                                if ($(this).index() !== obj.data("current")) {
                                    var i, j, p, c;
                                    /* p and c are 1-indexes */
                                    p = previous + 1;
                                    /* Using the 1-index for nth selector. */
                                    c = obj.data("current") + 1;
                                    /* Using the 1-index for nth selector. */
                                    if ((p !== 0) && (o.slideClass !== null)) {
                                        obj.children(childtag + ":nth-child(" + p + ")").removeClass(o.slidePreviousClass);
                                        /* Remove class for previous slide if previous slide exists. */
                                    }
                                    obj.children(childtag + ":nth-child(" + c + ")");
                                    if (o.slideClass !== null) {
                                        obj.children(childtag + ":nth-child(" + c + ")").addClass(o.slidePreviousClass);
                                    }
                                    previous = obj.data("current");
                                    obj.data("previous", obj.data("current"));
                                    p = previous;
                                    p += 1;
                                    obj.data("current", $(this).index());
                                    c = obj.data("current");
                                    c += 1;
                                    obj.children().css("cursor", "pointer");
                                    $(this).css("cursor", "default");
                                    /* Add the open class to the slide tab that was just triggered */
                                    if (o.slideClass !== null) {
                                        obj.children().addClass(o.slideClosedClass).removeClass(o.slideOpenClass);
                                        $(this).addClass(o.slideOpenClass).removeClass(o.slideClosedClass);
                                        /* Add the open class to the slide tab that was just triggered */
                                    }
                                    obj.data("next", helpers.getNext(size, $(this).index()));
                                    /* If the slide is not open... */
                                    helpers.timer(obj);
                                    o.animationStart();
                                    if (o.invert) {
                                        obj.children(childtag + ":nth-child(" + c + ")").stop().animate({right: originals[obj.data("current")] + o.widthUnits}, o.speed, o.easing, o.animationComplete);
                                    } else {
                                        obj.children(childtag + ":nth-child(" + c + ")").stop().animate({left: originals[obj.data("current")] + o.widthUnits}, o.speed, o.easing, o.animationComplete);
                                    }
                                    /* Closing other slides. */
                                    for (i = 0; i < size; i += 1) {
                                        j = i + 1;
                                        if (i < obj.data("current")) {
                                            if (o.invert) {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    right: o.width - (j * o.tabWidth) + o.widthUnits
                                                }, o.speed, o.easing);
                                            } else {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    left: originals[i] + o.widthUnits
                                                }, o.speed, o.easing);
                                            }
                                        }
                                        if (i > obj.data("current")) {
                                            if (o.invert) {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    right: (size - j) * o.tabWidth + o.widthUnits
                                                }, o.speed, o.easing);
                                            } else {
                                                obj.children(childtag + ":nth-child(" + j + ")").stop().animate({
                                                    left: originals[i] + animate + o.widthUnits
                                                }, o.speed, o.easing);
                                            }
                                        }
                                    }
                                    return false;
                                    /* This is important. If a visible link is clicked within the slide, it will open the slide instead of redirecting the link. */
                                }
                            });
                            /* Set up the original timer. */
                            if (obj.data("auto")) {
                                helpers.timer(obj);
                            }
                            o.buildComplete();
                        });
                    }
                }
            },
            stop: function () { /* This will stop the accordion unless the slides are clicked, however, it will not resume the autoplay. */
                if ($(this).data("auto")) {
                    clearTimeout($(this).data("interval"));
                    $(this).data("auto", false);
                }
            },
            start: function () { /* This will start the accordion back up if it has been stopped. */
                if (!$(this).data("auto")) {
                    var n = $(this).data("next") + 1;
                    $(this).data("auto", true);
                    $(this).children($(this).children().get(0).tagName + ":nth-child(" + n + ")").trigger($(this).data("trigger"));
                }
            },
            trigger: function (x) {
                if ((x >= $(this).children().size()) || (x < 0)) { /* If the triggered slide is out of range, trigger the first slide. */
                    x = 0;
                }
                x += 1;
                /* Use nth-child to trigger slide. */
                $(this).children($(this).children().get(0).tagName + ":nth-child(" + x + ")").trigger($(this).data("trigger"));
            },
            destroy: function (o) {
                var removestyle, removeclasses, prefix = $(this).data("slideClass");
                if (o !== undefined) {
                    removestyle = (o.removeStyleAttr !== undefined) ? o.removeStyleAttr : true;
                    removeclasses = (o.removeClasses !== undefined) ? o.removeClasses : false;
                }
                clearTimeout($(this).data("interval"));
                $(this).children().stop().unbind($(this).data("trigger"));
                $(this).unbind("mouseenter mouseleave mouseover mouseout");
                if (removestyle) {
                    $(this).removeAttr("style");
                    $(this).children().removeAttr("style");
                }
                if (removeclasses) {
                    $(this).children().removeClass(prefix);
                    $(this).children().removeClass(prefix + "-open");
                    $(this).children().removeClass(prefix + "-closed");
                    $(this).children().removeClass(prefix + "-previous");
                }
                $(this).removeData();
                if (o !== undefined) {
                    if (o.destroyComplete !== "undefined") {
                        if (typeof(o.destroyComplete.afterDestroy) !== "undefined") {
                            o.destroyComplete.afterDestroy();
                        }
                        if (o.destroyComplete.rebuild) {
                            return methods.init.apply(this, [o.destroyComplete.rebuild]);
                        }
                    }
                }
            }
        };
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === "object" || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error("zAccordion: " + method + " does not exist.");
        }
    };
}(jQuery));
