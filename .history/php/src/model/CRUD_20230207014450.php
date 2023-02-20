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
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    // Wyświetlanie list z bazy danych wraz z wyszukiwaniem
    public function searchData($tablename, $search){
        $this->tablename = $tablename;
        $this->search = $search;
        $query = "SELECT * FROM $this->tablename WHERE name LIKE '$this->search%'";
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
    public function getMaxId(){
        $query = "SELECT MAX( id ) AS `Max_Id` FROM list";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result = $result[0]['Max_Id'];

        return $result + 1;
    }
    public function createList($list_name, $end_date){
        $id = $this->getMaxId();
        $this->list_name = $list_name;
        $created_date = date("Y-m-d h:i:s");
        $this->end_date = $end_date;
        $query = "INSERT INTO list (id, name, created_date, end_date) VALUES ('{$id}','{$list_name}','{$created_date}','{$end_date}')";
        return $created_date;
    }
}
?>CURRENT_TIMESTAMP