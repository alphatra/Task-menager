<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

//$list_id = isset($_REQUEST['lsit_id'])
//$id = isset($_REQUEST['id'])
//$product_name = isset($_REQUEST['product_name'])
//$quantity = isset($_REQUEST['quantity'])
$uniqid = uniqid();
echo $uniqid;
echo $db->addPrivateItem(uniqid(),$product_name,$quantity);
?>