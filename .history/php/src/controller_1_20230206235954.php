<?php
session_start();
require_once('./model/CRUD.php');


$db = new db();

if(isset($_POST['data'])){
    
    $raw_data = $_POST['data'];

// Sprawdzenie, czy dane są w formacie JSON
if (json_decode($raw_data) != null) {
$data = json_decode($raw_data);
echo $data->list_name;
echo $data->end_date;
foreach($products->product_id as $key => $value){
echo $products->product_title[$key];
echo $value."<br>";
}
} else {
echo "Dane nie są w formacie JSON";
}
}
?>