<?php

class Lesson {
	
	// retrieves entries for lessons from the database
	static function getLessons() {
	
		F3::set('lessons', DB::sql('SELECT 
					title, 
					YEAR(event_date) as year, 
					DATE_FORMAT(event_date, "%W, %e.%c") as date, 
					DATE_FORMAT(event_date, "%H:%i") as time, 
					WEEK(event_date) as week, 
					id  
				FROM '. 
					F3::get('table')
				.' WHERE
					event_date > NOW()
				ORDER BY
					event_date
					asc'));
					
					
	}
	// runs through weeks and makes an array of unique weeks. should be named differently because it only makes week number array
	static function getWeekNumbers() {
		
		// set current week
		$currentWeek = 0;
		$weeks = array();
		// go though all entries
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
	
		$lesson = new Axon(F3::get('table'));
		$id=$_POST['id'];
		$lesson->load('id='.$id);
		
		// maybe would be smart to clean-up the input
		$lesson->title = $_POST['title'];
		$lesson->save();
		//$lesson->email();
		// this echoes what user inputed, and avoids pulling it from database.
		echo $lesson->title;
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
	
	function deleteLesson() { 
		Lesson::display();
	}
	
	// renders a view from template 
	static function display() {
		
		Lesson::getLessons();
		if(!F3::get('lessons'))
			echo 'No upcoming lessons...';
		Lesson::getWeekNumbers();
		
		echo Template::serve('template.htm');
	}
	
	static function displayNewForm() {
	
		echo Template::serve('new.htm');
	}	
	
}


?>