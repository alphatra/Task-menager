<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$list_id = $_POST['list_id'];
$db -> getDataOfList($list_id);
?>