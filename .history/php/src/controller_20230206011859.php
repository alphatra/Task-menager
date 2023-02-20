<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['tablename'])){
    $_tablename = $_POST['tablename'];
    $_tablename = "products"
    $search = $_POST['search'];
    echo $db->getData($tablename=$_tablename);
}
?>