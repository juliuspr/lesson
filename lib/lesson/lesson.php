<?php

/**
	Lesson booking system
	
	Should be structured as follows:
	
	class Lesson:
		getLessons($id) 
		bookLesson()
		createLesson()
		deleteLesson()
		updateLesson()

**/

class Lesson {
	
	// retrieves entries for lessons from the database.  Returns array from DB with lessons
	// input: calendarId
	// output: array of lessons for given calendar

	static function getLessonsForCalendar($calendarId) {	
		// proceed to select events for given calendar
		return DB::sql('SELECT 
				title, 
				YEAR(event_date) as year, 
				DATE_FORMAT(event_date, "%W, %e.%c") as datef, 
				DATE_FORMAT(event_date, "%Y-%m-%d") as date, 
				DATE_FORMAT(event_date, "%H:%i") as time, 
				WEEK(event_date, 3) as week, 
				id  
			FROM 
				events
			WHERE
				DATE(event_date) >= DATE(NOW())
				AND
				calendar_id = '.$calendarId.'
			ORDER BY
				event_date
				asc');
	}
	
	static function getLesson($id) {
		return DB::sql('SELECT * FROM events WHERE id='.$id);
	}
	
	static function book() {
	
		$lesson = new Axon('events');
		$id=$_POST['id'];
		$lesson->load('id='.$id);
		
		$lesson->title = Help::filterInput($_POST['title']);
		$lesson->save();
		
		// this prints out into input=text field what the user has sent, and avoids pulling it from database.
		echo $lesson->title;
		
		//$lesson->email();
		
	}
	
	
	
	static function email() {
		F3::set('from','no-reply@juliuspranevicius.com');
		F3::set('to','julius.pranevicius@gmail.com');
		F3::set('subject','Booked');
		ini_set('sendmail_from',F3::get('from'));
		mail(F3::get('to'),F3::get('subject'),$_POST['title']);
	}
	
	function createLesson() {
		// $lesson = new Axon('events');
		// $time=$_POST['time'];
		// $date=$_POST['date'];
		//echo $time.$date;
		//echo "dfdf";
		// maybe would be smart to clean-up the input
		// $lesson->title = $_POST['title'];
		// $lesson->save();
		// $lesson->email();
		// this echoes what user inputed, and avoids pulling it from database.
		// echo $lesson->title;
	}
	
	static function deleteLesson($id) { 
		if(DB::sql('DELETE FROM events WHERE id='.$id))
			return true;
		else
			return false;
	}
	
			
}








?>