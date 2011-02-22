<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/classes/Photo.class.php';
	
	class test_photo extends UnitTestCase {
		function test_new_photo() {
			$file = $_SERVER['DOCUMENT_ROOT']. '/wtfisthis/mobile/images/handwriting_small.jpg';
			$this->assertTrue(file_exists($file));
			$title = 'test photo';
			$description = 'description of test photo';
			$photo = Photo::from_file($file, $title, $description);
			$this->assertNotNull($photo->getId());
		}
	}
	
?>
