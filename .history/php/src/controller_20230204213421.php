<?php
session_start();
require_once('./php/CRUD.php');

$db = new db();
echo $db->getData();

?>