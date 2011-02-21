<?php
/*
 * This file is the parent to all the api calls and should be mod rewrited to allow pretty urls
 * It should answer to different GET parameters and include other files that carries out the workload
 * No functional code should be in here, in other words
 *
 *
 * Flickr user url:
 * http://www.flickr.com/photos/59481302@N07/
 *
 * Login to Flickr: 
 * username: wtfisthiscontact@yahoo.com
 * password: ASDFqwerty123
 */
require_once '../lib/base.php';


// First check if the call is for a resource (in the database)
if (isset($_GET['resource'])) {
	
	# GET /api/index.php?resource=questions
	if ($_GET['resource'] == "questions"){
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			include 'questions/setQuestion.php';
		}else if ($_SERVER['REQUEST_METHOD'] == "GET"){
			
			//If we request a single question by id, we don't want to get all of them
			if (isset($_GET['id'])&&is_numeric($_GET['id'])) {
				include 'questions/getQuestionById.php';
			} else {
				include 'questions/getQuestions.php';
			}
		}
	}
	
	# GET /api/index.php?resource=answers // &question_id={id}
	if ($_GET['resource'] == "questions" && is_numeric($_GET['question_id'])){
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			include 'questions/setAnswer.php';
		}
		/*
		else if ($_SERVER['REQUEST_METHOD'] == "GET"){
			//If we request a single answer by id, we don't want to get all of them
			if (isset($_GET['id'])&&is_numeric($_GET['id'])) {
				include 'answers/getAnswerById.php';
			} else {
				include 'answers/getAnswers.php';
			}
		}
		*/
	}
}
