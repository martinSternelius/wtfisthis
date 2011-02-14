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
	
	# GET /api/questions/
	if ($_GET['resource'] == "questions") {
		include 'questions/getQuestions.php';
	}
}