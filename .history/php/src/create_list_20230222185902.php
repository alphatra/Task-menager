<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$list_name = isset($_REQUEST['list_name']) ? $_REQUEST['list_name'] : '';
$end_date = isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : '';
$products = isset($_REQUEST['products']) ? $_REQUEST['products'] : '';

echo (print_r($products, true));

echo $db->createList($list_name, $end_date);
if (!empty($products)) {
    if (is_array($products)) {
        $products = json_encode($products);
    }
    $products = json_decode($products);
    foreach ($products as $product) {
        echo "Product ID: " . $product->product_id . "<br>";
        echo "Product Title: " . $product->product_title . "<br>";
        echo "Quantity: " . $product->qty . "<br>";
        echo $db->createListItems($product->qty, $list_name, $product->product_id, '');
    }
}

//foreach ($products as $product) {
//    echo $db->createListItems($product["qty"],$list_name,$product["product_id"],'').'\n';
//}

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