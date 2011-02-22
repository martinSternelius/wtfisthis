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
		$sql = "
			INSERT INTO `answers` 
			(`answer_id`, `question_id`, `name`, `answer_text`, `published_time`) 
			VALUES (NULL, ?, ?, ?, NULL)
			";
		
		if ($statement = Db::prepare($sql)) { 
			$statement->bind_param("iss", $this->question_id, $this->name, $this->answer_text);
			$result = $statement->execute();
			$statement->close();
		}
		$this->answer_id = DB::insert_id();
		return $result;
	}
	
	private function loadAnswer($answer_id) {
		$answer = Db::query("	
								SELECT * FROM `answers`
								WHERE `answers`.`answer_id` = '$answer_id';
							");
		while ($row = $answer->fetch_assoc()){
			$this->answer_id = $row['answer_id'];
			$this->question_id = $row['question_id'];
			$this->name = $row['name'];
			$this->answer_text = $row['answer_text'];
			$this->published_time = $row['published_time'];
		}		
	}
		
	public static function getAllAnswersOfQuestion($question_id){
		$answers_array = Db::query("	
										SELECT * FROM `answers`
										WHERE `answers`.`question_id` = $question_id
										ORDER BY `published_time` DESC;
									");
		$all_answers = Array();
		while ($row = $answers_array->fetch_assoc()){
			$all_answers[] = new Answer($row['answer_id'],
										$row['question_id'], 
										$row['name'],
										$row['answer_text'], 
										$row['published_time']);
		}
		return $all_answers;
	}
	
}

