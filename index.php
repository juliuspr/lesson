<?php

require __DIR__.'/lib/base.php';
require __DIR__.'/config.php';


F3::set('CACHE',FALSE);
F3::set('DEBUG',1);
F3::set('UI','ui/');
F3::set('AUTOLOAD','lib/');

F3::set('DB',
	new DB(
			'mysql:host=localhost;port=3306;dbname=horner_frog',
			$username,
			$password
			)
);


F3::set('table', 'events');

$routes= array (
			"default" => "events",
			"jan-olav" => "janolav",
			"some-other" => "someother"
		);

if(isset($_SERVER['HTTP_REFERER'])) {
	$referer=explode('/', $_SERVER['HTTP_REFERER']);
	foreach($referer as $r) {
		if($r=="jan-olav"){
			F3::set('table', 'janolav');
		}
	}
}

$uri=explode('/', $_SERVER['REQUEST_URI']);
foreach($uri as $u) {
	if($u=="jan-olav"){
		F3::set('table', 'janolav');
	}
}

F3::route('GET /', 'Lesson::display');
// F3::route('GET /admin', 'Lesson::displayAdmin');
// F3::route('GET /admin/new-calendar', 'Lesson::newCalendar');
 

F3::route('GET /jan-olav', 'Lesson::display');
// F3::route('GET /@calendarId', 'Lesson::display');


F3::route('POST /book', 'Lesson::book');
// F3::route('POST /book/@calendarId/@lessonId', 'Lesson::book');


F3::route('GET /new', 'Lesson::displayNewForm');
F3::route('POST /some', 'Lesson::deleteLesson');



F3::run();

?>
