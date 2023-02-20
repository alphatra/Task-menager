<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$sql = isset($_REQUEST['sql']) ? $_REQUEST['sql'] : null;
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
echo $db->getData($sql);
?>