"use strict";
var calendar = $('#calendar'), days = $('#days'),
	month = $('#month'), week = $('#week'),
	calEvents = $('#cal-events');

function fillWeek(size) {
	week.empty();
	if(size == 'small') {
		week.append('<li>Sun</li>');
		week.append('<li>Mon</li>');
		week.append('<li>Tue</li>');
		week.append('<li>Wed</li>');
		week.append('<li>Thu</li>');
		week.append('<li>Fri</li>');
		week.append('<li>Sat</li>');
	} else {
		week.append('<li>Sunday</li>');
		week.append('<li>Monday</li>');
		week.append('<li>Tuesday</li>');
		week.append('<li>Wednesday</li>');
		week.append('<li>Thursday</li>');
		week.append('<li>Friday</li>');
		week.append('<li>Saturday</li>');
	}
}

function insertEvents() {
	calendar
		.find('#days > li')
		.filter('.marked')
		.each(function() {
			var featured = false,
				inactive = false,
				marked = $(this),
				day = marked.find('span').text(),
				title = marked.find('h6').text(),
				desc = marked.find('p').text(),
				li = $('<li>');
			featured = marked.hasClass('featured');
			inactive = marked.hasClass('inactive');
			if(featured)
				li.addClass('featured');
			if(inactive)
				li.addClass('inactive');
			li.append('<span>'+ day +'</span>');
			li.append('<h6>'+ title +'</h6>');
			li.append('<p>'+ desc +'</p>');
			calEvents.append(li);
		});
}

$(function() {
	var width = $(window).width();
	if(width < 1265) {
		calendar.addClass('small');
		if(calEvents.children().length == 0) {
			insertEvents();
		}
	}
	if(width < 900) {
		fillWeek('small');
	} else {
		fillWeek();
	}
});

// Responsive
var small = false,
	mid = false,
	big = false;
$(window).resize(function() {
	var width = $(window).width();
	if(!small && width < 1265) {
		calendar.addClass('small');
		if(calEvents.children().length == 0) {
			insertEvents();
		}
		small = true;
		big = false;
		mid = false;
	}
	if(!mid && width < 900) {
		fillWeek('small');
	}
	if(!mid && width > 900) {
		fillWeek();
	}
	if(!big && width > 1265) {
		calendar.removeClass('small');
		calEvents.empty();
		fillWeek();
		big = true;
		small = false;
		mid = false;
	}
});



