<?php
session_start();
require_once('./php/CRUD.php');

$mysqli = new mysqli("localhost", "root", "root", "mydb") die("Connection failed: " . mysqli_connect_error());



$db = new db();
echo $db->getData();

?>