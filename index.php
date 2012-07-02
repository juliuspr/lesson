<?php

// suggestions for name: simple lesson signup sheet
// there are problems with last and first weeks of the year. events are not displayed...
// make one master html template (stylesheets, javascript, header, footer) and then do the rest of the stuff in includes (read about this)
// private calendars

// including F3 required file
require __DIR__.'/lib/base.php';

// including configuration file
require __DIR__.'/config.php';

// doing neccessary(?) F3 stuff
F3::set('CACHE',FALSE);
// set to 0 on production site
F3::set('DEBUG',1);
F3::set('UI','ui/');
F3::set('AUTOLOAD','lib/, lib/lesson');

//F3::set('ONERROR','myErrorHandler');
function myErrorHandler() {
	// custom error handler code goes here
	// use this if u want to display errors in a
	// format consistent with your site's theme
	//echo "Sorry about an error";
}

// sanitize $_REQUEST here


// establishing DB connection(?)
F3::set('DB',
	new DB(
			'mysql:host=localhost;port=3306;dbname='.$db_name,
			$username,
			$password
			)
);




// calendar CRUD etc
// F3::route('GET /', function (){echo "thhis";});
F3::route('GET /', 'CalendarController::displayCalendars');

// if calendar id is set then display particular calendar
F3::route('GET /@calendarId', 'CalendarController::displayCalendar');
F3::route('GET /users', 'UserController::displayAllUsers');
F3::route('GET /user/@userId', 'Lesson::displayCalendars');


F3::route('GET /calendars', 'CalendarController::displayCalendars');
F3::route('GET /calendar/@calendarId', 'CalendarController::displayCalendar');

F3::route('GET /calendar/new', 'CalendarController::newCalendar');
F3::route('POST /calendar/new', 'CalendarController::newCalendar');

F3::route('GET /calendar/edit/@calendarId', 'CalendarController::editCalendar');
F3::route('POST /calendar/edit/@calendarId', 'CalendarController::editCalendar');

F3::route('POST /calendar/delete/@calendarId', 'CalendarController::deleteCalendar');


// user CRUD etc.
F3::route('GET /users', 'UserController::displayAllUsers');
F3::route('GET /user/@userId', 'UserController::displayUser');

 

 
// the route to ajax-book a lesson
F3::route('POST /book', 'Lesson::book');



// admin features
F3::route('GET /new', 'Lesson::displayNewForm');
F3::route('POST /some', 'Lesson::deleteLesson');


F3::run();

