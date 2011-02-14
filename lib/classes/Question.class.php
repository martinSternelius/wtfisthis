<?php
class Question extends WTF {
	
	protected $id;
	protected $title;
	protected $description;
	protected $photo;

	function __construct($id, $title, $description = "", $photoId = "") {
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		$this->photo = new Photo($photoId);
	}
	
}