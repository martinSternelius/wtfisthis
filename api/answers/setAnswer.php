<?php

$result = array();

// checks to see that all the POSTs
if(strlen($_POST['reply_text'])!= 0) {

	$question_id = $_GET['question_id'];	
	$reply_text = $_POST['reply_text'];
	
	if($_POST['reply_author'] == "") {
		$reply_author = "Anonym";
	} else {
		$reply_author = $_POST['reply_author'];
	}
	
	$answer = new Answer(null, $question_id, $reply_author, $reply_text, null);
	
	if($answer->save()) {
		$result = $answer->toArray();
   } else {
		$result['error'] = "Det gick inte att spara svaret i databasen";
	}
	
}
else {
	$result['error'] = "Fyll i alla fält!";
}

Json::emit_as_jsonp($result);
