<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Core\View;

class ClienteController
{
    public function create()
    {
        $data = $_POST;
        $cliente = new Cliente();
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha = $data['senha'];
        $cliente->telefone = $data['telefone'];
        $cliente->endereco = $data['endereco'];

        if ($cliente->create()) {
            header('Location: /clientes');
            exit;
        } else {
            echo "Erro ao criar cliente.";
        }
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
        return $cliente->readOne($id);
    }

    public function update($id)
    {
        $data = $_POST;
        $cliente = new Cliente();
        $cliente->id = $id;
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha = $data['senha'];
        $cliente->telefone = $data['telefone'];
        $cliente->endereco = $data['endereco'];

        if ($cliente->update()) {
            header('Location: /clientes');
            exit;
        } else {
            echo "Erro ao atualizar cliente.";
        }
    }

    public function edit($id)
    {
        $cliente = new Cliente();
        $dadosCliente = $cliente->readOne($id);

        if (!$dadosCliente) {
            echo "Cliente não encontrado.";
            return;
        }

        $data = [
            'title' => 'Editar Cliente',
            'cliente' => $dadosCliente
        ];
        View::render('clientes/edit', $data);
    }

    public function delete($id)
    {
        $cliente = new Cliente();
        $cliente->id = $id;

        if ($cliente->delete()) {
            header('Location: /clientes');
            exit;
        } else {
            echo "Erro ao deletar cliente.";
        }
    }

    public function index()
    {
        $clienteModel = new Cliente();
        $clientesLista = $clienteModel->read();
        $data = [
            'title' => 'Clientes',
            'clientes' => $clientesLista
        ];
        View::render('clientes/clientes', $data);
    }

    public function showCreateForm()
    {
        $data = ['title' => 'Novo Cliente'];
        View::render('clientes/create', $data);
    }
}
