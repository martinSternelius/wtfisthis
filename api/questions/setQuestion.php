<?php

// checks to see that all the POSTs are sent
if(isset($_POST['headerInput']) && isset($_POST['imageUpload']) && isset($_POST['nameInput'])) && isset($_POST['textInput']) {
	$title = $_POST['headerInput'];
	$description = $_POST['textInput'];
	$photo = $_POST['imageUpload'];
	$name = $_POST['nameInput'];
	
	// save photo to flickr
	/*
	$phpFlickr = new phpFlickr(FLICKR_API_KEY);
	$phpFlickr->setToken(CFG_FLICKR_TOKEN);
	$photo_id = $phpFlickr->sync_upload($photo, $title, $description);
	*/
	
	$question = new Question($id = null, $title, $description, $photo_id = null);
	
	if($question->save()) {
		echo '{"id":"' . $question->id . '"}';
	} else {
		echo "{}";
	}
}