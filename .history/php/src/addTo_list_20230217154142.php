<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$list = isset($_REQUEST['list'])?$_REQUEST['list']:'';
echo $list;
$product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
echo $product_name;
$quantity = isset($_REQUEST['quantity'])?$_REQUEST['quantity']:'';
echo $quantity;
$uniqid = uniqid();
echo $db->addPrivateItem($uniqid,$product_name,$quantity);
echo $uniqid;
echo $db->createListItems($quantity,$list,'',$uniqid);
echo $uniqid;
?>