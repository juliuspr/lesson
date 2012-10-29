<?php

/**
	file: lesson_controller.php
	class: LessonController
	
	
	class LessonController:
		displayLesson()
		newLesson()
		updateLesson()
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
			Lesson::getLesson($id);
			echo Template::serve('newlesson.htm');
		}
	}
	
	static function emailBookedLesson() {
	
	}
	

}


?>