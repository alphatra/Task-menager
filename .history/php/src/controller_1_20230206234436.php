<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['data'])){
    
    $data = $_POST['data'];
    $products = $data->products;
    echo $data->list_name;
    echo $data->end_date;
    foreach($products->product_id as $key => $value){
        echo $products->product_title[$key];
        echo $value."<br>";
    }
}
?>