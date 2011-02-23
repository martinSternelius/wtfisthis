$(document).ready(function() {
	
	var idQuery = window.location.search.substring(1);
	
	// regex matches the id integer in the url, like ?id=2, to question_id
	var question_id = /id=(\d+)/.exec(idQuery);
	var question_id = question_id[1];
	
	// set the correct action attribute on the reply form
	var replyFormAction = $("#reply_to_question form").attr("action");
	$("#reply_to_question form").attr("action", replyFormAction + "&question_id=" + question_id);
	
	$.getJSON('../api/index.php?callback=?',{"resource":"questions","id":question_id}, function(question) {
		
		// displays the answer and pushes it to the html
		WTF.makeQuestionFull(question);

		// gets the answers and foreach displays them below the question
		// If there is no answers, keep the default paragraph.
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
		clearForm: 'true',
		success: function (response){
			$("#throbber").remove();
		   
			// Replace default paragraph if present.
			if ($("#answers > p").length > 0) {
				$("#answers > p").replaceWith("<ol></ol>");
			}
			var answer = WTF.makeanswer(response);
			answer.prependTo("#answers ol").hide().fadeIn(500);
		}
	};
		
	$("#reply_to_question form").ajaxForm(options);
	
	// if you click on the "would you like to reply"-link, the reply form should be focused
	$("#highlight_reply_form").click(function() {
		$("#reply_text").focus();
	});
	
});
