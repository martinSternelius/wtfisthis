/*
 * WTF lib
 *
 *
 */

(function(window) {

 /**
  * Ensure WTF module is available in the global scope without
  * clobbering it if it already exists
  */
var WTF = (function(){
	var WTF = window.WTF || {};
	return (window.WTF = WTF);
}());


var questionList = [];

WTF.setquestionlist = function (list) {
   if(typeof(list.shift) != 'undefined' && typeof(list.length) != 'undefined'){ 
      questionList = list;   
   }
}

WTF.getnextquestion = function () {
   if(questionList.length < 1){ return false; }
   return questionList.shift();
}

WTF.getmorequestions = function (nums){
   var question;
   while(nums > 0){
      nums -= 1;
      question = WTF.getnextquestion();
      if(!question){ return false;}
      WTF.makeQuestion(question).hide().fadeIn(500).appendTo('ol#questions');
   }
   return true;
}



/**
 * Takes a json representation of an answer and returns a clone of the
 * answer template with the answers values inserted
 */
WTF.makeanswer = function(answer){
	var template = $('.templates li.answer:first').clone();
	template.find('.answer_text').text(answer.answer_text);
	template.find('.answer_name').text("Skriven av "+ 
		(answer.name || "Anonym") +" den " + answer.published_time);
	
	return template;
};

/**
 * Take a JSON object and its corresponding template html
 * and make an actual list item off it.
 */
WTF.makeQuestion = function(question){
   var thumb = ( question.photo && question.photo.urls && question.photo.urls.thumbnail) || "";
	var template = $('.templates li.question:first').clone();
	template.find('.question_thumbnail').attr('src',thumb);
	template.find('.question_title').text(question.title);
	template.find('.question_date').text(question.post_date);
	template.find('.question_link').attr('href',"view_question.php?id=" + question.id);
	
   return template;
};

/**
 * Take a JSON object and insert its data in the corresponding template html
 * and returns the result. 
 * Quick and dirty fix with ugly return!
 */
WTF.makeQuestionFull = function(question){
	$("#question_title").text(question.title);
	$("#question_image").attr("src", question.photo.urls.medium);
	$("#question_description").text(question.description);
	if(question.post_date){
		$('#question_author_and_date').text('Skriven av '+(question.author||"Anonym")+' den '+ question.post_date);
	}
	return $("div#question");
};

}(window));
