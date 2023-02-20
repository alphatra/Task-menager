<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();
$_tablename = $_POST['tablename'];
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if(isset($_POST['category'])){
        $_category = $_POST['category'];
    }
    echo $db->searchData($_tablename,'',$_category);
}else{
    echo $db->getData($_tablename);
}
?>