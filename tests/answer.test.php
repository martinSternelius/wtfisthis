<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once "../lib/classes/Answer.class";

	class test_answer extends UnitTestCase {
				
		public function test_loadAnswer() {
			$id = 1;
			$answer = new Answer($id);
			$this->assertEqual($id, $this->getId());
		}
	}
	
	
	
?>