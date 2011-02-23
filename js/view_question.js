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
			$('#question_author_and_date').text('Skriven av '+(question.author||"Anonym")+' den '+ question.post_date);
		}   
		// gets the answers and foreach displays them below the question
		if ($(question.answers).length > 0) {
			$("#answers > p").replaceWith("<ol></ol>");
			
			$(question.answers).each(function() {
				$("#answers ol").append(WTF.makeanswer(this));
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
				$("<div />").attr("id", "throbber").html('<img src="images/ajax-loader.gif" />').appendTo($("#reply_to_question"));
			},
			dataType: 'json',
			type: 'post',
			success: function (response){
				$("#throbber").remove();
			   
            var answer = WTF.makeanswer(response);
				answer.prependTo("#answers ol").hide().fadeIn(500);
			}
		};
	$("#reply_to_question form").ajaxForm(options);
		
	// set the correct action attribute on the reply form
	var replyFormAction = $("#reply_to_question form").attr("action");
	$("#reply_to_question form").attr("action", replyFormAction + "&question_id=" + question_id);
	
});
