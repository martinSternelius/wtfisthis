<?php

// checks to see that all the POSTs
// file is not checked ATM
if((strlen($_POST['headerInput'])!= 0 )
	&& (strlen($_POST['textInput'])!= 0 )) {
	
	$title = $_POST['headerInput'];
	$description = $_POST['textInput'];
	$author = $_POST['nameInput'];
	$photo = Photo::from_file($_FILES["imageUpload"]["tmp_name"], $title, $description);
	
	$question = new Question($id = null, $title, $author, $description, $photo);
	
	if($question->save()) {
		echo '{"id":"' . $question->getId() . '"}';
	} else {
		echo '{"error":"Det gick inte att spara frågan i databasen"}';
	}
	
	
}
else {
	echo '{"error":"Fyll i alla fält!"}';
}
