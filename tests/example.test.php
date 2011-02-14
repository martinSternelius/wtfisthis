<?php
	require_once "simpletest/unit_tester.php";
	require_once "simpletest/reporter.php";
	require_once "simpletest/autorun.php";

	class test_example extends UnitTestCase {
				
		public function test_this() {
			$this->assertTrue(true);
			$this->assertEqual(1+1, 2);
		}		
	}
?>