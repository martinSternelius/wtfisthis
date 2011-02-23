/*
 * WTF lib
 *
 *
 */

(function(window) {

var WTF = (function(){
	var WTF = window.WTF || {};
	return (window.WTF = WTF);
}());

WTF.makeanswer = function(answer){
	var template = $('.templates li.answer:first').clone();
	template.find('.answer_text').text(answer.answer_text);
	template.find('.answer_name').text("Skriven av "+ 
		(answer.name || "Anonym") +" den " + answer.published_time);
	
	return template;
};

// Take a JSON object and its corresponding template html and make an actual list item off it?
WTF.makeQuestion = function(question){
	var template = $('.templates li.question:first').clone();
	template.find('.question_thumbnail').attr('src',question.photo.urls.thumbnail);
	template.find('.question_title').text(question.title);
	template.find('.question_date').text(question.post_date);
	template.find('.question_link').attr('href',"view_question.html?id=" + question.id);
	
   return template;
};


}(window));
