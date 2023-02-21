<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
echo $db -> updateTitle($id,$name);
?>