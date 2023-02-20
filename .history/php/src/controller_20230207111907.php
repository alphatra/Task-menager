<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $_tablename = $_POST['tablename'];
    $_category = $_POST['category'];
    echo $db->searchData($_tablename,'',$_category);
}else{
    $_tablename = $_POST['tablename'];
    $_category = $_POST['category'];
    echo $db->getData($_tablename,$_category);
}
?>