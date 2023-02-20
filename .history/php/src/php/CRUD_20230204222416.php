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
        $query = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->conn, $query) or die("Problemy z odczytem danych!");
        $ile = mysqli_num_rows($result);
        while($row = mysqli_fetch_row($result))
{
    echo $row[1]."<br>";
    // wartość $row[1] wypisze nazwę klasy, 
    // gdyby było $row[0] to wypisalibyśmy jej id
}
    }
}
?>