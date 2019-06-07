<?php
  defined('NON_DIRECT') OR http_response_code(403);
  
  // Configuration for database connection
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'btl_masterserver';

  $db = new mysqli($hostname, $username, $password, $database);
  if ($db->connect_errno) {
    die("Failed to connect to MySQL: " . $db->connect_error);
  }
?>