<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$list_id = isset($_REQUEST['list_id'])?$_REQUEST['list_id']:'';
$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
$product_name = isset($_REQUEST['product_name'])?$_REQUEST['product_name']:'';
$quantity = isset($_REQUEST['quantity'])?$_REQUEST['quantity']:'';
$uniqid = uniqid();
echo $db->addPrivateItem($uniqid,$product_name,$quantity);
echo $db->createListItems($quantity,$list_id,'',$uniqid,);
?>