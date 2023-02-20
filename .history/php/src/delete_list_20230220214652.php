<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

$id = isset($_REQUEST['listId']) ? $_REQUEST['listId'] : null;
echo $db -> deleteList($id);
?>