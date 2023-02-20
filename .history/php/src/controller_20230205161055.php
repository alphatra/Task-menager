<?php
session_start();
require_once('./php/CRUD.php');

$db = new db();
if(isset($_GET['search'])){
    echo $db->getData();
}else{
    echo $db->getData();
}
?>