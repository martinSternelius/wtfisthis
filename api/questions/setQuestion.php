<?php

// checks to see that all the POSTs
// file is not checked ATM
if((strlen($_POST['headerInput'])!= 0 )
	&& (strlen($_POST['textInput'])!= 0 )) {
		
	$title = $_POST['headerInput'];
	$description = $_POST['textInput'];
	$name = $_POST['nameInput'];
	$photo = $_FILES["imageUpload"]["tmp_name"];
	
	// save photo to flickr
	require_once '../lib/phpFlickr-3.1/phpFlickr.php';
	
	// authenticate to Flickr
	$phpFlickr = new phpFlickr(FLICKR_API_KEY, FLICKR_SECRET);
	$phpFlickr->setToken(CFG_FLICKR_TOKEN);
	
	// upload the file, return the id for the flickr-hosted photo
	$flickr_photo_id = $phpFlickr->sync_upload($photo, $title, $description);
	
	$question = new Question($id = null, $title, $description, $flickr_photo_id);
	
	if($question->save()) {
		echo '{"id":"' . $question->getId() . '"}';
	} else {
		echo '{"error":"Det gick inte att spara frågan i databasen"}';
	}
	
	
}
else {
	echo '{"error":"Fyll i alla fält!"}';
}