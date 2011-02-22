<?php 

class Answer extends WTF {
	
	protected $answer_id;
	protected $question_id;
	protected $name;
	protected $answer_text;
	protected $published_time;
	
	function __construct($answer_id = null, $question_id = null, $name = null, $answer_text = null, $published_time = null){
		if (!is_numeric($answer_id)){
			$this->answer_id = null;
			$this->question_id = $question_id;
			$this->name = $name;
			$this->answer_text = $answer_text;
			$this->published_time = $published_time;
		}else {
			$this->loadAnswer($answer_id);
		}
	}
	
	public function getId(){
		return $this->answer_id;
	}
	
	public function getQuestionId(){
		return $this->question_id;
	}
	
	public function setQuestionId($id) {
		$this->question_id = $id;
	}
	
	public function save() {
		$result = false;
		$sql = "INSERT INTO `answers` ". 
			"(`question_id`, `name`, `answer_text`) ". 
			"VALUES (?, ?, ?)";
		
		if ($statement = Db::prepare($sql)) { 
			$statement->bind_param("iss", $this->question_id, $this->name, $this->answer_text);
			$result = $statement->execute();
			$statement->close();
		}
		$this->answer_id = DB::insert_id();
		return $result;
	}
	
	private function loadAnswer($answer_id) {
      $answer_id = Db::escape($answer_id); //sanitize input
      $answer = Db::get_assoc(
         "SELECT answer_id, question_id, name, answer_text, published_time ".
         "FROM `answers` ".
         "WHERE `answers`.`answer_id` = '$answer_id';");
      if(empty($answer)) return;

      //the keys coming back from db have a 1:1 relationship
      //to properties of this object
      foreach($answer[0] as $prop => $value){
         $this->$prop = $value;
      } 
	}

   /**
    * Returns all answers associated with a question as an array of
    * associative arrays. There's really no need to make objects of
    * the results when all that's done with the objects is to serialize
    * them to arrays again. This is shorter and less errorprone
    */   
	public static function getAllAnswersOfQuestion($question_id){
      $question_id = Db::escape($question_id);
      return Db::get_assoc(
         "SELECT answer_id, question_id, name, answer_text, published_time ".
         "FROM `answers` ".
			"WHERE `answers`.`question_id` = $question_id ".
			"ORDER BY `published_time` DESC;");
	}
	
}

