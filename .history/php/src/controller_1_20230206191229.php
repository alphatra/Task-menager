<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['data'])){
    
    $data = json_decode($_POST['data']);
    echo $data;
    
}
?>