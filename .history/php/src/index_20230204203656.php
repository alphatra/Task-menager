<?php
$login="root";
$haslo="MYSQL_ROOT_PASSWORD";
$baza="mydb";
$conn=new mysqli("mysql_db",$login,$haslo,$baza) or die("nie mogę połączyć z bazą");

?>