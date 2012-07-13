<?php

/*
	class User:
		getUser()
		createUser()
		updateUser()
		deleteUser()
*/

class User {

	/*
	* finds users who have calendars
	*/
	static function getUsers() {
		return DB::sql('SELECT DISTINCT owners.name, owners.id FROM owners, calendars WHERE owners.id = calendars.owner_id');
	}
	
	static function verifyUserId() {
		if(preg_match("/^[0-9]*$/", F3::get('PARAMS["userId"]')))
			return true;
		else
			return false;
	}
	
}
	
?>