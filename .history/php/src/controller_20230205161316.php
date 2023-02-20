<?php
session_start();
require_once('./php/CRUD.php');

$db = new db();
echo $db->getData();
if(isset($_GET['search'])){
    echo $db->getData();
}else{
    echo $db->getData();
}
?>