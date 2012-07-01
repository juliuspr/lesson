<?php

/*
	help.php
	
*/
	
class Help {

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
	
<<<<<<< HEAD
	static function deleteConfirmed() {
	
	
	}
=======
	
>>>>>>> 5587c69aa6118e98fefde03a451c6ab5ce1b6c20
}