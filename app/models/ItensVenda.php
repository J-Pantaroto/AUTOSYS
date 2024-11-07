<?php 
namespace App\Models;
use App\Config\Database;
class ItensVenda
{
    private $conn;
    private $table = 'itens_venda';
    public $id;
    public $venda_id;
    public $produto_id;
    public $quantidade;
    public $preco_unitario;
    public $subtotal;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (venda_id, produto_id, quantidade, preco_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiidd", $this->venda_id, $this->produto_id, $this->quantidade, $this->preco_unitario, $this->subtotal);

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
        $query = "UPDATE " . $this->table . " SET venda_id = ?, produto_id = ?, quantidade = ?, preco_unitario = ?, subtotal = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiiddi", $this->venda_id, $this->produto_id, $this->quantidade, $this->preco_unitario, $this->subtotal, $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);

        return $stmt->execute();
    }
    public function getItensByVendaId($venda_id)
    {
        $query = "SELECT * FROM itens_venda WHERE venda_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $venda_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $itens = [];
        while ($row = $result->fetch_assoc()) {
            $itens[] = $row;
        }
        return $itens;
    }
    public function deleteByVendaId($venda_id)
    {
        $query = "DELETE FROM itens_venda WHERE venda_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $venda_id);

        return $stmt->execute();
    }
}
