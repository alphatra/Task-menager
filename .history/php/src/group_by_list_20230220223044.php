<?php
require_once('../model/CRUD.php');
$db = new db();

try {
    $data = $db->getDataOfList();

    $lists = array_reduce($data, function ($result, $list) {
        $list_id = $list['list_id'];
        if (!isset($result[$list_id])) {
            $result[$list_id] = [
                'id' => $list_id,
                'name' => $list['name'],
                'created_date' => $list['created_date'],
                'end_date' => $list['end_date'],
                'priority' => $list['priority'],
                'products' => []
            ];
        }
        $result[$list_id]['products'][] = [
            'id' => $list['id'],
            'name' => $list['name'],
            'quantity' => $list['quantity'],
        ];
        return $result;
    }, []);

    header('Content-Type: application/json');
    echo $lists;
} catch (PDOException $e) {
    // Obsługa błędów bazy danych
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}

?>