<?php
session_start();
require_once('./php/CRUD.php');

$mysqli = new mysqli("localhost", "root", "root", "mydb") die("Connection failed: " . mysqli_connect_error());

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$db = new db();
echo $db->getData();

?>