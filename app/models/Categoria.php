<?php
namespace App\Models;

use App\Config\DatabaseConnection;

class Categoria
{
    private $conn;
    private $table = 'categorias';
    public $nome;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        $categorias = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $categorias[] = $row;
            }
        }
        
        return $categorias;
    }

    public function create($nome)
    {
        $query = "INSERT INTO " . $this->table . " (nome) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nome);
        $stmt->execute();

        return $stmt->insert_id;
    }
}
