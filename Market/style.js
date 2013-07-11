$(document).ready(function(){
	var i=0;
	$('form a').last().click(function(){
		i=i+1;
		event.preventDefault();
		var uploadButton=$('<input type="file" name="file' + i +'" id="file"> <br/><br/>');
		uploadButton.insertBefore($('form a').last());
	})
})