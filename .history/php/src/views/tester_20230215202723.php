<?php
require_once('../model/CRUD.php');
$db = new db();
echo $db->getDataOfList();
?>