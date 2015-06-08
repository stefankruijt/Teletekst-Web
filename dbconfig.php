<?php
$db = array 
(
    'host' => '127.0.0.1:3306',
    'user' => 'username',
    'pass' => 'password',
    'dbname' => 'WOSTeletekst'
);

$mysqli = new mysqli($db['host'],  $db['user'], $db['pass'], $db['dbname']);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?> 