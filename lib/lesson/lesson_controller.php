<?php

/**
	file: lesson_controller.php
	class: LessonController
	
	
	class LessonController:
		displayLesson()
		newLesson()
		editLesson()
		emailBookedLesson()
**/

class LessonController {
	
	static function newLesson() {
		if($_POST['lesson_date']) {
			if(Lesson::createLesson()) {
				Message::send('Calendar updated successfully!');
			} else {
				Message::send('Something went wrong!');
			}
			// Redirect::somewhere();
		} else {
			Lesson::getLessonById($id);
			echo Template::serve('newlesson.htm');
		}
	}
	
	static function editLesson() {
		// fill array with values from DB
		// serve newlesson template with filled values
		// possibly merge newLesson and editLesson functions
		if($_POST['lesson_date']) {
			if(Lesson::updateLesson()) {
				Message::send('Calendar updated successfully!');
			} else {
				Message::send('Something went wrong!');
			}
			// Redirect::somewhere();
		} else {
			Lesson::getLessonById($id);
			echo Template::serve('newlesson.htm');
		}
	}
	
	static function emailBookedLesson() {
	
	}
	
	static function displayLesson($id) {
	
		Lesson::getLessons($id); //this doesn't work yet because getLessons doesn't accept id
		echo Template::serve();
	}

}


?>