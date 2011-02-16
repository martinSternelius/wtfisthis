<?php
class Question extends WTF {
	
	private $id;
	protected $title;
	protected $description;
	protected $photo;
	protected $answers;

	function __construct($id = null, $title = null, $description = null, $photo = null) {
		if (!is_numeric($id)){
			$this->title = $title;
			$this->description = $description;
			$this->photo = $photo;
		}else {
			$this->loadQuestion($id);
		}

	}
	/** 
	 * Get the question's id
	 */
	public function getId() {
		return $this->id;
	}
	
	public function getAnswers() {
		return $this->answers;
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
	
	private function loadQuestion($id) {
		$question = Db::query("	SELECT * FROM `questions`
								WHERE `questions`.`id` = '$id';
							");
		while ($row = $question->fetch_assoc()){
			$this->id = $row['id'];
			$this->title = $row['title'];
			$this->description = $row['description'];
			$this->photo = new Photo($row['photo_id']);
		}
		$this->answers = Answer::getAllAnswersOfQuestion($this->id);
	}

}
