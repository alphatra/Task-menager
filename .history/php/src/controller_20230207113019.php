<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();
$_tablename = $_POST['tablename'];
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $result = $db->searchData($_tablename,$search,$category);
    if(isset($_POST['category'])){
        $_category = $_POST['category'];
    }
    echo $result;
}else{
    echo $db->getData($_tablename);
}
?>