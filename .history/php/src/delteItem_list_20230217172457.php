<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
echo $db -> deleteItem($id);
?>