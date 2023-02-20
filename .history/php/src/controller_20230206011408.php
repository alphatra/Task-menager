<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();
if(isset($_POST['tablename'])){
    $_tablename = $_POST['tablename'];
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        echo $db->searchData($tablename=$_tablename,$search);
    }
    else{
        echo $db->getData($tablename=$_tablename);
    }
}
?>