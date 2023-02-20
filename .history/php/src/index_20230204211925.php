<?php
session_start();
require_once('./php/CRUD.php');

$mysqli = new mysqli("MYSQL_DATABASE","root","MYSQL_ROOT_PASSWORD","MYSQL_DATABASE");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$db = new db();
echo $db->getData();

?>