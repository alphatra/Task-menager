<?php
session_start();
require_once('./model/CRUD.php');
require_once('./model/product_model.php');

$db = new db();
if(isset($_POST['search'])){
    $search = $_POST['search'];
    echo $db->searchData(null,$search);
}
else{
    echo $db->getData();
}
$produkt = new productModel("test", "test", "test", "test");
echo $produkt
?>