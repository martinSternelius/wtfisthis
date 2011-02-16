<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/classes/Question.class.php';

	class test_phpflickr extends UnitTestCase {
		public function test_save() {
			$question = new Question($id = null, 'Test Question', 'This is a test question', new Photo(8));
			$question->save();
			$id = Db::insert_id();
			$this->assertEqual($id, $question->getId());
			$this->assertTrue(is_numeric($id) && is_numeric($question->getId()));
			$this->assertFalse($id == 0 || $question->getId() == 0);
		}
		
		public function test_loadAnswers () {
			$id = 7;
			$question = new Question($id);
			$this->assertEqual($id, $question->getId());
			$this->assertNotEqual(0, count($question->getAnswers()));
			
		}
	}
	
?>