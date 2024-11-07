<?php
namespace App\Models;
use App\Config\Database;

class Cliente
{
    private $conn;
    private $table = 'clientes';
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;
    public $endereco;
    public $data_cadastro;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (nome, email, senha, telefone, endereco, data_cadastro) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $this->data_cadastro = date('Y-m-d H:i:s'); //pra prencher com a data/hora atual.
        $stmt->bind_param("ssssss", $this->nome, $this->email, $this->senha, $this->telefone, $this->endereco, $this->data_cadastro);

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
        $query = "UPDATE " . $this->table . " SET nome = ?, email = ?, senha = ?, telefone = ?, endereco = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->nome, $this->email, $this->senha, $this->telefone, $this->endereco, $this->id);

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
