$(document).ready(function() {
	
	var idQuery = window.location.search.substring(1);
	
	// regex matches the id integer in the url, like ?id=2, to question_id
	var question_id = /[?&]id=(\d+)/.exec(idQuery)[1];
	
	$.getJSON('/api/index.php?resource=questions&id='+question_id, function(question) {
	 	$("#question_title").html(question.title);
		$("#question_image").attr("src", question.photo.medium);
		$("#question_description").html(question.description);
	});
	
});