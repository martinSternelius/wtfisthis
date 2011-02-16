<?php

// if id is set, then we want to reply a single question
if(isset($_GET['id'])) {
	$resultSet = Db::query("SELECT * FROM questions WHERE id = {$_GET['id']}");

// else return all the answers in the database
} else {
	$resultSet = Db::query('SELECT * FROM questions');
}


$questions = array(); 

// Create a Question object for every row in the database
while ($row = $resultSet->fetch_assoc()){
	$q = new Question($row['id'], $row['title'], $row['description'], new Photo($row['photo_id']));
	$questions[] = $q->toArray();
}

// a bug in PHP prior to September 2010 auto escapes "/", this is a fix for urls to be properly formatted
// read more on http://se.php.net/manual/en/function.json-encode.php#100679
echo str_replace('\\/', '/', json_encode($questions));
