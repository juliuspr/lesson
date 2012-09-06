<?php
// config.php
// database login information

$username = '';
$password = '';

$db_name = '';
$table_prefix = 'lesson_';

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$username = 'root';
	$password = '';
}

?>
