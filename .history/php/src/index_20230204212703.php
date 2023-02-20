<?php
session_start();
require_once('./php/CRUD.php');

$mysqli = new mysqli("localhost", "root", "root", "mydb") 

if ($result = $mysqli -> query("SELECT * FROM mysql")) {
    echo "Returned rows are: " . $result -> num_rows;
    // Free result set
    $result -> free_result();
  }

$db = new db();
echo $db->getData();

?>