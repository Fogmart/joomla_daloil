jQuery(document).ready(function(a){function e(b){b.each(function(){var b=a(this),c=b.find('[data-type="select"]'),e=b.find(".add-to-cart"),h=b.next(".cd-customization-trigger");c.on("click",function(b){var c=a(this);if(c.toggleClass("is-open"),g(c),a(b.target).is("li")){var d=a(b.target),e=d.index()+1;d.addClass("active").siblings().removeClass("active"),c.removeClass("selected-1 selected-2 selected-3").addClass("selected-"+e),c.hasClass("color")&&f(c,e-1)}}),e.on("click",function(){d||(d=!0,g(e),e.addClass("is-added").find("path").eq(0).animate({"stroke-dashoffset":0},300,function(){setTimeout(function(){i(),e.removeClass("is-added").find(".addtocart-button").on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){e.find("path").eq(0).css("stroke-dashoffset","19.79"),d=!1}),a(".no-csstransitions").length>0&&(e.find("path").eq(0).css("stroke-dashoffset","19.79"),d=!1)},600)}))}),h.on("click",function(a){a.preventDefault(),g(e)})})}function f(a,b){var c=a.parent(".cd-customization").prev("a").children(".cd-slider-wrapper"),d=c.children("li");d.eq(b).removeClass("move-left").addClass("selected").prevAll().removeClass("selected").addClass("move-left").end().nextAll().removeClass("selected move-left")}function g(a){a.siblings('[data-type="select"]').removeClass("is-open").end().parents(".cd-single-item").addClass("hover").parent("li").siblings("li").find(".cd-single-item").removeClass("hover").end().find('[data-type="select"]').removeClass("is-open")}function h(){b.parent(".cd-single-item").removeClass("hover").end().find('[data-type="select"]').removeClass("is-open")}function i(){!c.hasClass("items-added")&&c.addClass("items-added");var a=c.find("span"),b=parseInt(a.text())+1;a.text(b)}var b=a(".cd-customization"),c=a(".cd-cart"),d=!1;e(b),a("body").on("click",function(b){(a(b.target).is("body")||a(b.target).is(".cd-gallery"))&&h()})}),jQuery(document).ready(function(a){var b=a("#cd-menu-trigger"),c=a(".main-content"),d=a("#cart-menu");b.on("click",function(e){e.preventDefault(),b.toggleClass("is-clicked"),d.toggleClass("shopping-menu-is-open"),c.toggleClass("shopping-menu-is-open").one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){a("body").toggleClass("overflow-hidden")}),a("#cd-lateral-nav").toggleClass("shopping-menu-is-open"),a("html").hasClass("no-csstransitions")&&a("body").toggleClass("overflow-hidden")}),c.on("click",function(e){a(e.target).is("#cd-menu-trigger, #cd-menu-trigger span")||(b.removeClass("is-clicked"),d.removeClass("shopping-menu-is-open"),c.removeClass("shopping-menu-is-open").one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){a("body").removeClass("overflow-hidden")}),a("#cd-lateral-nav").removeClass("shopping-menu-is-open"),a("html").hasClass("no-csstransitions")&&a("body").removeClass("overflow-hidden"))}),a(".item-has-children").children("a").on("click",function(b){b.preventDefault(),a(this).toggleClass("submenu-open").next(".sub-menu").slideToggle(200).end().parent(".item-has-children").siblings(".item-has-children").children("a").removeClass("submenu-open").next(".sub-menu").slideUp(200)})});