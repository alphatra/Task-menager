<?php
class db{
    public $servername;
    public $username;
    public $password;
    public $database;
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
        $sql = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->conn, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}
?>