<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$query = isset($_REQUEST['query']) ? $_REQUEST['query'] : null;
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
echo $db->getData($query);
?>