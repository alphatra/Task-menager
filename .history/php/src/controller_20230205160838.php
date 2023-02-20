<?php
session_start();
require_once('./php/CRUD.php');

$db = new db();
if(isset($_POST['search'])){
    echo $db->getData($tablename,$_POST['search']);
}else{
    echo $db->getData();
}
?>