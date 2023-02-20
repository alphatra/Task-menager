<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();
$query = isset($_REQUEST['query']) ? $_REQUEST['query'] : '';
echo $db->getDataOfList($query);
?>