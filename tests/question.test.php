<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/classes/Question.class.php';

	class test_question extends UnitTestCase {
		
		public function test_save() {
			$title = 'test question';
			$description = "This is a test question";
			$question = new Question($id = null, $title, 'Martin', $description, Photo::from_file('../mobile/images/handwriting_small.jpg', $title, $description));
			$question->save();
			$id = Db::insert_id();
			$this->assertEqual($id, $question->getId());
			$this->assertTrue(is_numeric($id) && is_numeric($question->getId()));
			$this->assertFalse($id == 0);
			$this->assertFalse($question->getId() == 0);
		}
		
		
		public function test_load_question () {
			$id = 7;
			$question = new Question($id);
			$this->assertEqual($id, $question->getId());
			$this->assertNotEqual(0, count($question->getAnswers()));
			$this->assertNotNull($question->getAuthor());	
		}
		
		public function test_photo_urls () {
			$question = new Question(7);
			$photo_urls = $question->getPhoto()->getUrls();
			$this->assertNotNull($photo_urls['medium']);
		}
	}
?>