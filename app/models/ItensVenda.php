<?php
namespace App\Models;

use App\Config\DatabaseConnection;

class ItensVenda
{
    private $conn;
    private $table = 'itensvenda';

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (venda_id, produto_id, quantidade, subtotal) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("iiid", $data['venda_id'], $data['produto_id'], $data['quantidade'], $data['subtotal']);

        return $stmt->execute();
    }
}
