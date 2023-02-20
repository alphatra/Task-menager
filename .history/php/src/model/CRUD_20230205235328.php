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
    public function getData($tablename="list"){
        $this->tablename = $tablename;
        $sql = "SELECT * FROM $this->tablename";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    // Wyświetlanie list z bazy danych wraz z wyszukiwaniem
    public function searchData($tablename="", $search=""){
        $this->tablename = "list";
        $this->search = $search;
        $sql = "SELECT * FROM $this->tablename WHERE name LIKE '$this->search%'";
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
                    VALUES ('{$product_name}', '{$product_description}', '{$product_image}', '{$category_id}}')";
        $result = mysqli_sql($this->conn, $sql);
        $stmt
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
}
?>