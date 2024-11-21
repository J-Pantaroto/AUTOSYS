<?php
namespace App\Models;

use App\Config\DatabaseConnection;

class Venda
{
    private $conn;
    private $table = 'vendas';

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function create($data)
    {
        $query = "INSERT INTO {$this->table} (cliente_id, data_venda, valor_total) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("iss", $data['cliente_id'], $data['data_venda'], $data['valor_total']);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }
    public function getVendasByClienteId($clienteId)
{
    $query = "SELECT * FROM {$this->table} WHERE cliente_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $clienteId);
    $stmt->execute();
    $result = $stmt->get_result();

    $vendas = [];
    while ($row = $result->fetch_assoc()) {
        $vendas[] = $row;
    }

    return $vendas;
}
}
