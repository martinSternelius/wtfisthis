$(document).ready(function() {
	
	var idQuery = window.location.search.substring(1);
	
	// regex matches the id integer in the url, like ?id=2, to question_id
	var question_id = /id=(\d+)/.exec(idQuery);
	var question_id = question_id[1];
	
	// add a missing id to the form action attribute
	var form_action = $("form:first").attr("action");
	$("form:first").attr("action",form_action + "&question_id=" + question_id);
	
	$.getJSON('../api/index.php?callback=?',{"resource":"questions","id":question_id}, function(question) {
		
		// displays the answer and pushes it to the html
	 	$("#question_title").html(question.title);
		$("#question_image").attr("src", question.photo.urls.medium);
		$("#question_description").html(question.description);
		if(question.post_date){
			if(question.author == null) {
				question.author = "Anonym";
			}
			$('#question_author_and_date').text('Skriven av '+question.author+' den '+ question.post_date);
		}   
		// gets the answers and foreach displays them below the question
		if ($(question.answers).length > 0) {
			$("#answers > p").replaceWith("<ol></ol>");
			
			$(question.answers).each(function() {
				
				// builds up the html for every answer
				var answer ="<li class='answer'>";
				answer += 		"<p class='answer_text'>" + this.answer_text + "</p>";
				answer +=			"<div class='voting'>";
				answer +=				"<p class='upvote'>+</p>";
				answer +=				"<p class='rating'>0</p>";
				answer +=				"<p class='downvote'>-</p>";
				answer +=			"</div>";
				answer +=			"<p class='answer_name'>Skriven av ";
				
					if(this.author) {
						answer += this.author;
					} else {
						answer += "Anonym";
					}
				
				answer += 		" den " + this.published_time + ".</p>";
				answer +=		"</li>";
				$("#answers ol").append(answer);
				
			});
		}
	});
	
	
	/* Validator for the reply form */
	var text_max = 340;
	var name_max = 50;
	
	$("#reply_to_question form").validate({
		rules: {
			reply_author: {
				required: false,
				minlength: 2,
				maxlength: name_max
			},
			reply_text: {
				required: true,
				minlength: 2,
				maxlength: text_max
			}
		},
		messages: {
			reply_author: {
				minlength: jQuery.format("Minst {0} tecken!"),
				maxlength: jQuery.format("Högst {0} tecken!")
			},
			reply_text: {
				required: "Du har glömt att fylla i svaret!",
				minlength: jQuery.format("Minst {0} tecken!"),
				maxlength: jQuery.format("Högst {0} tecken!")
			}
	   }
	});
	
	$("#reply_text").NobleCount("#reply_text_count", {max_chars:text_max});

	var options = {
			beforeSubmit: function(arr) { 
				// adds the throbber loading gif
				$("<p>").text("Laddar...").appendTo("#reply_to_question");
			},
			dataType: 'json',
			type: 'post',
			success: function (responseText){
				console.log(responseText);
				var answer ="<li class='answer'>";
				answer += 		"<p class='answer_text'>" + responseText.answer_text + "</p>";
				answer +=			"<div class='voting'>";
				answer +=				"<p class='upvote'>+</p>";
				answer +=				"<p class='rating'>0</p>";
				answer +=				"<p class='downvote'>-</p>";
				answer +=			"</div>";
				answer +=			"<p class='answer_name'>Skriven av ";
				
					if(responseText.name) {
						answer += responseText.name;
					} else {
						answer += "Anonym";
					}
				
				answer += 		" den " + responseText.published_time + ".</p>";
				answer +=		"</li>";
				$(answer).prependTo("#answers ol").hide().fadeIn(500);

			}
		};
		$("#reply_to_question form").ajaxForm(options);
		
	// set the correct action attribute on the reply form
	$("#reply_to_question form").attr("action", "../api/?resource=answers&question_id="+question_id);
	
	
});
