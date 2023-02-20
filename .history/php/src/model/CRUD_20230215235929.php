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
    public function getData($tablename){
        $this->tablename = $tablename;
        $query = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return json_encode($result);
    }
    public function getDataOfList($query){
        $this->query = $query;
        $arg = '';
        if(isset($this->query)){
            $arg = "WHERE l.name LIKE '$this->query%' OR l.created_date LIKE '$this->query%'";
        }
        $sql = "SELECT l.name, l.created_date, l.end_date, COALESCE(p.product_name, pi.item_name) AS product_name, li.quantity 
                FROM list l 
                LEFT JOIN list_items li ON l.id = li.list_id 
                LEFT JOIN products p ON li.id_product = p.id_product 
                LEFT JOIN private_items pi ON li.item_key = pi.item_key 
                $arg
                ORDER BY l.name";
        $result = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return json_encode($result);
    }
    public function deleteList($list_id) {
        $this->list_id = $list_id;
        $query = "DELETE FROM list WHERE id = $this->list_id";
        $result = mysqli_query($this->conn, $query);
        $query = "DELETE FROM list_items WHERE list_id = $this->list_id";
        $result = mysqli_query($this->conn, $query);
        return json_encode($result);

    }
    // Wyświetlanie list z bazy danych wraz z wyszukiwaniem
    public function searchData($tablename, $search, $category){
        $this->tablename = $tablename;
        $this->search = $search;
        $this->category = $category;
        if($tablename == 'products'){
            $query = "SELECT * FROM $this->tablename WHERE product_name LIKE '$this->search%'";
            if($category != ''){
                $query .= " AND category_id = $this->category";
            }
        }else{
            $query = "SELECT * FROM $this->tablename WHERE name LIKE '$this->search%'";
            if($category != ''){
                $query .= " AND category_id = $this->category";
            }
        }
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return json_encode($result);
    }
    /*
    public function searchData($tablename="", $search=""){
        $this->tablename = "list";
        $this->search = "{$search}%";
        $query = "SELECT * FROM $this->tablename WHERE name LIKE ?";
        $stmt = $this->conn->prepare($query);
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
        $query = "INSERT INTO products (product_name, product_description, product_image, category_id) 
                    VALUES ('{$product_name}', '{$product_description}', '{$product_image}', '{$category_id}')";

        mysqli_query($this->conn, $query);
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
        $query = "SELECT MAX( id ) AS `Max_Id` FROM $this->tablename";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = $result[0]['Max_Id'];

        return $result + 1;
    }

    public function getIdList($list_name){
        $this->list_name = $list_name;
        $query = "SELECT id FROM list WHERE name = '$this->list_name'";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = $result[0]['id'];

        return $result;
    }

    public function createList($list_name, $end_date){
        $id = $this->getMaxId('list');
        $this->list_name = $list_name;
        $created_date = date("Y-m-d h:i:s");
        $this->end_date = $end_date;
        $query = "INSERT INTO list (id, name, created_date, end_date) VALUES ('{$id}','{$list_name}','{$created_date}','{$end_date}')";
        mysqli_query($this->conn, $query);
        return $query;
    }

    public function createListItems($qty,$list_name,$id_product){
        $id = $this->getMaxId('list_items');
        $this->qty = $qty;
        $this->list_name = $list_name;
        $list_name = $this->getIdList($list_name);
        $this->id_product = $id_product;
        
        $query = "INSERT INTO list_items (id, quantity, list_id, id_product) VALUES ('{$id}', '{$this->qty}', '{$list_name}', '{$this->id_product}')";
        mysqli_query($this->conn, $query);
        return $query;
    }

    public function addPrivateItem($item_key, $item_name, $item_category){
        $this->item_key = $item_key;
        $this->item_name = $item_name;
        $this->item_category = $item_category;

        $query = "INSERT INTO private_items (item_key, item_name, category_id) VALUES ('{$item_key}', '{$item_name}', '{$item_category}')";
        mysqli_query($this->conn, $query);
        return $query;
    }
}
?>