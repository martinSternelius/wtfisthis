<?php
class Question {
	
	private $title;
	private $description;
	private $photo;

	function __construct($title, $description = "", $photoId = "") {
		$this->title = $title;
		$this->description = $description;
		$this->photo = new Photo($photoId);
	}
	
}