<?php
require_once('../model/CRUD.php');
$db = new db();

$data = $db->getDataOfList();

$lists = array();
foreach ($data as $list) {
    $list_id = $list['list_id'];
    $list_name = $list['name'];
    $list_creation_date = $list['created_date'];
    $list_end_date = $list['end_date'];
    $list_priority = $list['priority'];

    // Jeśli tablica dla listy o danym list_id nie istnieje, utwórz ją
    if (!isset($lists[$list_id])) {
        $lists[$list_id] = array(
            'id' => $list_id,
            'name' => $list_name,
            'created_date' => $list_creation_date,
            'end_date' => $list_end_date,
            'priority' => $list_priority,
            'products' => array()
        );
    }
    $lists[$list_id]['products'][] = array(
        'id' => $item['id'],
        'name' => $item['name'],
        'quantity' => $item['quantity'],
    );
}

$json = json_encode(array_values($lists));

echo $json;

?>