<?php 

class Answer extends WTF {
	
	private $answer_id;
	private $question_id;
	private $name;
	private $answer_text;
	private $published_time;
	
	function __construct ($answer_id = null, $question_id, $name, $answer_text, $published_time){	
			$this->question_id = $question_id;
			$this->answer_id = $answer_id;
			$this->name = $name;
			$this->answer_text = $answer_text;
			$this->published_time = $published_time;
	}
	
	public function save() {
		$result = false;
		$sql = "INSERT INTO `wtfisthis`.`answers` 
			(`answer_id`, `question_id`, `name`, `answer_text`, `published_time`) 
			VALUES (NULL, ?, ?, ?, NULL)";
		
		if ($statement = Db::prepare($sql)) { 
			$statement->bind_param("iss", $this->question_id, $this->name, $this->answer_text);
			$result = $statement->execute();
			$statement->close();
		}
		$this->answer_id = DB::insert_id();
		return $result;
	}
	
	/*private function loadAnswer($answer_id) {
		$answer = Db::query("	SELECT * FROM `answers`
								WHERE `answers`.`answer_id` = '$answer_id';
							");
		while ($row = $answer->fetch_assoc()){
			$this->answer_id = $row['answer_id'];
			$this->question_id = $row['question_id'];
			$this->name = $row['name'];
			$this->answer_text = $row['answer_text'];
			$this->published_time = $row['published_time'];

		}
			
	}*/
		
	public static function getAllAnswersOfQuestion($question_id){
		$answers_array = Db::query("	SELECT * FROM `wtfisthis`.`answers`
										WHERE `answers`.`question_id` = $question_id;
									");
		$all_answers =Array();
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

?>