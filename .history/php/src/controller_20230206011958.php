<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

echo $db->getData($tablename=$_POST['tablename']);
?>