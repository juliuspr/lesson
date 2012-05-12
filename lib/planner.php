<?php

// attendee has many rehearsals
// rehearsal has many attendees

class Rehearsal {
	
	//???? private $possibleTimeDate; // table join. availableTimeDate = rehearsal.id - timeDate.id
	private $checkedTimeDate; // usersAnswer = timeDate.id + answer(1,0,-1,2) yes, n/a, no, unsure
	private $attendees; //table join. table attendees = rehearsal.id - person.id
	
	// what can admins do?
	private $admins; //join table. table administrators = rehearsal.id - person.id

	private $details; // array with location, description and other details
	private $id;
	
	static function addAttendee() {
	
	}
	
	static function deleteAttendee() {
	// delete also all the entries for attendee_rehearsals where one is attending
	}
	
	static function addAdmin() {
	
	}
	
	static function deleteAdmin() {
		// check if at least one contact person is left
	}
	
	static function lastAdmin() {
		// should keep at least one admin in DB
	}
	
	

}

class Planner {

	private $admin; //array
	private 

	static function listAppointments() {
	
	}
	
	static function listAttendees() {
	
	}
	
	static function addAttendee() {
	
	}
	
	static function 


}