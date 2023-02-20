<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['data'])){
    
    $data = json_decode($_POST['data']);
    $products = $data->products;
    echo $products->product_title;
    foreach($products->product_id as $key => $value){
        echo $products->product_title[$key];
        echo $value."<br>";
    }
}
?>