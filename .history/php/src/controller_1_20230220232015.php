<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['data'])){
    $data = $_POST['data'];
    if (is_array($data)) {
        $data = json_encode($data);
    }
    $data = json_decode($data);
    $_list_name = $data->list_name;
    $_end_date = $data->end_date;
    $products = $data->products;
    $db->createList($_list_name, $_end_date );
    foreach ($products->product_id as $key => $value) {
        $db->createListItems($products->qty[$key], $data->list_name, $products->product_id[$key]);
    }
    echo "Lista została dodana"."". $_list_name."". $_end_date."". $products."". $data->list_name."". $products->product_id."". $products->qty;
}
?>