<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'gestion_personas';
    private $username = 'tigerone';
    private $password = 'JxnQeSZhqzWjfY4L';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>