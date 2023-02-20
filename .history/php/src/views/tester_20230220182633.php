<?php
require_once('../model/CRUD.php');
$db = new db();

$data = $db->getDataOfList();

printf ($data);
?>