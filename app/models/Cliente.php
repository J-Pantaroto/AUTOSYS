<?php
namespace App\Models;
use App\Config\DatabaseConnection;

class Cliente
{
    private $conn;
    private $table = 'clientes';
    public $id;
    public $nome;
    public $email;
    public $senha_hash;
    public $telefone;
    public $endereco;
    public $is_admin;

    public function __construct()
    {
        
        $this->conn = DatabaseConnection::getConnection();
    }

    public function create()
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nome, email, senha_hash, telefone, endereco, is_admin) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $this->nome, $this->email, $this->senha_hash, $this->telefone, $this->endereco, $this->is_admin);
        return $stmt->execute();
    }
    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function read()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        $clientes = [];
        if($result){
            while ($row = $result->fetch_assoc()){
                $clientes[] = $row;
            }
        }
        return $clientes;
    }
    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result(); 
        return $result->fetch_assoc();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET nome = ?, email = ?, senha = ?, telefone = ?, endereco = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->nome, $this->email, $this->senha_hash, $this->telefone, $this->endereco, $this->id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
