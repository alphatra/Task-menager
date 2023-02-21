<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$list_name = isset($_REQUEST['list_name'])?$_REQUEST['list_name']:'';
$end_date = isset($_REQUEST['end_date'])?$_REQUEST['end_date']:'';
$products = isset($_REQUEST['products'])?$_REQUEST['products']:'';
$db->createList($list_name, $end_date);

foreach ($products as $product) {
    
    echo $db->createListItems($product["qty"],$list_name,$product["product_id"],'');
}

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