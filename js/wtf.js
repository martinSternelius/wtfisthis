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


}(window));
