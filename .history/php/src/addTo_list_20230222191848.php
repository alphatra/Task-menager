<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$list = isset($_REQUEST['list'])?$_REQUEST['list']:'';
$product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
$quantity = isset($_REQUEST['quantity'])?$_REQUEST['quantity']:'';
$uniqid = uniqid();
echo $db->addPrivateItem($uniqid,$product_name,$quantity);
echo $db->createListItems($list,$quantity,'',$uniqid);
?>