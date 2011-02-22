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
			$this->assertEqual($author, $question->getAuthor());
			$this->assertEqual($title, $question->getTitle());
			$this->assertEqual($description, $question->getDescription());
			$this->assertFalse($question->getId() == 0);
			
			//Delete so we don't end up with a bunch of test data in the DB
			$this->assertNotEqual(false, $question->delete());
			$this->assertNull($question->getId());
		}
		
		
		public function test_load_question () {
			$id = 6;
			$question = new Question($id);
			$this->assertEqual($id, $question->getId());
			$this->assertNotEqual(0, count($question->getAnswers()));
		}
		
		public function test_answer_question() {
			$answer_text = "You want answers? You want the truth? You can't handle the truth!";
			$name = 'Colonel Jessep';
			$answer = new Answer($id = null, 6, $name, $answer_text);
			$this->assertNotEqual(false, $answer->save());
			$id = Db::insert_id();
			$this->assertEqual($id, $answer->getId());
		}
		
		public function test_photo_urls () {
			$question = new Question(7);
			$photo_urls = $question->getPhoto()->getUrls();
			$this->assertNotNull($photo_urls['medium']);
		}
	}