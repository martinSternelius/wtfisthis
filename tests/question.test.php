<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/classes/Question.class.php';

	class test_phpflickr extends UnitTestCase {
				
		public function test_save() {
			$question = new Question($id = null, 'Test Question', 'This is a test question', 999);
			$question->save();
			$result = Db::query('SELECT LAST_INSERT_ID() as id');
			$this->assertEqual($result['id'], $question->getId());
		}
	}
	
?>