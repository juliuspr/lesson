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
<<<<<<< HEAD
	* finds calendars for a user. Need to check for valid Id (here or in displayUsers?)
	*/
	static function getCalendarsByUser($userId) {
=======
	* finds calendars for a user. Need to chack for valid Id (here or in displayUsers?)
	*/
	static function getUserCalendars($userId) {
>>>>>>> 5587c69aa6118e98fefde03a451c6ab5ce1b6c20
		return DB::sql('SELECT calendars.name, calendars.description, calendars.id FROM calendars WHERE calendars.owner_id = '.$userId);
	}
	
	static function getCalendarById($calendarId) {
		return DB::sql('SELECT name, description from calendars WHERE id='.$calendarId);
	}
	
	static function createCalendar() {
<<<<<<< HEAD
		if(DB::sql('INSERT INTO calendars () VALUES ()  '))
=======
		if(DB::sql('INSERT INTO calendars SET '))
>>>>>>> 5587c69aa6118e98fefde03a451c6ab5ce1b6c20
			return true;
		else
			return false;
	}
	
	static function updateCalendar() {
<<<<<<< HEAD
		if(DB::sql('UPDATE calendars SET something WHERE id='))
=======
		if(DB::sql('UPDATE calendars SET WHERE id='))
>>>>>>> 5587c69aa6118e98fefde03a451c6ab5ce1b6c20
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