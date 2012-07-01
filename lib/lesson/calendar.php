<?php 

/*
	class Calendar:
		createCalendar()
		updateCalendar()
		deleteCalendar()
		getCalendar()
		verifyUserId()
*/


class Calendar {


	/*
	* finds calendars for a user. Need to check for valid Id (here or in displayUsers?)
	*/
	static function getCalendarsByUser($userId) {
		return DB::sql('SELECT calendars.name, calendars.description, calendars.id FROM calendars WHERE calendars.owner_id = '.$userId);
	}
	
	static function getCalendarById($calendarId) {
		return DB::sql('SELECT name, description from calendars WHERE id='.$calendarId);
	}
	
	static function createCalendar() {
		if(DB::sql('INSERT INTO calendars () VALUES ()  '))
			return true;
		else
			return false;
	}
	
	static function updateCalendar() {
		if(DB::sql('UPDATE calendars SET something WHERE id='))
			return true;
		else
			return false;
	}
	
	// checking whether calendarId is an integer. As of now it has to be an integer. Later implement short titles instead of numbers.
	static function verifyCalendarId($id) {
		if(preg_match("/^[0-9]*$/", $id))
			return true;
		else
			return false;
	}

}

?>