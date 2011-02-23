<?php
class Question extends WTF {
	
	protected $id;
	protected $title;
	protected $author;
	protected $post_date;
	protected $description;
	protected $photo;
	protected $answers;
	/**
	 * 
	 * Enter description here ...
	 * @param int $id -> Set this to get question from DB. Null by default.
	 * @param string $title -> Null by default.
	 * @param string $author -> Null by default.
	 * @param string $description -> Null by default.
	 * @param Photo $photo -> Null by default.
	 */
	function __construct($id = null, $title = null, $author = null, $description = null, $photo = null) {
		if (!is_numeric($id)){
			$this->title = $title;
			$this->description = $description;
			$this->photo = $photo;
			$this->author = $author;
			$this->answers = Array();
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
	
	/** 
	 * Get the question's title
	 */
	public function getTitle() {
		return $this->title;
	}
	
	public function getAnswers() {
		return $this->answers;
	}
	
	//TODO Only for a test a the moment, refactor if you actually use it.
	public function getAnswer($id) {
		foreach($this->answer as $answer) {
			if ($answer->getId() == $id) {
				return $answer;
			}
		}
		return false;
	}
	
	/**
	 * 
	 * Get the question's photo
	 */
	public function getPhoto() {
		return $this->photo;
	}
	
	/** 
	 * Get the question's author
	 */
	public function getAuthor() {
		return $this->author;
	}
	
	/** 
	 * Get the question's description
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	* Add an answer to the answer list.
	*/
	public function addAnswer($answer) {
		$answer->setQuestionId($this->id);
		$this->answer[] = $answer;
	}
	
	/**
	* Save The newly created Question to the DB. Needs to use the DB class in a more consistent way.
	*/
	public function save() {
		$result = false;
		$sql = "INSERT INTO `questions` 
			(`id`, `title`, `description`, `photo_id`, `author`, `post_date`) 
			VALUES (NULL, ?, ?, ?, ?, NOW())";
		
		if ($statement = Db::prepare($sql)) {
			$statement->bind_param("ssss", $this->title, $this->description, $this->photo->getId(),$this->author);
			$result = $statement->execute();
			if (!$result) {
				echo $statement->error;
			}
			$statement->close();
		}
		$this->loadQuestion(DB::insert_id());
		return $result;
	}
	
	public function delete() {
		$result = false;
		$sql = "DELETE FROM `questions` 
			WHERE id = ?";
		
		if ($statement = Db::prepare($sql)) {
			$statement->bind_param("i", $this->id);
			$result = $statement->execute();
			if (!$result) {
				echo $statement->error;
			}
			$statement->close();
		}
		$this->id = null;
		return $result;
	}
	
	private function loadQuestion($id) {
		$result = Db::get_assoc("SELECT * FROM `questions`" .
								" WHERE `questions`.`id` = '$id';");

      if(!$result) return; // just do nothing if we don't actually
                           // get anything from db
      $question = $result[0];
      $this->id = $question['id'];
      $this->author = $question['author'];
      $this->post_date = $question['post_date'];
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
      $statement = Db::prepare("UPDATE `questions`".
         " SET `thumbnail` = ?, `medium` = ?, `original` = ? WHERE `id` = ?");
      if(!$statement) die('No statement');
      $statement->bind_param("ssss", $urls['thumbnail'],$urls['medium'],$urls['original'],$this->id);
      $statement->execute();
      $statement->close();
   }
   
	public static function getQuestionsByCount($count, $offset){
      $c = Db::escape($count);
      $o = Db::escape($offset);
		$questions = Db::get_assoc(
		"SELECT * FROM `questions` ".
		"ORDER BY `post_date` DESC ".
		"LIMIT {$c} OFFSET {$o};"
	);
      
		return $questions;
	}

}
