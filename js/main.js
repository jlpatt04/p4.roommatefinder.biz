//Main JS file for App
$(document).ready(function() {
	$('#loginForm').hide();
	$('#signupForm').hide();
}); 

$('.SignUp').click(function() {
	$('#wrapper2').hide(300);
	$('#signupForm').show();
}); 

$('.Login').click(function() {
        $('#wrapper2').hide(300);
        $('#loginForm').show();
});

$('.Profile').click(function() {
	window.location = "/users/profile/"
}); 

$('.Logout').click(function() {
	window.location = "/users/logout/"
})
   