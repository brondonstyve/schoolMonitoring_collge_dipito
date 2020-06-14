(function() {
    var ua = navigator.userAgent.toLowerCase();
    if ((ua.indexOf('webkit') > -1 || ua.indexOf('opera') > -1 || ua.indexOf('msie') > -1) && document.getElementById && window.addEventListener) {
        window.addEventListener('hashchange', function() {
            var element = document.getElementById(location.hash.substring(1));
            if (element) {
                if (!/^(?:a|select|input|button|textarea)$/i.test(element.nodeName)) { element.tabIndex = -1; }
                element.focus();
            }
        }, false);
    }
})();
/*!
 * EventEmitter v4.2.6 - git.io/ee
 * Oliver Caldwell
 * MIT license
 * @preserve
 */
(function() {
    'use strict';

    function EventEmitter() {}
    var proto = EventEmitter.prototype;
    var exports = this;
    var originalGlobalValue = exports.EventEmitter;

    function indexOfListener(listeners, listener) {
        var i = listeners.length;
        while (i--) { if (listeners[i].listener === listener) { return i; } }
        return -1;
    }



    function alias(name) { return function aliasClosure() { return this[name].apply(this, arguments); }; }
    proto.getListeners = function getListeners(evt) {
        var events = this._getEvents();
        var response;
        var key;
        if (typeof evt === 'object') { response = {}; for (key in events) { if (events.hasOwnProperty(key) && evt.test(key)) { response[key] = events[key]; } } } else { response = events[evt] || (events[evt] = []); }
        return response;
    };
    proto.flattenListeners = function flattenListeners(listeners) {
        var flatListeners = [];
        var i;
        for (i = 0; i < listeners.length; i += 1) { flatListeners.push(listeners[i].listener); }
        return flatListeners;
    };
    proto.getListenersAsObject = function getListenersAsObject(evt) {
        var listeners = this.getListeners(evt);
        var response;
        if (listeners instanceof Array) {
            response = {};
            response[evt] = listeners;
        }
        return response || listeners;
    };
    proto.addListener = function addListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var listenerIsWrapped = typeof listener === 'object';
        var key;
        for (key in listeners) { if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) { listeners[key].push(listenerIsWrapped ? listener : { listener: listener, once: false }); } }
        return this;
    };
    proto.on = alias('addListener');
    proto.addOnceListener = function addOnceListener(evt, listener) { return this.addListener(evt, { listener: listener, once: true }); };
    proto.once = alias('addOnceListener');
    proto.defineEvent = function defineEvent(evt) { this.getListeners(evt); return this; };
    proto.defineEvents = function defineEvents(evts) {
        for (var i = 0; i < evts.length; i += 1) { this.defineEvent(evts[i]); }
        return this;
    };
    proto.removeListener = function removeListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var index;
        var key;
        for (key in listeners) { if (listeners.hasOwnProperty(key)) { index = indexOfListener(listeners[key], listener); if (index !== -1) { listeners[key].splice(index, 1); } } }
        return this;
    };
    proto.off = alias('removeListener');
    proto.addListeners = function addListeners(evt, listeners) { return this.manipulateListeners(false, evt, listeners); };
    proto.removeListeners = function removeListeners(evt, listeners) { return this.manipulateListeners(true, evt, listeners); };
    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
        var i;
        var value;
        var single = remove ? this.removeListener : this.addListener;
        var multiple = remove ? this.removeListeners : this.addListeners;
        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
            for (i in evt) {
                if (evt.hasOwnProperty(i) && (value = evt[i])) {
                    if (typeof value === 'function') { single.call(this, i, value); } else { multiple.call(this, i, value); }
                }
            }
        } else { i = listeners.length; while (i--) { single.call(this, evt, listeners[i]); } }
        return this;
    };
    proto.removeEvent = function removeEvent(evt) {
        var type = typeof evt;
        var events = this._getEvents();
        var key;
        if (type === 'string') { delete events[evt]; } else if (type === 'object') { for (key in events) { if (events.hasOwnProperty(key) && evt.test(key)) { delete events[key]; } } } else { delete this._events; }
        return this;
    };
    proto.removeAllListeners = alias('removeEvent');
    proto.emitEvent = function emitEvent(evt, args) {
        var listeners = this.getListenersAsObject(evt);
        var listener;
        var i;
        var key;
        var response;
        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                i = listeners[key].length;
                while (i--) {
                    listener = listeners[key][i];
                    if (listener.once === true) { this.removeListener(evt, listener.listener); }
                    response = listener.listener.apply(this, args || []);
                    if (response === this._getOnceReturnValue()) { this.removeListener(evt, listener.listener); }
                }
            }
        }
        return this;
    };
    proto.trigger = alias('emitEvent');
    proto.emit = function emit(evt) { var args = Array.prototype.slice.call(arguments, 1); return this.emitEvent(evt, args); };
    proto.setOnceReturnValue = function setOnceReturnValue(value) { this._onceReturnValue = value; return this; };
    proto._getOnceReturnValue = function _getOnceReturnValue() {
        if (this.hasOwnProperty('_onceReturnValue')) { return this._onceReturnValue; } else { return true; }
    };
    proto._getEvents = function _getEvents() { return this._events || (this._events = {}); };
    EventEmitter.noConflict = function noConflict() { exports.EventEmitter = originalGlobalValue; return EventEmitter; };
    if (typeof define === 'function' && define.amd) { define('eventEmitter/EventEmitter', [], function() { return EventEmitter; }); } else if (typeof module === 'object' && module.exports) { module.exports = EventEmitter; } else { this.EventEmitter = EventEmitter; }
}.call(this));
/*!
 * eventie v1.0.4
 * event binding helper
 * eventie.bind( elem, 'click', myFn )
 * eventie.unbind( elem, 'click', myFn )
 */
