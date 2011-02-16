<?php
	require_once "../lib/base.php";
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/phpFlickr-3.1/phpFlickr.php';

	class test_phpflickr extends UnitTestCase {
				
		public function test_construct() {
			$pf = new phpFlickr(CFG_FLICKR_TOKEN, FLICKR_SECRET);
			$this->assertNotNull($pf);
		}
		
		/*
		public function test_upload() {
			$pf = new phpFlickr(FLICKR_API_KEY, FLICKR_SECRET);
			$pf -> setToken(CFG_FLICKR_TOKEN);
			$photo = $_SERVER{'DOCUMENT_ROOT'} . "/wtfisthis/tests/image.jpg";
			$this->assertTrue(file_exists($photo));
			$photoid = $pf->sync_upload($photo);
			$this->assertNotNull($photoid);
			$this->assertNotEqual($photoid, 2147483647);
		}
		*/
	}
	
?>