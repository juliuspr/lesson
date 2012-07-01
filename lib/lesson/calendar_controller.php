<?php

/* 
	file: calendar_controller.php 
	CalendarController class 
	
	class CalendarController:
		displayCalendar()
		editCalendar()
		deleteCalendar()
*/

class CalendarController {

	// how does this method receive calendar id? 
	static function displayCalendar() {
	
		// is ID set at all in URL? if not make it 0. Only imoportant until the default page is not Julius calendar but calendar/user list 
		$calendarId = F3::get('PARAMS["calendarId"]') ? F3::g et('PARAMS["calendarId"]') : 0;

		if(Calendar::verifyCalendarId($calendarId)) {
			F3::set('lessons', Lesson::getLessons($calendarId));
			
			// if no lessons are selected show a page saying there are no lessons
			if(!F3::get('lessons')) {
				echo Template::serve('nothing.htm');
				exit();
			}
			
			F3::set('calendar', Calendar::getCalendarById(F3::get('PARAMS["calendarId"]')));
			echo F3::render('calendar2.htm');	
		} else {
			// display error page
			echo Template::serve('error.htm');
			exit();
		}	
	}
	
	/*
	* displays calendars for a specified user. Takes id from global variable 
	*/
	static function displayCalendars() {
		if(User::verifyUserId()) {
			F3::set('calendars', Calendar::getUserCalendars(F3::get('PARAMS["userId"]')));
			echo Template::serve('display_calendars.htm');
		
		} else {
			echo Template::serve('error.htm');
		}
	}
	
	static function newCalendar() {
	
		// do a better verification of input. What conditions does input have to meet to create new calendar?
		if($_POST['calendar_title']) {
			if(Calendar::createCalendar()) {
				Message::send('Calendar created succesfully!');
			} else {
				Message::send('Calendar was NOT created!');
			}
			// Redirect::somewhere();
		} else {
			echo Template::serve('newcalendar.htm');
		}
	}
	
	static function editCalendar ($id) {
		if($_POST['calendar_title']) {
			if(Calendar::updateCalendar()) {
				Message::send('Calendar updated successfully!');
			} else {
				Message::send('Something went wrong!');
			}
			// Redirect::somewhere();
		} else {
			Calendar::getCalendarById($id);
			echo Template::serve('newcalendar.htm');
		}
	}
	
	static function deleteCalendar($id) {
		if(Calendar::verifyCalendarId()) {
			Calendar::deleteCalendar();
		}
	}
}

?>