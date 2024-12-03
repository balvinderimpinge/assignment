<?php
error_reporting(E_ALL & E_WARNING & E_NOTICE);
ini_set('display_errors', 1); // Enable error display during development

class Database {
    private $host = 'db'; // Use the Docker service name
    private $db_name = 'mydatabase';
    private $username = 'root';
    private $password = 'rootpassword';
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
