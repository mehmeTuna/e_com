"use strict";
$('#contact > form').submit(function(e) {
	e.preventDefault();
	var name = $('#name').val(),
		email = $('#email').val(),
		message = $('#message').val(),
		sender = $('#sender').val(),
		sendButton = $('#ctc');

	$(this)[0].reset();
	sendButton.val('Thanks for contacting!');
	sendButton.css('backgroundColor','#85ca3b');
	$.ajax({
		type: 'POST',
		url: 'contact.php',
		data: {
			'name': name,
			'email': email,
			'message': message,
			'sender': sender
		}
	});
});