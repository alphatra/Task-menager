<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="views/createList.php">Stwórz Listę</a>
    <a href="views/createProduct.php">Stwórz Produkt</a>
</body>
</html>
<?php
require_once('../model/CRUD.php');
require_once('../model/product_model.php');
$db = new db();
$produkt = new productModel("test", "test", "test", "1");
$produkt = $produkt->returnObject();
//echo $produkt;

$parameters = $db->fetchData($produkt);
//echo $db->createProduct($parameters);
echo 
?>