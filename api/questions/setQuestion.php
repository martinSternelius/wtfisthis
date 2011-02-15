<?php

// checks to see that all the POSTs are sent
if((strlen($_POST['headerInput'])!= 0 )
	/*&& isset($_POST['imageUpload'])*/ &&  
	(strlen($_POST['textInput'])!= 0 )) {
		
	$title = $_POST['headerInput'];
	$description = $_POST['textInput'];
	//$photo = $_POST['imageUpload'];
	$name = $_POST['nameInput'];

	
	// save photo to flickr
	/*
	$phpFlickr = new phpFlickr(FLICKR_API_KEY);
	$phpFlickr->setToken(CFG_FLICKR_TOKEN);
	$photo_id = $phpFlickr->sync_upload($photo, $title, $description);
	*/
	
	$question = new Question($id = null, $title, $description, $photo_id = 1);
	
	if($question->save()) {
		echo '{"id":"' . $question->getId() . '"}';
	} else {
		echo '{"error":"Det gick inte att spara frågan i databasen"}';
	}
	
	
}
else {
	echo '{"error":"Fyll i alla fält!"}';
}