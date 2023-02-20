<?php
session_start();
require_once('./php/CRUD.php');

$db = new db();
echo $db->searchData();
if(isset($_GET['search'])){
    echo $db->getData();
}else{
    echo $db->getData();
}
?>