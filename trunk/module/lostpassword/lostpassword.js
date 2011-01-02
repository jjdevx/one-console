$().ready(function() {
	
	// validate signup form on keyup and submit
	$("#lostpass").validate({
		rules: {
			email: {
				required: true,
				email: true,
				minlength: 3
				
			}
		},
		messages: {
			email: {
				required: " <br>Please provide a valid e-mail",
				minlength: " <br>Your username must be at least 3 characters long"
			}
		}
	});
		
});