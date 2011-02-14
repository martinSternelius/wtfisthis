<?php
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/reporter.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/phpFlickr-3.1/phpFlickr.php';

	class test_phpflickr extends UnitTestCase {
				
		public function test_construct() {
			$pf = new phpFlickr('abc');
			$this->assertNotNull($pf);
		}
	}
	
?>