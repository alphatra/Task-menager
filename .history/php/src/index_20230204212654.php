<?php
session_start();
require_once('./php/CRUD.php');

$mysqli = new mysqli("localhost", "root", "root", "mydb") die("Connection failed: " . mysqli_connect_error());

if ($result = $mysqli -> sql("SELECT * FROM mysql")) {
    echo "Returned rows are: " . $result -> num_rows;
    // Free result set
    $result -> free_result();
  }


  

?>