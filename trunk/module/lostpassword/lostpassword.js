$().ready(function() {
	
	// validate signup form on keyup and submit
	$("#lostpassword").validate({
		rules: {
			username: {
				required: true,
				minlength: 5
			}
		},
		messages: {
			username: {
				required: " Please provide a username",
				minlength: " Your username must be at least 5 characters long"
			}
		}
	});
		
});