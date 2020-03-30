$(function() {
	"use strict";
	/*** MAIN MENU SLIDE ANIMATION ***/
	var menu = $('#main-nav > ul > li'),
		width = $(window).width();
	/**
	 * Prevent sub-item click from bubbling up the DOM tree
	 */
	menu.find('ul > li').on('click', stopBubbling);

	if(width > 1024) {
		menu.bind('mouseenter', showMenu);
		menu.bind('mouseleave', hideMenu);
	} else {
		menu.filter('.sub-items').bind('click', toggleMenu);
	}

	/*** MAIN MENU RESPONSIVE ICON ***/
	var pull = $('#pull'),
        menu = $('nav > ul.responsive-nav');
  
    $(pull).on('click', function(e) {  
        e.preventDefault();  
        menu.slideToggle();  
    });  

	// flickr feed source
	var flickerAPI = "https://api.flickr.com/services/feeds/profile_photos.gne?nsid=52617155@N08&lang=es-us&jsoncallback=?";
	// get feed
	$.getJSON( flickerAPI, {
		format: "json"
	})
	.done(function( data ) {
		$.each( data.items, function( i, item ) {
			var ul = $('#flickr-w'),
				li = '<li><div class="circle small"><figure class="imgLiquidFill"><img src="'+item.media.m+'" alt="flickr-w"></figure><a href="'+item.link+'" target="_blank"><img src="images/plus-icon-small.png" alt="plus-icon-small"></a></div></li>';
			ul.append(li);
			// limit to 9 results
			return i<8;
		});
		/*-----------------
			IMAGE RESIZE
		-----------------*/
		$("figure.imgLiquidFill").imgLiquid();
	});
});

$(window).resize(function() {
	"use strict";
	var width = $(window).width(),
		menu = $('#main-nav > ul > li');
	if(width > 1024) {
		$('nav > ul.responsive-nav').hide();
		menu.filter('.sub-items').unbind();
		menu.bind('mouseenter', showMenu);
		menu.bind('mouseleave', hideMenu);
	} else {
		menu.unbind();
		menu.filter('.sub-items').bind('click', toggleMenu);
	}
});

function showMenu() {
	$(this).children('ul').stop().slideDown(300);
}

function hideMenu() {
	$(this).children('ul').stop().slideUp(300);
}

function toggleMenu(e) {
	e.preventDefault();
	$(this).children('ul').stop().slideToggle(300);
}

function stopBubbling(e) {
	e.stopPropagation();
}
