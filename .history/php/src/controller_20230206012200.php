<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['tablename'])){
    $search = $_POST['search'];
    echo $db->getData($tablename="list");
}

?>