<?php 
namespace App\Controllers;
use App\Models\Produto;


class ProdutoController
{
    public function create($data)
    {
        $produto = new Produto();
        $produto->nome = $data['nome'];
        $produto->descricao = $data['descricao'];
        $produto->preco = $data['preco'];
        $produto->quantidade = $data['quantidade'];
        $produto->categoria = $data['categoria'];

        return $produto->create();
    }

    public function read()
    {
        $produto = new Produto();
        return $produto->read();
    }

    public function readOne($id)
    {
        $produto = new Produto();
        $produto->id = $id;
        return $produto->readOne();
    }

    public function update($id, $data)
    {
        $produto = new Produto();
        $produto->id = $id;
        $produto->nome = $data['nome'];
        $produto->descricao = $data['descricao'];
        $produto->preco = $data['preco'];
        $produto->quantidade = $data['quantidade'];
        $produto->categoria = $data['categoria'];

        return $produto->update();
    }

    public function delete($id)
    {
        $produto = new Produto();
        $produto->id = $id;
        return $produto->delete();
    }
}
