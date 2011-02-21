<?php

   /**
    * jQuery form file upload needs the return value of a file submit to be wrapped in <textarea> tags
    */
   function handle_output($json){
      $xhr = isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
      if (!$xhr) echo '<textarea>';
      echo json_encode($json);
      if (!$xhr) echo '</textarea>';
   }   


// checks to see that all the POSTs
// file is not checked ATM
if((strlen($_POST['headerInput'])!= 0 )
	&& (strlen($_POST['textInput'])!= 0 )) {
	
	$title = $_POST['headerInput'];
	$description = $_POST['textInput'];
	
	// if the author is not set, then the empty "" must be overriden 
	// to null to allow default values in the classes to be honoured
	if($_POST['reply_author'] == "") {
		$author = null;
	} else {
		$author = $_POST['nameInput'];
	}
	
   	$photo = Photo::from_file($_FILES["imageUpload"]["tmp_name"], $title, $description);
	
	$question = new Question($id = null, $title, $author, $description, $photo);
	
	if($question->save()) {
		handle_output(array('id' => $question->getId()));
	} else {
		handle_output(array('error' => "Det gick inte att spara frågan i databasen"));
	}
	
	
}
else {
	handle_output(array('error' => "Fyll i alla fält!"));
}
