"use strict";
var pager = $('#pager');
/**
* sets pager width
* ------------------------------------------------
* @pager - pager to set width of 
*/
function setPagerWidth(pager) {
	var liWidth = 0, margin = -5, totalWidth;
	pager.children('li').each(function() {
	    liWidth += $(this).width();
	    margin += 5;
	});
	totalWidth = liWidth + margin;
	pager.css('width',totalWidth);
}

setPagerWidth(pager);
