<?php

/**
 * Define validator for post data
 */
$val = new Validator($_POST);
$val->add_field('headerInput',array('required'=>true,'maxlength'=>20));
$val->add_field('textInput', array('required'=>true));
$val->add_field('nameInput',array('default'=>'Anonym'));
$val->require_file('imageUpload');

/*
 * If form isn't valid just emit the errors and stop processing
 */
if(!$val->is_valid()) {
   Json::emit_as_jsonp($val->errors(), true);
   die();
}

/*
 * If we've come this far the indata is valid, let's just process it
 */
$indata = $val->get_data();

$title = $indata['headerInput'];
$description = $indata['textInput'];
$author = $indata['nameInput'];

/*
 * if we add the debug parameter we can test without uploading to flickr
 */
if(isset($_GET['debug'])){
   $photo = new Photo('5431368117');
}else{
   $photo = Photo::from_file($indata['_file'], $title, $description);
}

$question = new Question($id = null, $title, $author, $description, $photo);

if($question->save()) {
   $result['id'] = $question->getId();
} else {
   $result['error'] = "Could not save question in db";
}
Json::emit_as_jsonp($result, true);
