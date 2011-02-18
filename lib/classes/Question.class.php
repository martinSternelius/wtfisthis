<?php
class Question extends WTF {
	
	private $id;
	protected $title;
	protected $description;
	protected $photo;
	protected $answers;
	/**
	 * 
	 * Enter description here ...
	 * @param int $id -> Set this to get question from DB. Null by default.
	 * @param string $title -> Null by default.
	 * @param string $description -> Null by default.
	 * @param Photo $photo -> Null by default.
	 */
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
	 * 
	 * Get the question's photo
	 */
	public function getPhoto() {
		return $this->photo;
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
		$question = Db::get_assoc("SELECT * FROM `questions`" .
								" WHERE `questions`.`id` = '$id';");

      if(!$question) return; // just do nothing if we don't actually
                             // get anything from db
      $question = $question[0];
      $this->id = $question['id'];
      $this->title = $question['title'];
      $this->description = $question['description'];
      $this->photo = new Photo($question['photo_id']);
      if(!$question['thumbnail'] || !$question['medium']){
         $urls = $this->photo->getUrls();
         $this->storePhotoUrls($urls);
      } else {
         $this->photo->setUrls($question['thumbnail'], $question['medium'], $question['original']);
      }

      $this->answers = Answer::getAllAnswersOfQuestion($this->id);
   }

   private function storePhotoUrls($urls){
      $statement = Db::prepare("UPDATE `wtfisthis`.`questions`".
         " SET `thumbnail` = ?, `medium` = ?, `original` = ? WHERE `id` = ?");
      if(!$statement) die('No statement');
      $statement->bind_param("ssss", $urls['thumbnail'],$urls['medium'],$urls['original'],$this->id);
      $statement->execute();
      $statement->close();
   }

}
