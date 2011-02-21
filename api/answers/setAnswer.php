<?php

// checks to see that all the POSTs
if(strlen($_POST['reply_text'])!= 0) {
	
	$question_id = $_GET['question_id'];
	
	$reply_text = $_POST['reply_text'];
	$reply_author = $_POST['reply_author'];
	
	$answer = new Answer(null, $question_id, $reply_author, $reply_text, null);
	
	if($answer->save()) {
		echo '{"id":"' . $answer->getId() . '"}';;
	} else {
		echo '{"error":"Det gick inte att spara " . "svaret" . " i databasen"}';
	}
	
}
else {
	echo '{"error":"Fyll i alla fält!"}';
}
