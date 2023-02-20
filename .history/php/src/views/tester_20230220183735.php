<?php
require_once('../model/CRUD.php');
$db = new db();

$data = $db->getDataOfList();

$lists = array();
foreach ($data as $item) {
    $list_id = $item['list_id'];

    // Jeśli tablica dla listy o danym list_id nie istnieje, utwórz ją
    if (!isset($lists[$list_id])) {
        $lists[$list_id] = array(
            'id' => $list_id,
            'name' => '',
            'created_date' => '',
            'items' => array()
        );
    }
    $lists[$list_id]['items'][] = array(
        'id' => $item['id'],
        'name' => $item['name'],
        'quantity' => $item['quantity'],
        'category' => $item['category']
    );
?>