<?php

// Database Connection
$db_info = 'localhost';
$username = 'root';
$password = '';
$dbname = 'assignment3';

// Using procedural style
$connection = new mysqli($db_info, $username, $password, $dbname);

if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
