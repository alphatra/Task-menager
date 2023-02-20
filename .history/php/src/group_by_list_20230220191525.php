<?php
session_start();
require_once('./model/CRUD.php');

$db = new db();

try {
    $sql = isset($_REQUEST['sql']) ? $_REQUEST['sql'] : null;
    $data = $db->getDataOfList($sql);

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
            'name' => $list['product_name'],
            'quantity' => $list['quantity'],
        ];
        return $result;
    }, []);

    header('Content-Type: application/json');
    echo json_encode(array_values($lists));
} catch (PDOException $e) {
    // Obsługa błędów bazy danych
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>