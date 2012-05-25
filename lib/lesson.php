<?php

class Lesson {
	
	// retrieves entries for lessons from the database. Needs calanedarId from url. Returns array from DB with lessons
	static function getLessons() {
	
		// is ID set at all, if not make it 0. Only imoportant until the default page is not Julius calendar but calendar/user list 
		$cid = F3::get('PARAMS["calendarId"]') ? F3::get('PARAMS["calendarId"]') : 0;
	
		// proceed to select events for that calendar
		return DB::sql('SELECT 
				title, 
				YEAR(event_date) as year, 
				DATE_FORMAT(event_date, "%W, %e.%c") as date, 
				DATE_FORMAT(event_date, "%H:%i") as time, 
				WEEK(event_date) as week, 
				id  
			FROM 
				events
			WHERE
				event_date > NOW()
				AND
				calendar_id = '.$cid.'
			ORDER BY
				event_date
				asc');
	}
	
	static function getCalendarInfo($calendarId) {
		return DB::sql('SELECT name, description from calendars WHERE id='.$calendarId);
	}
	
	static function displayCalendar() {
		
		if(Lesson::isValidCalendarId()) {
			F3::set('lessons', Lesson::getLessons());
			
			// if no lessons are selected show a page saying there are no lessons
			if(!F3::get('lessons')) {
				echo Template::serve('nothing.htm');
				exit();
			}
			// fetch title from DB
			
			F3::set('calendar', Lesson::getCalendarInfo(F3::get('PARAMS["calendarId"]')));
			// output lessons for requested calendar
			echo F3::render('calendar2.htm');	
		} else {
			// display error page
			echo Template::serve('error.htm');
			exit();
		}
		
		
			
	}
	
	/*
	* finds users who have calendars
	*/
	static function getUsers() {
		return DB::sql('SELECT DISTINCT owners.name, owners.id FROM owners, calendars WHERE owners.id = calendars.owner_id');
	}
	
	/*
	* displays users who have calendars
	*/
	static function displayAllUsers() {
		F3::set('users', Lesson::getUsers());
		echo Template::serve('display_users.htm');
	}
	
	/*
	* finds calendars for a user. Need to chack for valid Id (here or in displayUsers?)
	*/
	static function getCalendars($userId) {
		return DB::sql('SELECT calendars.name, calendars.description, calendars.id FROM calendars WHERE calendars.owner_id = '.$userId);
	}
	
	/*
	* displays calendars for a specified user. Takes id from global variable 
	*/
	static function displayCalendars() {
		if(Lesson::isValidUserId()) {
			F3::set('calendars', Lesson::getCalendars(F3::get('PARAMS["userId"]')));
			echo Template::serve('display_calendars.htm');
		// serveTemplate
		} else {
			echo Template::serve('error.htm');
		}
	}
	
	static function displayUsersAndCalendars() {
		getUsers();
		getCalendars();
		// put everything together
		
	}
	
	// checking whether calendarId is an integer. As of now it has to be an integer. Later implement short titles instead of numbers.
	static function isValidCalendarId() {
		if(preg_match("/^[0-9]*$/", F3::get('PARAMS["calendarId"]')))
			return true;
		else
			return false;
	}
	
	static function isValidUserId() {
		if(preg_match("/^[0-9]*$/", F3::get('PARAMS["userId"]')))
			return true;
		else
			return false;
	}

	
	static function book() {
	
		$lesson = new Axon('events');
		$id=$_POST['id'];
		$lesson->load('id='.$id);
		
		$lesson->title = Lesson::filterInput($_POST['title']);
		$lesson->save();
		
		// this echoes what user inputed, and avoids pulling it from database.
		echo $lesson->title;
		
		//$lesson->email();
		
	}
	
	static function filterInput($str) {
		// Ensure it's a string
		$str = strval($str);
		// We strip all html tags
		$str = strip_tags($str);
		// Remove any whitespace using
		// the define method above
		$str = preg_replace('/\s\s+/',' ', $str);
		return $str;
	}
	
	static function email() {
		F3::set('from','no-reply@juliuspranevicius.com');
		F3::set('to','julius.pranevicius@gmail.com');
		F3::set('subject','Booked');
		ini_set('sendmail_from',F3::get('from'));
		mail(F3::get('to'),F3::get('subject'),$_POST['title']);
	}
	
	function addLesson() {
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
	
	static function deleteLesson() { 

	}
	
	
	static function displayNewForm() {
	
		echo Template::serve('new.htm');
	}	
	
}


?>