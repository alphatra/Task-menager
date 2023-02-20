<?php
class db{
    private $conn;
    public $servername;
    public $username;
    public $password;
    public $database;
    public $tablename;
    
    public function __construct($host="db", $database="mydb", 
                                $username="root", $password="root"){
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

        try {
            // Tworzenie połączenia
            $this->conn = new mysqli($host, $username, $password, $database);
        } catch (Exception $e) {
            // Sprawdzanie połączenia
            die("Connection failed: " . mysqli_connect_error());
            
        }

        return $this->conn;
    }

    // Wyświetlanie list z bazy danych
    public function getData($sql = null, $category = null){
        $this->sql = $sql;
        $this->category = $category;
        $arg = '';
        if((isset($this->sql) && $this->sql != '' ) || (isset($this->sql) && $this->category != '')){
            $arg = "WHERE p.product_name LIKE '$this->sql%' AND p.category_id LIKE '$this->category%'";
        }
        $sql = "SELECT * FROM products p ".$arg;
        $result = mysqli_sql($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return json_encode($result);
    }
    public function getDataOfList($sql = null){
        $this->sql = $sql;
        $arg = '';
        if(isset($this->sql) && $this->sql != ''){
            $arg = "WHERE l.name LIKE '$this->sql%' OR l.created_date LIKE '$this->sql%'";
        }
        $sql = "SELECT l.name,l.id as idl, l.created_date, l.end_date, l.priority, COALESCE(p.product_name, pi.item_name) AS product_name, li.quantity, li.id 
                FROM list l 
                LEFT JOIN list_items li ON l.id = li.list_id 
                LEFT JOIN products p ON li.id_product = p.id_product 
                LEFT JOIN private_items pi ON li.item_key = pi.item_key 
                $arg
                ORDER BY l.name";
        $result = mysqli_sql($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $result;
    }
    public function getListId($list_name){
        $this->list_name = $list_name;
        $sql = "SELECT id FROM list WHERE name = '$this->list_name'";
        $result = mysqli_sql($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = $result[0]['id'];

        return $result;
    }
    public function deleteList($list_id) {
        $this->list_id = $list_id;
        //$list_name= $this->getListId($list_id);
        $sql1 = "DELETE FROM list WHERE id = '{$list_id}'";
        $result = mysqli_sql($this->conn, $sql1);
        $sql2 = "DELETE FROM list_items WHERE list_id = $list_id";
        $result = mysqli_sql($this->conn, $sql2);

        return $this->list_id ;
    }
    public function deleteItem($item_id) {
        $this->item_id = $item_id;
        $sql = "DELETE FROM list_items WHERE id = $this->item_id";
        $result = mysqli_sql($this->conn, $sql);

        return $sql;
    }
    
    // Wyświetlanie list z bazy danych wraz z wyszukiwaniem
    public function searchData($tablename, $search, $category){
        $this->tablename = $tablename;
        $this->search = $search;
        $this->category = $category;
        if($tablename == 'products'){
            $sql = "SELECT * FROM $this->tablename WHERE product_name LIKE '$this->search%'";
            if($category != ''){
                $sql .= " AND category_id = $this->category";
            }
        }else{
            $sql = "SELECT * FROM $this->tablename WHERE name LIKE '$this->search%'";
            if($category != ''){
                $sql .= " AND category_id = $this->category";
            }
        }
        $result = mysqli_sql($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return json_encode($result);
    }
    /*
    public function searchData($tablename="", $search=""){
        $this->tablename = "list";
        $this->search = "{$search}%";
        $sql = "SELECT * FROM $this->tablename WHERE name LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$search);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
    */

    // Dodawanie produktów do bazy danych
    public function createProduct($Param){
        $product_name = $Param[0];
        $product_description = $Param[1];
        $product_image = $Param[2];
        $category_id = $Param[3];
        $sql = "INSERT INTO products (product_name, product_description, product_image, category_id) 
                    VALUES ('{$product_name}', '{$product_description}', '{$product_image}', '{$category_id}')";

        mysqli_sql($this->conn, $sql);
    }

    public function fetchData($Data){
        $this->Data = $Data;
        $decoded_json = json_decode($Data, true);
        $product_name = $decoded_json['product_name'];
        $product_description = $decoded_json['product_description'];
        $product_image = $decoded_json['product_image'];
        $category_id = $decoded_json['category_id'];
        return [$product_name, $product_description, $product_image, $category_id];
    }

    public function getMaxId($tablename){
        $this->tablename = $tablename;
        $sql = "SELECT MAX( id ) AS `Max_Id` FROM $this->tablename";
        $result = mysqli_sql($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = $result[0]['Max_Id'];

        return $result + 1;
    }

    public function createList($list_name, $end_date){
        $id = $this->getMaxId('list');
        $this->list_name = $list_name;
        $created_date = date("Y-m-d h:i:s");
        $this->end_date = $end_date;
        $sql = "INSERT INTO list (id, name, created_date, end_date) VALUES ('{$id}','{$list_name}','{$created_date}','{$end_date}')";
        mysqli_sql($this->conn, $sql);
        return $sql;
    }

    public function createListItems($qty,$list_name,$id_product=null, $item_key=null){
        $id = $this->getMaxId('list_items');
        $this->qty = $qty;
        $this->list_name = $list_name;
        $list_name= $this->getListId($list_name);
        $this->id_product = $id_product;
        $this->item_key = $item_key;
        $arg='';
        $arg2='';
        
        if(isset($this->id_product)){
            $arg = 'id_product';
            $arg2 = $id_product;
        }
        if(isset($this->item_key)){
            $arg = 'item_key';
            $arg2 = $item_key;
        }
        $sql = "INSERT INTO list_items (id, quantity, list_id, $arg) VALUES ('{$id}', '{$this->qty}', '{$list_name}','{$arg2}')";
        mysqli_sql($this->conn, $sql);

        return $sql;
    }

    public function addPrivateItem($item_key, $item_name){
        $this->item_key = $item_key;
        $this->item_name = $item_name;

        $sql = "INSERT INTO private_items (item_key, item_name) VALUES ('{$item_key}', '{$item_name}')";
        mysqli_sql($this->conn, $sql);
        return $sql;
    }
    public function updateItem($id, $name, $quantity) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $uniqid = uniqid();
        $sql1 = "INSERT INTO private_items (item_key, item_name) VALUES ('{$uniqid}', '{$name}')";
        $result = mysqli_sql($this->conn, $sql1);
        $sql2 = "UPDATE list_items SET item_key = '$uniqid', quantity = '$this->quantity', id_product = NULL WHERE id = $this->id";
        $result = mysqli_sql($this->conn, $sql2);

        return $sql1.$sql2;
    }
}
?>