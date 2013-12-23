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



   