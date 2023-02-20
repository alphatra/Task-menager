<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();
$_tablename = $_POST['tablename'];
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $result = $db->searchData($_tablename,$search,'');
    if(isset($_POST['category'])){
        $_category = $_POST['category'];
        $result = $db->searchData($_tablename,$search,$_category);
    }
    echo $result;
}else{
    echo $db->getDataOfList();
}
?>