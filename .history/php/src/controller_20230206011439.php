<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['search'])){
    $search = $_POST['search'];
    echo $db->searchData($tablename="list",$search);
}
else{
    echo $db->getData();
}
?>