<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once "../lib/classes/Answer.class.php";
	require_once "../lib/classes/Question.class.php";
	

	class test_answer extends UnitTestCase {
		
		public function test_save() {
			$question_id = 7;
			$answer = new Answer(null, $question_id, 'Author of reply', 'Answer to question', null);
			$answer->save();
			$id = Db::insert_id();
			$this->assertEqual($id, $answer->getId());
			$this->assertTrue(is_numeric($id) && is_numeric($answer->getId()));
			$this->assertFalse($id == 0 || $answer->getId() == 0);
			
			$this->assertEqual($question_id, $answer->getQuestionId());
		}
		/*
		public function test_addAnswer() {
			$question_id = 7;
			$question = new Question($question_id);
			$answer = new Answer(null, $question_id, 'Author of reply', 'Answer to question', '2010-10-10');
			$answer_id = $answer->save();
			$question->addAnswer($answer);
			$answer_check = $question->getAnswer($answer_id);
			$this->assertEqual($answer_id, $answer_check->getId());
			$this->assertEqual($question_id, $answer_check->getQuestionId());
		}
		*/
	}
	
?>