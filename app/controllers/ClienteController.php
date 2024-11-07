<?php
namespace App\Controllers;
use App\Models\Cliente;

class ClienteController
{
    public function create($data)
    {
        $cliente = new Cliente();
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha = $data['senha'];
        $cliente->telefone = $data['telefone'];
        $cliente->endereco = $data['endereco'];

        return $cliente->create();
    }

    public function read()
    {
        $cliente = new Cliente();
        return $cliente->read();
    }

    public function readOne($id)
    {
        $cliente = new Cliente();
        $cliente->id = $id;
        return $cliente->readOne();
    }

    public function update($id, $data)
    {
        $cliente = new Cliente();
        $cliente->id = $id;
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha = $data['senha'];
        $cliente->telefone = $data['telefone'];
        $cliente->endereco = $data['endereco'];

        return $cliente->update();
    }

    public function delete($id)
    {
        $cliente = new Cliente();
        $cliente->id = $id;
        return $cliente->delete();
    }
      public function index()
    {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->read();
        
        $title = 'Lista de Clientes';
        require __DIR__ . '/../../views/Clientes.php';

        include('/xampp/htdocs/AutoSys/layouts/main.layout.php');
    }

}
