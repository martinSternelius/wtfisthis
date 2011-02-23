$(document).ready(function() {
	
	$.getJSON('../api/index.php?callback=?',{"resource":"questions"}, function(questions) {
		
		var popular_list = $("<ol />");
		
		// builds the popular questions list in the temporary ol.
		$.each(questions, function(index,question) {
			popular_list.append(WTF.makeQuestion(question));
			// $("ol#questions").append(WTF.makeQuestion(question));
		});
		
		console.log(popular_list.html());
		$("ol#questions").html(popular_list.html());
	});
	
});