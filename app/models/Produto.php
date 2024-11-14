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
    public $categoria;
    public $data_adicionado;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (nome, descricao, preco, quantidade, categoria, data_adicionado) VALUES (?, ?, ?, ?, ?, ?)";
        $this->data_adicionado= date('Y-m-d H:i:s'); //pra prencher com a data/hora atual.
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiss", $this->nome, $this->descricao, $this->preco, $this->quantidade, $this->categoria, $this->data_adicionado);

        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table;
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
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
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
        $query = "UPDATE " . $this->table . " SET nome = ?, descricao = ?, preco = ?, quantidade = ?, categoria = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiss", $this->nome, $this->descricao, $this->preco, $this->quantidade, $this->categoria, $this->id);

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
