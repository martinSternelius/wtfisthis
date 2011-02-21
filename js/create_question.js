$(document).ready(function() {
	var header_max = 50;
	var name_max = 50;
	var text_max = 340;
	$("#createQuestion").validate({
		rules: {
			headerInput: {
			required: true,
			minlength: 2,
			maxlength: header_max
			},
			nameInput: {
				required: false,
				minlength: 2,
				maxlength: name_max
			},
			textInput: {
				required: true,
				minlength: 2,
				maxlength: text_max
			},
			imageUpload: {
				required: true,
				accept: "png|jpe?g|gif"
			}
		},
		messages: {
			headerInput: {
				required: "Du har glömt att fylla i rubrik",
				minlength: jQuery.format("Minst {0} tecken!"),
				maxlength: jQuery.format("Högst {0} tecken!")
			},
			nameInput: {
				minlength: jQuery.format("Minst {0} tecken!"),
				maxlength: jQuery.format("Högst {0} tecken!")
			},
			textInput: {
				required: "Du har glömt att fylla i",
				minlength: jQuery.format("Minst {0} tecken!"),
				maxlength: jQuery.format("Högst {0} tecken!")
			}
		}
	});

	$("#headerInput").NobleCount("#headerInputCount", {max_chars:header_max});
	$("#textInput").NobleCount("#textInputCount", {max_chars:text_max});
		
	$("#upload_button").throbber({
			image: "images/ajax-loader.gif"
	});
	
	
	var options = {
		dataType: 'json',
		success: function (responseText){
		window.location = '/mobile/view_question.html?id=' + responseText.id;
		}
	};
	$("#createQuestion").ajaxForm(options);
	
});
