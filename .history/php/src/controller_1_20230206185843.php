<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['data'])){
    echo $_POST['data'];
    $data = $_POST['data'];
    
}
?>