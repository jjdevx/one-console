$().ready(function() {
	
	// validate signup form on keyup and submit
	$("#signup").validate({
		rules: {
			name: {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true,
				minlength: 5,
				remote: "/module/signup/ajax.emails.php"
			},
			username: {
				required: true,
				minlength: 2,
				remote: "/module/signup/ajax.username.php"
				
			},			
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: " <br>Please enter a valid email address",
				minlength: " <br>Your e-mail must be at least 5 characters long",
				remote: jQuery.format("{0} is already in use")
			},			
			username: {
				required: " <br>Please provide a username",
				minlength: " <br>Your username must be at least 5 characters long",
				remote: jQuery.format("{0} is already in use")
			},
			password: {
				required: " <br>Please provide a password",
				minlength: " <br>Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: " <br>Please provide a confirm password",
				minlength: " <br>Your password must be at least 5 characters long",
				equalTo: " <br>Please enter the same password as above"
			}
		}
	});
		
});