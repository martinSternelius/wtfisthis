<?php
	$question = new Question($id = $_GET['id']);
	$question = $question->toArray();
   Json::emit_as_jsonp($question);
