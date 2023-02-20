<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();
$_tablename = $_POST['tablename'];

if(isset($_POST['search'])||isset($_POST['category'])){
    $search = $_POST['search'];
    $_category = $_POST['category'];
    echo $db->searchData($_tablename,$search,$_category)
}else{
    echo $db->getData($_tablename);
}
?>