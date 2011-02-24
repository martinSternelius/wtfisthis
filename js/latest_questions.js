$(document).ready(function() {
	
	$.getJSON('../api/index.php?callback=?',{"resource":"questions"}, function(questions) {
		
		// Remove unneeded li tag. It is there for validation...
		$("#questions li").remove();
		
		WTF.setquestionlist(questions);	
		WTF.getmorequestions(5);
      
		$('#more_link').click(function(event){
			event.preventDefault(); 
			var top = $('ol#questions li:last');
			var hasMore= WTF.getmorequestions(5);
			top.scrollTop(0);
			if(!hasMore) $('#more_link').hide();
			return false;
		});
	});
	
});
