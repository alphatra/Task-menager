<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $_tablename = $_POST['tablename'];
    echo $db->searchData($_tablename,$search);
}
else{
    $_tablename = $_POST['tablename'];
    echo $db->getData($_tablename);
}
if(isset($_POST['data'])){
    
    $data = $_POST['data'];
    echo $data;
    
}
?>