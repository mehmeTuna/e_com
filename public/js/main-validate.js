"use strict";
function subsValidation() {
	var email = document.getElementById('subs_email'),
		valid = true;

	// Email Validation
	if( !(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email.value)) ) {
	  	email.focus();
	  	email.className = 'error';
	  	valid = false;
	} else email.className = '';
	
	return valid;
}

function ctcValidation() {
	var name = document.getElementById('name'),
		email = document.getElementById('email'),
		message = document.getElementById('message'),
		valid = true;

	// Message Validation
	if(message.value == null || (message.value).length == 0 || /^\s+$/.test(message.value)) { 
	  	message.focus();
	  	message.className = 'error';
	  	valid = false;
	} else message.className = '';

	// Email Validation
	if( !(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email.value)) ) {
	  	email.focus();
	  	email.className = 'error';
	  	valid = false;
	} else email.className = '';

	// Name Validation
	if(name.value == null || (name.value).length == 0 || /^\s+$/.test(name.value)) { 
	  	name.focus();
	  	name.className = 'error';
	  	valid = false;
	} else name.className = '';

	return valid;
}

// Validate Subscribe
var subsButton = document.getElementById('subs');
subsButton.onclick = subsValidation;

// Validate Contact
var ctcButton = document.getElementById('ctc');
ctcButton.onclick = ctcValidation;
