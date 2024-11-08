<?php
namespace App\Config;
use Exception;
/* function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception("Arquivo .env não encontrado.");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        $_ENV[$key] = $value;
    }
} */

//loadEnv(__DIR__ . '/../../.env');
print_r($_ENV);
class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset;
    public $conn;

    /*     public function __construct()
        {
            $this->host = $_ENV['DB_HOST'];
            $this->db_name = $_ENV['DB_NAME'];
            $this->username = $_ENV['DB_USER'];
            $this->password = $_ENV['DB_PASSWORD'];
            $this->charset = $_ENV['DB_CHARSET'];
        } */

    public function __construct()
    {
        $this->host = "localhost";
        $this->db_name = "autopecas_db";
        $this->username = "root";
        $this->password = "";
        $this->charset = "utf8";
    }
    public function getConnection()
    {
        try {
            $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name);

            if ($this->conn->connect_error) {
                throw new Exception("Erro de conexão: " . $this->conn->connect_error);
            }

            $this->conn->set_charset($this->charset);
            return $this->conn;
        } catch (Exception $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }


}