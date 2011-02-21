<?php 
	$answer = new Answer($id = $_GET['id']);
	$answer = $answer->toArray();
    Json::emit_as_jsonp($answer);