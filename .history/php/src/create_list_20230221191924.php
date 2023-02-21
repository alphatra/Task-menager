<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$data = isset($_REQUEST['data'])?$_REQUEST['data']:'';
echo $data;
/*$list = isset($_REQUEST['list'])?$_REQUEST['list']:'';
$data = isset($_REQUEST['data'])?$_REQUEST['product_id']:'';
$quantity = isset($_REQUEST['quantity'])?$_REQUEST['quantity']:'';
if(isset($_POST['data'])){
    $data = $_POST['data'];
    if (is_array($data)) {
        $data = json_encode($data);
    }
    $data = json_decode($data);
$_list_name = $data->list_name;
$_end_date = $data->end_date;
$db->createList($_list_name, $_end_date );
echo $db->createListItems($quantity,$list,$product_id,'');*/
?>