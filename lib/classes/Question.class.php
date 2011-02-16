<?php
class Question extends WTF {
	
	protected $id;
	protected $title;
	protected $description;
	protected $photo;
	private $answers = Array();

	function __construct($id, $title, $description = "", $photoId = "") {
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		if (is_numeric($photoId)){			
			$this->photo = new Photo($photoId);
		}
	}
	/** 
	 * Get the question's id
	 */
	public function getId() {
		return $this->id;
	}
	
	
	/**
	* Save The newly created Question to the DB. Needs to use the DB class in a more consistent way.
	*/
	public function save() {
		$result = false;
		$sql = "INSERT INTO `wtfisthis`.`questions` 
			(`id`, `title`, `description`, `photo_id`) 
			VALUES (NULL, ?, ?, ?)";
		
		if ($statement = Db::prepare($sql)) { 
			$statement->bind_param("sss", $this->title, $this->description, $this->photo->getId());
			$result = $statement->execute();
			$statement->close();
		}
		$this->id = DB::insert_id();
		return $result;
	}
}
