<?php
$db_host = '127.0.0.1';
$db_username = 'root';
$db_password = '';
$db_table_name = 'dict_case2';

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_table_name);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
