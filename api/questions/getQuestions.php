<?php

$resultSet = Db::query('SELECT * FROM questions');
$questions = Array();

while ($row = $resultSet->fetch_assoc()){
	$questions[] = new Question($row['title'], $row['description'], $row['photo_id']);
}

print_r($questions);