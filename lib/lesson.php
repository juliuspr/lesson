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
	
	static function displayCalendar() {
		
		if(Lesson::isValidCalendarId()) {
	
			F3::set('lessons', Lesson::getLessons());
			
			// if no lessons are selected show a page saying there are no lessons
			if(!F3::get('lessons')) {
				echo Template::serve('nothing.htm');
				exit();
			}
			
			echo F3::render('calendar2.htm');	
		} else {
			// display error page
			echo Template::serve('error.htm');
			exit();
		}
		
		
			
	}
	
	// checking whether calendarId is an integer. As of now it has to be an integer. Later implement short titles instead of numbers.
	static function isValidCalendarId() {
		if(preg_match("/^[0-9]*$/", F3::get('PARAMS["calendarId"]')))
			return true;
		else
			return false;
	}
	
	static function getUsers() {
	
	}
	
	
	static function listUsers() {
	
		// get users. write a method
		// serve user list to template
		$lesson = new Axon('users');
		// need a template
		// need to fill an array with values
		// serve template
		
	}
	
	
	// runs through weeks and makes an array of unique weeks. should be named differently because it only makes week number array
	static function getWeekNumbers() {
		
		// set current week
		$currentWeek = 0;
		$weeks = array();
		// go through all entries
		// $tmp = array();
		$les = F3::get('lessons');
		// foreach ($les as $row) 
			// if (!in_array($row,$tmp)) array_push($tmp,$row);
		
		// echo "<pre>";
		// print_r($les);
		// print_r($tmp);
		// echo "</pre>";
		
		foreach(F3::get('lessons') as $row) {
			// if current week is not the same as running week add it to array
			if($currentWeek != $row['week'])
			{
				$currentWeek = $row['week'];
				// array of unique weeks
				$weeks[]=$currentWeek;
			}
		}
		// $currentYear = 0;
		// $currentWeek = 0;
		// $i = 0;
		// foreach(F3::get('lessons') as $y) {
			// if($currentYear != $y['year']) {
			// $currentYear = $y['year'];
			// $years[] = $currentYear;
				// foreach(F3::get('lessons') as $row) {
					// if($currentWeek != $row['week'] && $currentYear == $row['year'])
					// {
						// $currentWeek = $row['week'];
						// $weeks['y'.$currentYear][]=$currentWeek;
					// }
				// }
			// }
			// $i++;
		// }
		
		// "return" array of weeks
		F3::set('weeks', $weeks);
		//F3::set('years', $years);
		// account for weeks in different years (for now just by not ordering by year at all
		// f.ex. multidimensional array, with year as index, and maybe one function would be enough. As first index goes for years, the second for weeks. No idea how to render this in template...
		
		}
	
	static function book() {
	
		$lesson = new Axon('events');
		$id=$_POST['id'];
		$lesson->load('id='.$id);
		
		// maybe would be smart to clean-up the input
		$lesson->title = Lesson::filterInput($_POST['title']);
		$lesson->save();
		//$lesson->email();
		// this echoes what user inputed, and avoids pulling it from database.
		echo $lesson->title;
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
	
	// renders a view from template 
	static function display() {
		
		Lesson::getLessons();
		Lesson::getWeekNumbers();
		
		echo Template::serve('calendar.htm');
	}
	
	static function displayNewForm() {
	
		echo Template::serve('new.htm');
	}	
	
}


?>