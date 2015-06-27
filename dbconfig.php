<?php
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   date_default_timezone_set('Europe/Amsterdam');
   $date = new DateTime(); 

   $db = array (
     'host' => 'localhost',
     'user' => 'username',
     'pass' => 'password',
     'dbname' => 'wosteletekst'
   );

   $mysqli = new mysqli($db['host'],  $db['user'], $db['pass'], $db['dbname'], 3306);

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
