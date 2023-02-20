<?php
class db{
    public $servername;
    public $username;
    public $password;
    public $database;
    public $tablename;
    public $conn;

    public function __construct($host="db", $database="mydb", 
                                $username="root", $password="root"){
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

        // Tworzenie połączenia
        $this->conn = new mysqli($host, $username, $password, $database);

        // Sprawdzanie połączenia
        if (!$this->conn){
            die("Connection failed: " . mysqli_connect_error());
        }
    }
        // Wyświetlanie list z bazy danych
    public function getData($tablename="list"){
        $this->tablename = $tablename;
        $query = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return json_encode($result);
    }
    public function searchData($tablename="list", $search="Z"){
        $this->tablename = $tablename;
        $this->search = $search;
        $query = "SELECT * FROM $this->tablename WHERE name LIKE '$this->$search%'";
        $result = mysqli_query($this->conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return json_encode($result);
    }
}
?>