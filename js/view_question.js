$(document).ready(function() {
	
	var idQuery = window.location.search.substring(1);
	
	// regex chooses the id integer in the url, like ?id=2, to question_id
	var question_id = /[?&]id=(\d+)/.exec(idQuery)[1];
	
	
	
});