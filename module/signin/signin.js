$().ready(function() {
	
	// validate signup form on keyup and submit
	$("#login").validate({
		rules: {
			username: {
				required: true,
				minlength: 5				
			},
			password: {
				required: true,
				minlength: 5
			}
		},
		messages: {
			username: {
				required: " <br>Please provide a username",
				minlength: " <br>Your username must be at least 5 characters"
			},
			password: {
				required: " <br>Please provide a password",
				minlength: " <br>Your password must be at least 5 characters"
			}
		}
	});
		
});


