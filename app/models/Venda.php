<?php 
namespace App\Models;
use App\Config\DatabaseConnection;

class Venda
{
    private $conn;
    private $table = 'vendas';
    public $id;
    public $cliente_id;
    public $data_venda;
    public $total;
    public $status;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (cliente_id, data_venda, total, status) VALUES (?, ?, ?, ?)";
        $this->data_venda= date('Y-m-d H:i:s'); //pra prencher com a data/hora atual.
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isds", $this->cliente_id, $this->data_venda, $this->total, $this->status);

        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        return $result;
    }

    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET cliente_id = ?, data_venda = ?, total = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isdsi", $this->cliente_id, $this->data_venda, $this->total, $this->status, $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);

        return $stmt->execute();
    }
}
