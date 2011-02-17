<?php
	$question = new Question($id = $_GET['id']);
	$question = $question->toArray();
	echo str_replace('\\/', '/', json_encode($question));
?>