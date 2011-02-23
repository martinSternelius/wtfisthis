$(document).ready(function() {
	
	$.getJSON('../api/index.php?callback=?',{"resource":"questions"}, function(questions) {
		
		var popular_list = $("<ol />");
	   WTF.setquestionlist(questions);	
		// builds the popular questions list in the temporary ol.
		
      WTF.getmorequestions(5);
      
      $('#more_link').click(function(event){
        event.preventDefault(); 
         var top = $('ol#questions li:last');
         WTF.getmorequestions(5);
         top.scrollTop(0);
         return false;
         });

	});
	
});
