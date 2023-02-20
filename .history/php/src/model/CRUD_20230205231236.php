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
    public function createProduct($Data){
        $product_name = $this->product_name;
        $product_description = $this->product_description;
        $product_image = $this->product_image;
        $category_id = $this->category_id;
        
        $stmt = $this->conn->prepare('INSERT INTO products (product_name, product_description, product_image, category_id) VALUES (?, ?, ?, ?)');
        $stmt->bindParam(1, $product_name);
        $stmt->bindParam(2, $product_description);
        $stmt->bindParam(3, $product_image);
        $stmt->bindParam(4, $category_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function test($Data){
        $this->Data = $Data;
        return $Data;
    }
}
?>