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
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        return $this->conn;
    }
    // Wyświetlanie list z bazy danych
    public function getData($tablename="list"){
        $this->tablename = $tablename;
        $sql = "SELECT * FROM $this->tablename";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return json_encode($result);
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
}
?>