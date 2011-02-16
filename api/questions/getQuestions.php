<?php

$resultSet = Db::query('SELECT * FROM questions');

// The JSON object is built as a string with the starting bracket before the loop
// because of difficulties with encoding to json object
$questions = "[";

// Create a Question object for every row in the database
while ($row = $resultSet->fetch_assoc()){
	$q = new Question($row['id'], $row['title'], $row['description'], $row['photo_id']);
	$questions .= $q->toJson();
	$questions .= ",";
}

// remove the last character "," from the json object
// because the last json object should be comma free
$questions = rtrim($questions, ",");

// ends the json object
$questions .= "]";

echo $questions;
