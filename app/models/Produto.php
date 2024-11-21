<?php
namespace App\Models;
use App\Config\DatabaseConnection;

class Produto
{
    private $conn;
    private $table = 'produtos';
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;
    public $categoria_id;
    public $data_adicionado;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (nome, descricao, preco, quantidade, categoria_id, data_adicionado) VALUES (?, ?, ?, ?, ?, ?)";
        $this->data_adicionado= date('Y-m-d H:i:s'); //pra prencher com a data/hora atual.
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiss", $this->nome, $this->descricao, $this->preco, $this->quantidade, $this->categoria_id, $this->data_adicionado);

        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT p.*, c.descricao AS categoria FROM " . $this->table . " p 
        LEFT JOIN categorias c ON p.categoria_id = c.id";
        $result = $this->conn->query($query);
        $produtos = [];
        if($result){
            while ($row = $result->fetch_assoc()){
                $produtos[] = $row;
            }
        }
        return $produtos;
    }

    public function readOne($id)
    {
        $query = "SELECT p.*, c.descricao AS categoria FROM " . $this->table . " p 
                  LEFT JOIN categorias c ON p.categoria_id = c.id 
                  WHERE p.id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET nome = ?, descricao = ?, preco = ?, quantidade = ?, categoria_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiss", $this->nome, $this->descricao, $this->preco, $this->quantidade, $this->categoria_id, $this->id);

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
