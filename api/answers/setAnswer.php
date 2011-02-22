<?php
$result = array();

/**
 * Define validator for post data
 */
$val = new Validator($_POST);
$val->add_field('reply_text',array('required'=>true));
$val->add_field('reply_author',array('default'=>'Anonym'));

/**
 * If form isn't valid just emit the errors and stop processing
 */
if(!$val->is_valid()){
   Json::emit_as_jsonp($val->errors());
   die();
}

/* 
 * If we've come this far the indata is valid, let's just process it
 */
$indata = $val->get_data();
$question_id = $_GET['question_id'];	

$answer = new Answer(null, $question_id, $indata['reply_author'], $indata['reply_text'], null);

if($answer->save()) {
   $result = $answer->toArray();
} else {
   $result['error'] = "Det gick inte att spara svaret i databasen";
}
	
Json::emit_as_jsonp($result);
