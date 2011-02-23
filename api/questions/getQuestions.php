<?php

if (isset($_GET['count']) && is_numeric($_GET['count'])){
	if (isset($_GET['offset']) && is_numeric($_GET['offset'])){
		$resultSet = Question::getQuestionsByCount($_GET['count'], $_GET['offset'] +1);
	}else{
		$resultSet = Question::getQuestionsByCount($_GET['count'], 0);
	}
} else {
	$resultSet = Db::get_assoc('SELECT * FROM questions ORDER BY `post_date` DESC');
}
$questions = array(); 

// Create a Question object for every row in the database
foreach ($resultSet as $row) {
	$q = new Question($row['id'], $row['title'], $row['description'], new Photo($row['photo_id']));
	$questions[] = $q->toArray();
}

Json::emit_as_jsonp($questions);
