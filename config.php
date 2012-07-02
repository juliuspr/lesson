<?php
// config.php
// database login information

$username = 'horner';
$password = '42154215';

$db_name = 'horner_frog';
$table_prefix = 'lesson_';

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$username = 'root';
	$password = '';
}

?>
