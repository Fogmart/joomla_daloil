/**
 * Flex
 * Template Name - Flex 2.7
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2017 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

/* Parallax */
(function($){'use strict';var $window=$(window);var windowHeight=$window.height();$window.resize(function(){windowHeight=$window.height()});$.fn.parallax=function(xpos,speedFactor,outerHeight){var $this=$(this);var getHeight;var firstTop;var paddingTop=0;$this.each(function(){firstTop=$this.offset().top});if(outerHeight){getHeight=function(jqo){return jqo.outerHeight(!0)}}else{getHeight=function(jqo){return jqo.height()}}if(arguments.length<1||xpos===null)xpos="50%";if(arguments.length<2||speedFactor===null)speedFactor=0.1;if(arguments.length<3||outerHeight===null)outerHeight=!0;function update(){var pos=$window.scrollTop();$this.each(function(){var $element=$(this);var top=$element.offset().top;var height=getHeight($element);if(top+height<pos||top>pos+windowHeight){return}
$this.css('backgroundPosition',xpos+" "+Math.round((firstTop-pos)*speedFactor)+"px")})}
$window.bind('scroll',update).resize(update);update()}})(jQuery)

	
jQuery(function($) {
	
	//Showing Parallax only on desktop
	var isDesktop = window.matchMedia("only screen and (min-width: 992px)");
    if (isDesktop.matches) {
		// =========== Parallax ===========
		 jQuery('.parallax').parallax("50%", 0.3);
		 jQuery('.parallax_2').parallax("50%", 0.2);
		 jQuery('.parallax_3').parallax("50%", 0.3);
		 jQuery('.parallax_4').parallax("50%", 0.4);
		 jQuery('.parallax_5').parallax("50%", 0.5);
		 jQuery('.parallax_6').parallax("50%", 0.6);
		 jQuery('.parallax_7').parallax("50%", 0.7);
		 jQuery('.parallax-2').parallax("50%", -0.2);
		 jQuery('.parallax-3').parallax("50%", -0.3);
		 jQuery('.parallax-4').parallax("50%", -0.4);
		 jQuery('.parallax-5').parallax("50%", -0.5);
		 jQuery('.parallax-6').parallax("50%", -0.6);
		 jQuery('.parallax-7').parallax("50%", -0.7);
	}
	 
    // ************    START JS    ************** //
	$(".layout-boxed section > div.container, .layout-boxed header > div.container, .layout-boxed footer > div.container, .layout-boxed header > div.container, .layout-boxed .sp-main-body > div.container").removeClass("container").addClass("container-fluid");
	$(".layout-boxed .sppb-row-container").removeClass("sppb-row-container").addClass("sppb-container-inner");
	$(".layout-boxed header #sp-menu").addClass("no-padding");
	$(".layout-boxed #sp-left, .layout-boxed #sp-right").addClass("container-fluid");
	
	if ($("#sp-left > div, #sp-right > div").hasClass("sp-column")) {
		$(".sppb-row-container").removeClass("sppb-row-container");
	} 
	 
  
    //Default
    if (typeof sp_offanimation === 'undefined' || sp_offanimation === '') {
        sp_offanimation = 'default';
    }

    if (sp_offanimation == 'default') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('offcanvas');
        });

        $('<div class="offcanvas-overlay"></div>').insertBefore('.offcanvas-menu');
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('offcanvas');
        });
    }

    // Slide Top Menu
    if (sp_offanimation == 'slidetop') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('slide-top-menu');
        });

        $('<div class="offcanvas-overlay"></div>').insertBefore('.offcanvas-menu');
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('slide-top-menu');
        });
    }

    //Full Screen
    if (sp_offanimation == 'fullscreen') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('full-screen-off-canvas');
        });
        $(document).ready(function () {
            $('.off-canvas-menu-init').addClass('full-screen');
        });
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('full-screen-off-canvas');
        });
    }

    //Full screen from top
    if (sp_offanimation == 'fullScreen-top') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('full-screen-off-canvas-ftop');
        });
        $(document).ready(function () {
            $('.off-canvas-menu-init').addClass('full-screen-ftop');
        });
        $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('full-screen-off-canvas-ftop');
        });
    }

    //Dark with plus
    if (sp_offanimation == 'drarkplus') {
        $('#offcanvas-toggler').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').addClass('new-look-off-canvas');
        });
        $('<div class="offcanvas-overlay"></div>').insertBefore('.offcanvas-menu');
        $(document).ready(function () {
            $('.off-canvas-menu-init').addClass('new-look');
        });
        $('.close-offcanvas,.offcanvas-overlay').on('click', function (event) {
            event.preventDefault();
            $('.off-canvas-menu-init').removeClass('new-look-off-canvas');
        });
    }
	
	//Sticky Header
	if ($("body.sticky-header").length > 0) {
		
		$("#sp-header").clone().appendTo("#fading-header");
		$("#sp-header .sp-megamenu-wrapper #offcanvas-toggler").insertBefore("#sp-header .sp-megamenu-wrapper .sp-megamenu-parent");
		$("#sp-header #cd-menu-trigger").prependTo("#sp-header #cart-menu").append("<div class=\"total_products\"></div>");
		$("#sp-header #cd-menu-trigger").prependTo("#sp-header .shopping-menu-is-open").append("<div class=\"total_products\"></div>"); 
		$("#offcanvas-toggler + #offcanvas-toggler, .cd-cart + .cd-cart").remove();
		
	
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 350) {
				$("#fading-header").show().addClass("sticky animated fadeInDown").removeClass("overflow-hidden");
				$("#cart-menu #cd-menu-trigger").addClass("menu-is-open");
				if (!$("#sp-header").hasClass("sticky")) {
					$("#sp-header .sp-megamenu-wrapper .sp-dropdown").hide();
					$(".top-search-input-wrap, .icon-top-wrapper .search-close-icon.open").hide();
				}
				
            } else {
                $("#fading-header").removeClass("sticky animated fadeInDown").addClass("overflow-hidden");
				$("#cart-menu #cd-menu-trigger").removeClass("menu-is-open");
				if (!$("#sp-header").hasClass("sticky")) {
					$("#sp-header .sp-megamenu-wrapper .sp-dropdown").show();
				}
				$(".icon-top-wrapper .search-open-icon").css("top", 0).show();
            }
        });
    }
	
	// Insert DIV arround Onepage, white
	$( "header.onepage, header.white, header.transparent-white, header.transparent" ).wrap( "<div class=\"transparent-wrapper\"></div>");

	
	$('header.onepage .sp-megamenu-parent > li:first-child').addClass("active");
 	$(window).on('scroll', function() {
		var headerHeight = $("#sp-header").height();
		if ($(window).scrollTop() > headerHeight) {
			$("#cart-menu").css("top", 0);
			$('header.onepage .sp-megamenu-parent > li:first-child').removeClass("active");
			$(".sticky .sp-megamenu-wrapper .sp-dropdown").show();
		} else {
			$("#cart-menu").css('top', 'auto');
			$('header.onepage ul, .nav.menu').find('li:first-child').each(function () {
				$('header.onepage ul, .nav.menu').find('li:not(":first-child")').removeClass("active");
				$('header.onepage .sp-megamenu-parent > li:first-child').addClass("active");
			});	
			$(".sticky .sp-megamenu-wrapper .sp-dropdown").hide();		
		}
		
	});
	
	// Onepage menu scrolling
	$('header.onepage .sp-megamenu-parent li a').addClass("page-scroll");
	
	//one page nav with smooth scroll and active nav
	if ($("header").hasClass("onepage")) {
		$('.offcanvas-menu li a').addClass("page-scroll");
		$('header.onepage .sp-megamenu-parent, .offcanvas-menu .menu').onePageNav({
			currentClass: 'active',
			changeHash: false,
			scrollSpeed: 900,
			scrollOffset: 30,
			scrollThreshold: 0.5,
			easing: 'easeInOutCubic',
			filter: '.page-scroll'
		});
	} 

    //Top Search
    var searchRow = $(".top-search-input-wrap").parent().closest(".top-search-wrap");
    $(".top-search-input-wrap").insertAfter(searchRow);
    $(".search-open-icon").on("click", function () {
		$(".top-search-input-wrap").show();
        $(this).hide();
        $(".search-close-icon").addClass("open").fadeIn(300);
        $(".top-search-wrap").addClass("active");
    });

    $(".search-close-icon").on("click", function () {
        $(this).hide();
        $(".search-open-icon").fadeIn(300);
        $(".top-search-wrap").removeClass("active");
    });
	
	// Scroll up/down to position	
	$('.page-scroll a, a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1200, 'easeInOutExpo');
        event.preventDefault();
    });
	
	$(".no-gutter").closest("[class*=\"col-\"]").addClass("no-gutter");

    // Preloader
    if (typeof sp_preloader === 'undefined') {
        sp_preloader = '';
    }

    if (sp_preloader) {
        $(window).on('load', function () {
            if ($('.sp-loader-with-logo').length > 0) {
                move();
            }
            setTimeout(function () {
                $('.sp-pre-loader').fadeOut();
            }, 1000);
        });
    } // has preloader
    //preloader Function
    function move() {
        var elem = document.getElementById("line-load");
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++;
                elem.style.width = width + '%';
            }
        }
    }

    // **************   START Mega SCRIPT   *************** //
    // **************************************************** //

    //mega menu
    $('.sp-megamenu-wrapper').parent().parent().css('position', 'static').parent().css('position', 'relative');
    $('.sp-menu-full').each(function () {
        $(this).parent().addClass('menu-justify');
    });

    // boxlayout
    if ($("body.layout-boxed").length > 0) {
        var windowWidth = $('#sp-header').parent().outerWidth();
        $("#sp-header").css({"width": windowWidth, "left": "auto"});
    }
 	
	
	$(".social-icons > li > a[href=#],.separator > a,.sppb-person-social > li > a[href=#],.sppb-addon-content > a[href=#],a.sppb-btn[href=#],.slick-img > a[href=#],.sp-layer a[href=#],[data-toggle=\"popover\"],.flex-icons a[href=#]").click(function(n){
    	n.preventDefault();
	});
	
	//AP Smart LayerSlider hash
	$('a[href^=\"#ap-smart-layerslider-\"]').click(function(e){
		if ( window.history && window.history.pushState ) { 
			window.history.pushState('', '', window.location.pathname);
		} else { 
			window.location.href = window.location.href.replace(/#.*$/, '#'); 
		}
	});
	
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();
	
	//Popover
  	$('[data-toggle="popover"]').popover();

    // Article Ajax voting
    $(document).on('click', '.sp-rating .star', function (event) {
        event.preventDefault();

        var data = {
            'action': 'voting',
            'user_rating': $(this).data('number'),
            'id': $(this).closest('.post_rating').attr('id')
        };

        var request = {
            'option': 'com_ajax',
            'plugin': 'helix3',
            'data': data,
            'format': 'json'
        };

        $.ajax({
            type: 'POST',
            data: request,
            beforeSend: function () {
                $('.post_rating .ajax-loader').show();
            },
            success: function (response) {
                var data = $.parseJSON(response.data);

                $('.post_rating .ajax-loader').hide();

                if (data.status == 'invalid') {
                    $('.post_rating .voting-result').text('You have already rated this entry!').fadeIn('fast');
                } else if (data.status == 'false') {
                    $('.post_rating .voting-result').text('Somethings wrong here, try again!').fadeIn('fast');
                } else if (data.status == 'true') {
                    var rate = data.action;
                    $('.voting-symbol').find('.star').each(function (i) {
                        if (i < rate) {
                            $(".star").eq(-(i + 1)).addClass('active');
                        }
                    });

                    $('.post_rating .voting-result').text('Thank You!').fadeIn('fast');
                }

            },
            error: function () {
                $('.post_rating .ajax-loader').hide();
                $('.post_rating .voting-result').text('Failed to rate, try again!').fadeIn('fast');
            }
        });
    });
	
	
    
		
	
	// Scroll to Top
    jQuery('body').append('<a href=\"#top\" id=\"scroll-top\"><i class=\"pe-7s-angle-up\"></i></a>');
	/*------------- Scroll to Top ------------------*/
	$(window).scroll(function(){if($(this).scrollTop() > 700){$('a#scroll-top').addClass('open')}else{$('a#scroll-top').removeClass('open')}});$('a#scroll-top').click(function(){$("html, body").animate({scrollTop:0},700);return false;});
	

//======== CSS Browser Selector v0.4.0 (https://github.com/rafaelp/css_browser_selector) ==========//
function css_browser_selector(u){var ua=u.toLowerCase(),is=function(t){return ua.indexOf(t)>-1},g='gecko',w='webkit',s='safari',o='opera',m='mobile',h=document.documentElement,b=[(!(/opera|webtv/i.test(ua))&&/msie\s(\d)/.test(ua))?('ie ie'+(/trident\/4\.0/.test(ua) ? '8' : RegExp.jQuery1)):is('firefox/2')?g+' ff2':is('firefox/3.5')?g+' ff3 ff3_5':is('firefox/3.6')?g+' ff3 ff3_6':is('firefox/3')?g+' ff3':is('gecko/')?g:is('opera')?o+(/version\/(\d+)/.test(ua)?' '+o+RegExp.jQuery1:(/opera(\s|\/)(\d+)/.test(ua)?' '+o+RegExp.jQuery2:'')):is('konqueror')?'konqueror':is('blackberry')?m+' blackberry':is('android')?m+' android':is('chrome')?w+' chrome':is('iron')?w+' iron':is('applewebkit/')?w+' '+s+(/version\/(\d+)/.test(ua)?' '+s+RegExp.jQuery1:''):is('mozilla/')?g:'',is('j2me')?m+' j2me':is('iphone')?m+' iphone':is('ipod')?m+' ipod':is('ipad')?m+' ipad':is('mac')?'mac':is('darwin')?'mac':is('webtv')?'webtv':is('win')?'win'+(is('windows nt 6.0')?' vista':''):is('freebsd')?'freebsd':(is('x11')||is('linux'))?'linux':'','js']; c = b.join(' '); h.className += ' '+c; return c;}; css_browser_selector(navigator.userAgent);	
	

/*  By Osvaldas Valutis, www.osvaldas.info; URL: https://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly */
;(function(e,t,n,r){e.fn.doubleTapToGo=function(r){if(!("ontouchstart"in t)&&!navigator.msMaxTouchPoints&&!navigator.userAgent.toLowerCase().match(/windows phone os 7/i))return false;this.each(function(){var t=false;e(this).on("click",function(n){var r=e(this);if(r[0]!=t[0]){n.preventDefault();t=r}});e(n).on("click touchstart MSPointerDown",function(n){var r=true,i=e(n.target).parents();for(var s=0;s<i.length;s++)if(i[s]==t[0])r=false;if(r)t=false})});return this}})(jQuery,window,document);
// Apply dropdown fix for mobile
jQuery(".mobile .sp-megamenu-parent .sp-has-child:has(ul)").doubleTapToGo();
		
});

