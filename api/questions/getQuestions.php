<?php

$resultSet = Db::query('SELECT * FROM questions');

$questions = array(); 

// Create a Question object for every row in the database
while ($row = $resultSet->fetch_assoc()){
	$q = new Question($row['id'], $row['title'], $row['description'], $row['photo_id']);
	$questions[] = $q->toArray();
}

echo json_encode($questions);
