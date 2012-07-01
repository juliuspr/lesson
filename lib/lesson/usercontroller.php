<?php

/*
	
*/

class UserController {

	/*
	* displays users who have calendars
	*/
	static function displayAllUsers() {
		F3::set('users', User::getUsers());
		echo Template::serve('display_users.htm');
	}
	
	static function displayUsersAndCalendars() {
		User::getUsers();
		Calendar::getCalendars();
		// put everything together
		
	}
}

	
?>