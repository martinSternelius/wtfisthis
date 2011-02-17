<?php
/*
 * This file is the parent to all the api calls and should be mod rewrited to allow pretty urls
 * It should answer to different GET parameters and include other files that carries out the workload
 * No functional code should be in here, in other words
 *
 */
require_once '../lib/base.php';


// First check if the call is for a resource (in the database)
if (isset($_GET['resource'])) {
	
	# GET /api/index.php?resource=questions
	if ($_GET['resource'] == "questions"){
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			include 'questions/setQuestion.php';
<<<<<<< HEAD
		} else if ($_SERVER['REQUEST_METHOD'] == "GET"){ 
			include __DIR__.'/questions/getQuestions.php';
			
=======
		}else if ($_SERVER['REQUEST_METHOD'] == "GET"){
			
			//If we request a single question by id, we don't want to get all of them
			if (is_numeric($_GET['id'])) {
				include 'questions/getQuestionById.php';
			} else {
				include 'questions/getQuestions.php';
			}
>>>>>>> 8b28d79b08488cc4052f934ec2036096974678d2
		}
	}
}