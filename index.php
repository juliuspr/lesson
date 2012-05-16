<?php

// suggestions for name: virtual signup sheet, electronic signup sheet, digital, simple signup sheet
// there are big problems with last and first weeks of the year. events are not displayed...
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
F3::set('AUTOLOAD','lib/');

// establishing DB connection(?)
F3::set('DB',
	new DB(
			'mysql:host=localhost;port=3306;dbname='.$db_name,
			$username,
			$password
			)
);



//display default. For now it is Julius' default calendar. Ultimately list users and their calendars
F3::route('GET /', 'Lesson::display');

// if calendar id is set then display particular calendar
F3::route('GET /@calendarId', 'Lesson::display');


// create admin site to create new calendars, to edit existing ones, archive/delete old ones.
// F3::route('GET /admin', 'Lesson::displayAdmin');
// F3::route('GET /admin/new-calendar', 'Lesson::newCalendar');
 

 
// the route to ajax-book a lesson
F3::route('POST /book', 'Lesson::book');



// admin features
F3::route('GET /new', 'Lesson::displayNewForm');
F3::route('POST /some', 'Lesson::deleteLesson');
//just testing


F3::run();

