<?php

/* 
	file: message.php
	Message class
	
	Little funny class to set a info message to display on the page after form processing
*/
	

class Message {
	// sets global F3 variable 'message'
	static function send($message) {
		F3::set('message', $message);
	}
}

?>