<?php
	require_once '../lib/base.php';
	require_once "../lib/simpletest/unit_tester.php";
	require_once "../lib/simpletest/autorun.php";
	require_once '../lib/classes/Question.class.php';

	class test_question extends UnitTestCase {
		
		public function test_save() {
			$title = 'test question';
			$description = "This is a test question";
			$author = 'Martin';
			$question = new Question($id = null, $title, $author, $description, Photo::from_file('/var/public_html/wtfisthis/mobile/images/handwriting_small.jpg', $title, $description));
			$question->save();
			$id = Db::insert_id();
			$this->assertEqual($id, $question->getId());
			$this->assertEqual($author, $question->getAuthor());
			$this->assertTrue(is_numeric($id) && is_numeric($question->getId()));
			$this->assertFalse($id == 0);
			$this->assertFalse($question->getId() == 0);
			$this->assertNotEqual(false, $question->delete());
			$this->assertNull($question->getId());
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