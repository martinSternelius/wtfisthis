<?php
	# GET /api/index.php?resource=answers // &question_id={id}
	if(isset($_GET['question_id']) 
		&& is_numeric($_GET['question_id'])){
   
         if ($method == "POST"){
            include 'answers/setAnswer.php';
         } else if ($method == "GET"){
			//If we request a single answer by id, we don't want to get all of them
            if (isset($_GET['id'])&&is_numeric($_GET['id'])) {
               include 'answers/getAnswerById.php';
            } else {
               include 'answers/getAnswers.php';
            }
         }
      } else {
         die('unimplemented method');
      }

