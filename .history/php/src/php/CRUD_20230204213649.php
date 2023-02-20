<?php
class db{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $conn;

    public function __construct($host="db", $tablename="", $servername="localhost", 
                                $username="MYSQL_USER", $password="MYSQL_PASSWORD"){
        $this->host = $host;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // Tworzenie połączenia
        $this->conn = new mysqli($host, $username, $password);

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