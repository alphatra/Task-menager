<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();
if(isset($_POST['search'])){
    $search = $_POST['search'];
    echo $db->searchData(null,$search);
}
else{
    echo $db->getData();
}
require_once('./model/product_model.php');
$produkt = new productModel("test", "test", "test", "test");
echo $produkt->getName();
?>