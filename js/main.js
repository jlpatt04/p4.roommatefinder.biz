
$(document).ready(function() {
	$('#loginForm').hide();
	$('#signupForm').hide();

	if(userHasPreferences){
		$('.Preferences').hide();
		$('.Profile').show();		
	}else if (!userHasPreferences) {
		$('.Preferences').show();
		$('.Profile').hide();
	}

	if(userLoginFailed){
		$('#wrapper2').hide(300);
		$('#loginForm').show();
		$('#wrapper').css("opacity", "1");
		$('#loginFailedErrorDiv').show();
	}
}); 

$('.SignUp').click(function() {
	$('#wrapper2').hide(300);
	$('#signupForm').show();
	$('#wrapper').css("opacity", "1");
}); 

$('.Login').click(function() {
    $('#wrapper2').hide(300);
    $('#loginForm').show();
    $('#wrapper').css("opacity", "1");
    $('#loginFailedErrorDiv').hide();
});

$('.Preferences').click(function() {
	window.location = "/users/preferences/"
}); 

$('.Profile').click(function() {
	window.location = "/users/profile/"
});

$('.Logout').click(function() {
	window.location = "/users/logout/"
});

/*$.validator.setDefaults({
	submitHandler: function() { alert("submitted!"); }
}); */

$().ready(function() {
$("#signupForm2").validate({
	rules: {
			first_name: "required",
			last_name: "required",
			email: {
				required: true,
				email: true,
			},
			password: {
				required: true,
				minlength: 5
			}
		},
	messages: {
			first_name: "Please enter your firstname",
			last_name: "Please enter your lastname",
			email: "Please enter a valid email address",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			}
		}
	});
});
