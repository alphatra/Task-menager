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
    $list_name = $data->list_name;
    $end_date = $data->end_date;
    $products = $data->products;
    foreach ($products->product_id as $key => $value) {
        echo $products->product_title[$key];
        echo $value."<br>";
    }
}
?>