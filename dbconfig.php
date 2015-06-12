<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	date_default_timezone_set('Europe/Amsterdam');
   $date = new DateTime(); 

   $db = array (
	  'host' => '127.0.0.1:3306',
	  'user' => 'username',
	  'pass' => 'password',
	  'dbname' => 'WOSTeletekst'
   );

   $mysqli = new mysqli($db['host'],  $db['user'], $db['pass'], $db['dbname']);

   function dbConnect() {
      global $mysqli;
      if ($mysqli->connect_errno) {
         echo "Failed to connect to MySQL: (".$mysqli->connect_errno.")".$mysqli->connect_error;
      }
   }

   function dbClose() {
      global $mysqli;
      $mysqli->close();
   }
?> 