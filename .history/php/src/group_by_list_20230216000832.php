<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();
$sql = isset($_REQUEST['sql']) ? $_REQUEST['sql'] : null;
echo $db->getDataOfList($sql);
?>