(function(window) {
    var docElem = document.documentElement;
    var bind = function() {};

    function getIEEvent(obj) {
        var event = window.event;
        event.target = event.target || event.srcElement || obj;
        return event;
    }
    if (docElem.addEventListener) { bind = function(obj, type, fn) { obj.addEventListener(type, fn, false); }; } else if (docElem.attachEvent) {
        bind = function(obj, type, fn) {
            obj[type + fn] = fn.handleEvent ? function() {
                var event = getIEEvent(obj);
                fn.handleEvent.call(fn, event);
            } : function() {
                var event = getIEEvent(obj);
                fn.call(obj, event);
            };
            obj.attachEvent("on" + type, obj[type + fn]);
        };
    }
    var unbind = function() {};
    if (docElem.removeEventListener) { unbind = function(obj, type, fn) { obj.removeEventListener(type, fn, false); }; } else if (docElem.detachEvent) { unbind = function(obj, type, fn) { obj.detachEvent("on" + type, obj[type + fn]); try { delete obj[type + fn]; } catch (err) { obj[type + fn] = undefined; } }; }
    var eventie = { bind: bind, unbind: unbind };
    if (typeof define === 'function' && define.amd) { define('eventie/eventie', eventie); } else { window.eventie = eventie; }
})(this);
/*!
 * imagesLoaded v3.1.8
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
(function(window, factory) { if (typeof define === 'function' && define.amd) { define(['eventEmitter/EventEmitter', 'eventie/eventie'], function(EventEmitter, eventie) { return factory(window, EventEmitter, eventie); }); } else if (typeof exports === 'object') { module.exports = factory(window, require('wolfy87-eventemitter'), require('eventie')); } else { window.imagesLoaded = factory(window, window.EventEmitter, window.eventie); } })(window, function factory(window, EventEmitter, eventie) {
    var $ = window.jQuery;
    var console = window.console;
    var hasConsole = typeof console !== 'undefined';

    function extend(a, b) {
        for (var prop in b) { a[prop] = b[prop]; }
        return a;
    }
    var objToString = Object.prototype.toString;

    function isArray(obj) { return objToString.call(obj) === '[object Array]'; }

    function makeArray(obj) {
        var ary = [];
        if (isArray(obj)) { ary = obj; } else if (typeof obj.length === 'number') { for (var i = 0, len = obj.length; i < len; i++) { ary.push(obj[i]); } } else { ary.push(obj); }
        return ary;
    }

    function ImagesLoaded(elem, options, onAlways) {
        if (!(this instanceof ImagesLoaded)) { return new ImagesLoaded(elem, options); }
        if (typeof elem === 'string') { elem = document.querySelectorAll(elem); }
        this.elements = makeArray(elem);
        this.options = extend({}, this.options);
        if (typeof options === 'function') { onAlways = options; } else { extend(this.options, options); }
        if (onAlways) { this.on('always', onAlways); }
        this.getImages();
        if ($) { this.jqDeferred = new $.Deferred(); }
        var _this = this;
        setTimeout(function() { _this.check(); });
    }
    ImagesLoaded.prototype = new EventEmitter();
    ImagesLoaded.prototype.options = {};
    ImagesLoaded.prototype.getImages = function() {
        this.images = [];
        for (var i = 0, len = this.elements.length; i < len; i++) {
            var elem = this.elements[i];
            if (elem.nodeName === 'IMG') { this.addImage(elem); }
            var nodeType = elem.nodeType;
            if (!nodeType || !(nodeType === 1 || nodeType === 9 || nodeType === 11)) { continue; }
            var childElems = elem.querySelectorAll('img');
            for (var j = 0, jLen = childElems.length; j < jLen; j++) {
                var img = childElems[j];
                this.addImage(img);
            }
        }
    };
    ImagesLoaded.prototype.addImage = function(img) {
        var loadingImage = new LoadingImage(img);
        this.images.push(loadingImage);
    };
    ImagesLoaded.prototype.check = function() {
        var _this = this;
        var checkedCount = 0;
        var length = this.images.length;
        this.hasAnyBroken = false;
        if (!length) { this.complete(); return; }

        function onConfirm(image, message) {
            if (_this.options.debug && hasConsole) { console.log('confirm', image, message); }
            _this.progress(image);
            checkedCount++;
            if (checkedCount === length) { _this.complete(); }
            return true;
        }
        for (var i = 0; i < length; i++) {
            var loadingImage = this.images[i];
            loadingImage.on('confirm', onConfirm);
            loadingImage.check();
        }
    };
    ImagesLoaded.prototype.progress = function(image) {
        this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
        var _this = this;
        setTimeout(function() { _this.emit('progress', _this, image); if (_this.jqDeferred && _this.jqDeferred.notify) { _this.jqDeferred.notify(_this, image); } });
    };
    ImagesLoaded.prototype.complete = function() {
        var eventName = this.hasAnyBroken ? 'fail' : 'done';
        this.isComplete = true;
        var _this = this;
        setTimeout(function() {
            _this.emit(eventName, _this);
            _this.emit('always', _this);
            if (_this.jqDeferred) {
                var jqMethod = _this.hasAnyBroken ? 'reject' : 'resolve';
                _this.jqDeferred[jqMethod](_this);
            }
        });
    };
    if ($) { $.fn.imagesLoaded = function(options, callback) { var instance = new ImagesLoaded(this, options, callback); return instance.jqDeferred.promise($(this)); }; }

    function LoadingImage(img) { this.img = img; }
    LoadingImage.prototype = new EventEmitter();
    LoadingImage.prototype.check = function() {
        var resource = cache[this.img.src] || new Resource(this.img.src);
        if (resource.isConfirmed) { this.confirm(resource.isLoaded, 'cached was confirmed'); return; }
        if (this.img.complete && this.img.naturalWidth !== undefined) { this.confirm(this.img.naturalWidth !== 0, 'naturalWidth'); return; }
        var _this = this;
        resource.on('confirm', function(resrc, message) { _this.confirm(resrc.isLoaded, message); return true; });
        resource.check();
    };
    LoadingImage.prototype.confirm = function(isLoaded, message) {
        this.isLoaded = isLoaded;
        this.emit('confirm', this, message);
    };
    var cache = {};

    function Resource(src) {
        this.src = src;
        cache[src] = this;
    }
    Resource.prototype = new EventEmitter();
    Resource.prototype.check = function() {
        if (this.isChecked) { return; }
        var proxyImage = new Image();
        eventie.bind(proxyImage, 'load', this);
        eventie.bind(proxyImage, 'error', this);
        proxyImage.src = this.src;
        this.isChecked = true;
    };
    Resource.prototype.handleEvent = function(event) { var method = 'on' + event.type; if (this[method]) { this[method](event); } };
    Resource.prototype.onload = function(event) {
        this.confirm(true, 'onload');
        this.unbindProxyEvents(event);
    };
    Resource.prototype.onerror = function(event) {
        this.confirm(false, 'onerror');
        this.unbindProxyEvents(event);
    };
    Resource.prototype.confirm = function(isLoaded, message) {
        this.isConfirmed = true;
        this.isLoaded = isLoaded;
        this.emit('confirm', this, message);
    };
    Resource.prototype.unbindProxyEvents = function(event) {
        eventie.unbind(event.target, 'load', this);
        eventie.unbind(event.target, 'error', this);
    };
    return ImagesLoaded;
});;
(function($, window, undefined) {
    var $allDropdowns = $();
    $.fn.dropdownHover = function(options) {
        if ('ontouchstart' in document) return this;
        $allDropdowns = $allDropdowns.add(this.parent());
        return this.each(function() {
            var $this = $(this),
                $parent = $this.parent(),
                defaults = { delay: 500, hoverDelay: 0, instantlyCloseOthers: true },
                data = { delay: $(this).data('delay'), hoverDelay: $(this).data('hover-delay'), instantlyCloseOthers: $(this).data('close-others') },
                showEvent = 'show.bs.dropdown',
                hideEvent = 'hide.bs.dropdown',
                settings = $.extend(true, {}, defaults, options, data),
                timeout, timeoutHover;
            $parent.hover(function(event) {
                if (!$parent.hasClass('open') && !$this.is(event.target)) { return true; }
                openDropdown(event);
            }, function() {
                window.clearTimeout(timeoutHover)
                timeout = window.setTimeout(function() {
                    $this.attr('aria-expanded', 'false');
                    $parent.removeClass('open');
                    $this.trigger(hideEvent);
                }, settings.delay);
            });
            $this.hover(function(event) {
                if (!$parent.hasClass('open') && !$parent.is(event.target)) { return true; }
                openDropdown(event);
            });
            $parent.find('.dropdown-submenu').each(function() {
                var $this = $(this);
                var subTimeout;
                $this.hover(function() {
                    window.clearTimeout(subTimeout);
                    $this.children('.dropdown-menu').show();
                    $this.siblings().children('.dropdown-menu').hide();
                }, function() {
                    var $submenu = $this.children('.dropdown-menu');
                    subTimeout = window.setTimeout(function() { $submenu.hide(); }, settings.delay);
                });
            });

            function openDropdown(event) {
                window.clearTimeout(timeout);
                window.clearTimeout(timeoutHover);
                timeoutHover = window.setTimeout(function() {
                    $allDropdowns.find(':focus').blur();
                    if (settings.instantlyCloseOthers === true)
                        $allDropdowns.removeClass('open');
                    window.clearTimeout(timeoutHover);
                    $this.attr('aria-expanded', 'true');
                    $parent.addClass('open');
                    $this.trigger(showEvent);
                }, settings.hoverDelay);
            }
        });
    };
    $(document).ready(function() { $('[data-hover="dropdown"]').dropdownHover(); });
    $(document.body).on('click', '.nav [data-toggle="dropdown"]', function() { if (this.href && this.href != '#') { window.location.href = this.href; } });
})(jQuery, window);
(function($) {
    $("[data-progress-animation]").each(function() {
        var $this = $(this);
        $this.appear(function() {
            var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);
            if (delay > 1) $this.css("animation-delay", delay + "ms");
            setTimeout(function() { $this.animate({ width: $this.attr("data-progress-animation") }, 800); }, delay);
        }, { accX: 0, accY: -50 });
    });
    $.fn.wrapStart = function(numWords) {
        return this.each(function() {
            var $this = $(this);
            var node = $this.contents().filter(function() { return this.nodeType == 3; }).first(),
                text = node.text().trim(),
                first = text.split(' ', 1).join(" ");
            if (!node.length) return;
            node[0].nodeValue = text.slice(first.length);
            node.before('<b>' + first + '</b>');
        });
    };
    jQuery(document).ready(function() {
        $('.mod-heading .widget-title > span').wrapStart(1);

        function init_owl() {
            $(".owl-carousel[data-carousel=owl]").each(function() {
                var config = { loop: false, nav: $(this).data('nav'), dots: $(this).data('pagination'), items: 4, navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'] };
                var owl = $(this);
                if ($(this).data('items')) { config.items = $(this).data('items'); }
                if ($(this).data('large')) { var desktop = $(this).data('large'); } else { var desktop = config.items; }
                if ($(this).data('medium')) { var medium = $(this).data('medium'); } else { var medium = config.items; }
                if ($(this).data('smallmedium')) { var smallmedium = $(this).data('smallmedium'); } else { var smallmedium = config.items; }
                if ($(this).data('extrasmall')) { var extrasmall = $(this).data('extrasmall'); } else { var extrasmall = 2; }
                if ($(this).data('verysmall')) { var verysmall = $(this).data('verysmall'); } else { var verysmall = 1; }
                config.responsive = { 0: { items: verysmall }, 320: { items: extrasmall }, 768: { items: smallmedium }, 980: { items: medium }, 1280: { items: desktop } }
                if ($('html').attr('dir') == 'rtl') { config.rtl = true; }
                $(this).owlCarousel(config);
                var viewport = jQuery(window).width();
                var itemCount = jQuery(".owl-item", $(this)).length;
                if ((viewport >= 1280 && itemCount <= desktop) || ((viewport >= 980 && viewport < 1280) && itemCount <= medium) || ((viewport >= 768 && viewport < 980) && itemCount <= smallmedium) || ((viewport >= 320 && viewport < 768) && itemCount <= extrasmall) || (viewport < 320 && itemCount <= verysmall)) { $(this).find('.owl-prev, .owl-next').hide(); }
            });
        }
        init_owl();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href");
            var carousel = $(".owl-carousel[data-carousel=owl]", target).data('owlCarousel');
            if ($(".owl-carousel[data-carousel=owl]", target).length > 0) {
                carousel._width = $(".owl-carousel[data-carousel=owl]", target).width();
                carousel.invalidate('width');
                carousel.refresh();
            }
            initProductImageLoad();
        });
        $('[data-load="ajax"] a').click(function() {
            var $href = $(this).attr('href');
            var self = $(this);
            var main = $($href);
            if (main.length > 0 && main.data('loaded') == false) {
                var height = main.parent().find('.tab-pane').first().height();
                main.data('loaded', 'true');
                var loading = $('<div class="ajax-loading"></div>');
                loading.css('height', height);
                main.html(loading);
                $.ajax({
                    url: campress_ajax.ajaxurl,
                    type: 'POST',
                    dataType: 'html',
                    data: 'action=campress_get_products&columns=' + main.data('columns') + '&product_type=' + main.data('product_type') + '&number=' + main.data('number') +
                        '&categories=' + main.data('categories') + '&layout_type=' + main.data('layout_type')
                }).done(function(reponse) {
                    main.html(reponse);
                    if (main.find('.owl-carousel')) { init_owl(); }
                    initProductImageLoad();
                });
                return true;
            }
        });
    })
    setTimeout(function() { initProductImageLoad(); }, 500);

    function initProductImageLoad() {
        $(window).off('scroll.unveil resize.unveil lookup.unveil');
        var $images = $('.image-wrapper:not(.image-loaded) .unveil-image');
        if ($images.length) {
            var scrollTolerance = 1;
            $images.unveil(scrollTolerance, function() { $(this).parents('.image-wrapper').first().addClass('image-loaded'); });
        }
        var $images = $('.product-image:not(.image-loaded) .unveil-image');
        if ($images.length) {
            var scrollTolerance = 1;
            $images.unveil(scrollTolerance, function() { $(this).parents('.product-image').first().addClass('image-loaded'); });
        }
    }
    $("[data-testimonial=content]").each(function() {
        var self = $(this);
        var owl = $(this).find('.owl-carousel');
        setTimeout(function() {
            owl.find('.testimonials-body').removeClass('active');
            owl.find('.owl-item.active').eq(2).find('.testimonials-body').addClass('active');
            self.find('.testimonial-content').html('').fadeOut(300);
            self.find('.testimonial-content').html(owl.find('.owl-item.active').eq(2).find('.description').html()).fadeIn(300);
        }, 100);
        owl.on('changed.owl.carousel', function(property) {
            setTimeout(function() {
                owl.find('.testimonials-body').removeClass('active');
                owl.find('.owl-item.active').eq(2).find('.testimonials-body').addClass('active');
                self.find('.testimonial-content').html('').fadeOut(300);
                self.find('.testimonial-content').html(owl.find('.owl-item.active').eq(2).find('.description').html()).fadeIn(300);
            }, 100);
        });
        $(this).find('.testimonials-body').click(function() {
            self.find('.testimonials-body').removeClass('active');
            $(this).addClass('active');
            self.find('.testimonial-content').html('').fadeOut(300);
            self.find('.testimonial-content').html($(this).find('.description').html()).fadeIn(300);
        });
    });
})(jQuery)
jQuery(document).ready(function($) {
    $('[data-toggle="offcanvas"], .btn-offcanvas').on('click', function() { $('.row-offcanvas').toggleClass('active') });
    $("#main-menu-offcanvas .caret").on('click', function() {
        $("#main-menu-offcanvas .dropdown").removeClass('open');
        $(this).parent().addClass('open');
        return false;
    });
    if ($('.counterUp').length > 0) { $('.counterUp').counterUp({ delay: 10, time: 800 }); }
    jQuery('.isotope-items,.blog-masonry').each(function() {
        var $container = jQuery(this);
        $container.imagesLoaded(function() { $container.isotope({ itemSelector: '.isotope-item', transformsEnabled: true }); });
    });
    jQuery('.isotope-filter li a').on('click', function() {
        var parentul = jQuery(this).parents('ul.isotope-filter').data('related-grid');
        jQuery(this).parents('ul.isotope-filter').find('li a').removeClass('active');
        jQuery(this).addClass('active');
        var selector = jQuery(this).attr('data-filter');
        jQuery('#' + parentul).isotope({ filter: selector }, function() {});
        return (false);
    });
    setTimeout(function() { change_margin_top(); }, 200);
    $(window).resize(function() { change_margin_top(); });

    function change_margin_top() {
        if ($(window).width() > 991) {
            if ($('.main-sticky-header').length > 0) {
                var header_height = $('.main-sticky-header').outerHeight();
                $('.main-sticky-header-wrapper').css({ 'height': header_height });
            }
        }
    }
    var main_sticky = $('.main-sticky-header');
    if (main_sticky.length > 0) {
        var _menu_action = main_sticky.offset().top;
        var Apus_Menu_Fixed = function() { "use strict"; if ($(document).scrollTop() > _menu_action) { main_sticky.addClass('sticky-header'); } else { main_sticky.removeClass('sticky-header'); } }
        if ($(window).width() > 991) {
            $(window).scroll(function(event) { Apus_Menu_Fixed(); });
            Apus_Menu_Fixed();
        }
    }
    $(function() { $('[data-toggle="tooltip"]').tooltip() })
    $('.topbar-mobile .dropdown-menu').on('click', function(e) { e.stopPropagation(); });
    var back_to_top = function() {
        jQuery(window).scroll(function() { if (jQuery(this).scrollTop() > 400) { jQuery('#back-to-top').addClass('active'); } else { jQuery('#back-to-top').removeClass('active'); } });
        jQuery('#back-to-top').on('click', function() { jQuery('html, body').animate({ scrollTop: '0px' }, 800); return false; });
    };
    back_to_top();
    $(document).ready(function() {
        $(".popup-image").magnificPopup({ type: 'image' });
        $('.popup-video').magnificPopup({ disableOn: 700, type: 'iframe', mainClass: 'mfp-fade', removalDelay: 160, preloader: false, fixedContentPos: false });
        $('.popup-gallery').magnificPopup({ type: 'image', gallery: { enabled: true } });
    });
    $('[data-toggle="offcanvas"], .btn-offcanvas').on('click', function(e) {
        e.stopPropagation();
        $('#wrapper-container').toggleClass('active');
        $('#apus-mobile-menu').toggleClass('active');
    });
    $('body').click(function() {
        if ($('#wrapper-container').hasClass('active')) {
            $('#wrapper-container').toggleClass('active');
            $('#apus-mobile-menu').toggleClass('active');
        }
    });
    $('#apus-mobile-menu').click(function(e) { e.stopPropagation(); });
    $("#main-mobile-menu .icon-toggle").on('click', function() {
        $(this).parent().find('.sub-menu').first().slideToggle();
        if ($(this).find('i').hasClass('fa-angle-right')) { $(this).find('i').removeClass('fa-angle-right').addClass('fa-angle-up'); } else { $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-right'); }
        return false;
    });
    var $body = $('body');
    if ($body.hasClass('apus-body-loading')) {
        setTimeout(function() {
            $body.removeClass('apus-body-loading');
            $('.apus-page-loading').fadeOut(250);
        }, 300);
    }
    iframe_full_width();

    function iframe_full_width() {
        var $fluidEl = $(".pro-fluid-inner");
        var $videoEls = $(".pro-fluid-inner iframe");
        $videoEls.each(function() { $(this).data('aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width'); });
        $(window).resize(function() {
            $fluidEl.each(function() {
                var newWidth = $(this).width();
                var $videoEl = $(this).find("iframe");
                $videoEl.each(function() {
                    var $el = $(this);
                    $el.width(newWidth).height(newWidth * $el.data('aspectRatio'));
                });
            });
        }).resize();
    }
    $('.widget-categories-tabs .nav-tabs-selector').perfectScrollbar();
    $('.apus-categories-wrapper').perfectScrollbar();
    if ($('.popuppromotion').length > 0) {
        setTimeout(function() {
            var hiddenmodal = getCookie('hidde_popup_promotion');
            if (hiddenmodal == "") {
                var popup_content = $('.popuppromotion').html();
                $.magnificPopup.open({ mainClass: 'apus-mfp-zoom-in popuppromotion-wrapper', modal: true, items: { src: popup_content, type: 'inline' }, callbacks: { close: function() { setCookie('hidde_popup_promotion', 1, 30); } } });
            }
        }, 3000);
    }
    if ($('.popupnewsletter').length > 0) {
        setTimeout(function() {
            var hiddenmodal = getCookie('hidde_popup_newsletter');
            if (hiddenmodal == "") {
                var popup_content = $('.popupnewsletter').html();
                $.magnificPopup.open({ mainClass: 'apus-mfp-zoom-in popupnewsletter-wrapper', modal: true, items: { src: popup_content, type: 'inline' }, callbacks: { close: function() { setCookie('hidde_popup_newsletter', 1, 30); } } });
            }
        }, 3000);
    }
    $('.apus-mfp-close').click(function() { magnificPopup.close(); });
});
(function($) {
    $.fn.apusCountDown = function(options) { return this.each(function() { new $.apusCountDown(this, options); }); }
    $.apusCountDown = function(obj, options) {
        this.options = $.extend({ autoStart: true, LeadingZero: true, DisplayFormat: "<div>%%D%% Days</div><div>%%H%% Hours</div><div>%%M%% Minutes</div><div>%%S%% Seconds</div>", FinishMessage: "Expired", CountActive: true, TargetDate: null }, options || {});
        if (this.options.TargetDate == null || this.options.TargetDate == '') { return; }
        this.timer = null;
        this.element = obj;
        this.CountStepper = -1;
        this.CountStepper = Math.ceil(this.CountStepper);
        this.SetTimeOutPeriod = (Math.abs(this.CountStepper) - 1) * 1000 + 990;
        var dthen = new Date(this.options.TargetDate);
        var dnow = new Date();
        if (this.CountStepper > 0) { ddiff = new Date(dnow - dthen); } else { ddiff = new Date(dthen - dnow); }
        gsecs = Math.floor(ddiff.valueOf() / 1000);
        this.CountBack(gsecs, this);
    };
    $.apusCountDown.fn = $.apusCountDown.prototype;
    $.apusCountDown.fn.extend = $.apusCountDown.extend = $.extend;
    $.apusCountDown.fn.extend({
        calculateDate: function(secs, num1, num2) {
            var s = ((Math.floor(secs / num1)) % num2).toString();
            if (this.options.LeadingZero && s.length < 2) { s = "0" + s; }
            return "<span>" + s + "</span>";
        },
        CountBack: function(secs, self) {
            if (secs < 0) { self.element.innerHTML = '<div class="lof-labelexpired"> ' + self.options.FinishMessage + "</div>"; return; }
            clearInterval(self.timer);
            DisplayStr = self.options.DisplayFormat.replace(/%%D%%/g, self.calculateDate(secs, 86400, 100000));
            DisplayStr = DisplayStr.replace(/%%H%%/g, self.calculateDate(secs, 3600, 24));
            DisplayStr = DisplayStr.replace(/%%M%%/g, self.calculateDate(secs, 60, 60));
            DisplayStr = DisplayStr.replace(/%%S%%/g, self.calculateDate(secs, 1, 60));
            self.element.innerHTML = DisplayStr;
            if (self.options.CountActive) {
                self.timer = null;
                self.timer = setTimeout(function() { self.CountBack((secs + self.CountStepper), self); }, (self.SetTimeOutPeriod));
            }
        }
    });
    $(document).ready(function() {
        $('[data-time="timmer"]').each(function(index, el) {
            var $this = $(this);
            var $date = $this.data('date').split("-");
            $this.apusCountDown({ TargetDate: $date[0] + "/" + $date[1] + "/" + $date[2] + " " + $date[3] + ":" + $date[4] + ":" + $date[5], DisplayFormat: "<div class=\"times\"><div class=\"day\">%%D%% Days </div><div class=\"hours\">%%H%% Hours </div><div class=\"minutes\">%%M%% Mins </div><div class=\"seconds\">%%S%% Sec </div></div>", FinishMessage: "" });
        });
    });
    $('.close-search-form').click(function() {
        $('.full-top-search-form').removeClass('show');
        $('#searchverlay').removeClass('show');
    });
    $('.button-show-search').click(function() {
        $('.full-top-search-form').toggleClass('show');
        $('#searchverlay').toggleClass('show');
    });
    $('.kc-google-maps').click(function() { $('.kc-google-maps iframe').css("pointer-events", "auto"); });
    if ($('.comment-form-rating').length > 0) {
        var $star = $('.comment-form-rating .filled');
        var $review = $('#apus_input_rating');
        $star.find('li').on('mouseover', function() {
            $(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
            $(this).prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
            $(this).find('span').removeClass('fa-star-o').addClass('fa-star');
            $review.val($(this).index() + 1);
        });
    }
    var affix_height = 0;
    var affix_height_top = 0;
    setTimeout(function() { change_margin_top_affix(); }, 50);
    $(window).resize(function() { change_margin_top_affix(); });

    function change_margin_top_affix() {
        if ($(window).width() > 991) {
            if ($('.panel-affix').length > 0) {
                affix_height_top = affix_height = $('.panel-affix').height();
                $('.panel-affix-wrapper').css({ 'height': affix_height });
            }
        }
    }
    var stickyElement = '.panel-affix',
        bottomElement = '#apus-footer';
    if ($(stickyElement).length) {
        $(stickyElement).each(function() {
            var header_height = 0;
            if ($('.main-sticky-header').length > 0) {
                header_height = $('.main-sticky-header').outerHeight();
                affix_height_top = affix_height + header_height;
            }
            var fromTop = $(this).offset().top,
                fromBottom = $(document).height() - ($(this).offset().top + $(this).outerHeight()),
                stopOn = $(document).height() - ($(bottomElement).offset().top) + ($(this).outerHeight() - $(this).height());
            if ((fromBottom - stopOn) > 200) {
                $(this).css('width', $(this).width()).css('top', 0).css('position', '');
                $(this).affix({ offset: { top: fromTop - header_height, bottom: stopOn } }).on('affix.bs.affix', function() {
                    var header_height = 0;
                    if ($('.main-sticky-header').length > 0) { header_height = $('.main-sticky-header').outerHeight(); }
                    affix_height_top = affix_height + header_height;
                    $(this).css('top', header_height).css('position', '');
                });
            }
            $(window).trigger('scroll');
        });
    }
    $('body').scrollspy({ offset: 80 });
    $('.apus-tabs.panel-affix a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) { $('html,body').animate({ scrollTop: target.offset().top - affix_height_top }, 1000); return false; }
        }
    });
    $('body').on('mouseenter', '.accept-account', function() { $('.accept-account a[data-toggle=dropdown]').click(); }).on('mouseleave', '.accept-account', function() { $('.accept-account a[data-toggle=dropdown]').click(); });
})(jQuery)

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) { var c = ca[i]; while (c.charAt(0) == ' ') c = c.substring(1); if (c.indexOf(name) == 0) return c.substring(name.length, c.length); }
    return "";
}
jQuery(document).ready(function($) {
    $(".edr-syllabus .group").each(function(e) {
        var self = $(this);
        if (e == 0) {
            self.toggleClass("active");
            self.find(".group-body").slideToggle();
            if (self.find('i').hasClass('mn-icon-161')) { self.find('i').removeClass('mn-icon-161').addClass('mn-icon-160'); } else { self.find('i').removeClass('mn-icon-160').addClass('mn-icon-161'); }
        }
        $('.group-header', self).click(function() {
            self.toggleClass("active");
            self.find(".group-body").slideToggle();
            if (self.find('i').hasClass('mn-icon-161')) { self.find('i').removeClass('mn-icon-161').addClass('mn-icon-160'); } else { self.find('i').removeClass('mn-icon-160').addClass('mn-icon-161'); }
        });
    });
    $('.course-lesson-sidebar-btn').click(function(e) {
        e.preventDefault();
        $('.course-lesson-sidebar').toggleClass('active');
    });
});