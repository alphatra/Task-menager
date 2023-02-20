<?php
session_start();
require_once('./php/CRUD.php');

$db = new db();
if(isset($_POST['search'])){
    $search = $_POST['search'];
    echo $db->searchData(null,$search);
}
else{
    echo $db->getData();
}

?>