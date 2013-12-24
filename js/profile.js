$('.Logout2').click(function() {
	window.location = "/users/logout/"
});

$('.Home').click(function() {
	window.location = "/"
});

$('#target').submit(function() {

	userSelectedACheckbox = false;
	for(i = 0; i < 10; i++){
		fieldName = 'input[name="neighborhood['+i+']"]';
		value = $('#target').find(fieldName).attr("checked");
		if(value){
			userSelectedACheckbox = true;
			break;
		}
	}
	if(!userSelectedACheckbox){
		alert ("You've got to select at least 1 neighborhood.");
		event.preventDefault();	
		return;
	}


	userSelectedACheckbox = false;
	for(i = 0; i < 10; i++){
		fieldName = 'input[name="interests['+i+']"]';
		value = $('#target').find(fieldName).attr("checked");
		if(value){
			userSelectedACheckbox = true;
			break;
		}
	}
	if(!userSelectedACheckbox){
		alert ("You've got to select at least 1 interest.");
		event.preventDefault();	
	}


}); 