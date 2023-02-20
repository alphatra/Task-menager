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
        $sql = "SELECT * FROM $this->tablename WHERE name LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("search", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }
}
?>