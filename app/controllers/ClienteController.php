<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Core\View;

class ClienteController
{
    public function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Verificar se o usuário está logado e se é administrador
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            http_response_code(403);
            echo json_encode(["error" => "Acesso negado."]);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        // Validações avançadas
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha']) || empty($data['telefone']) || empty($data['endereco'])) {
            http_response_code(400);
            echo json_encode(["error" => "Por favor, preencha todos os campos obrigatórios."]);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["error" => "O email fornecido é inválido."]);
            return;
        }

        // Criar cliente
        $cliente = new Cliente();
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha_hash = password_hash($data['senha'], PASSWORD_BCRYPT);
        $cliente->telefone = $data['telefone'];
        $cliente->endereco = $data['endereco'];

        if ($cliente->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Cliente criado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar cliente."]);
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

        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nome']) || empty($data['email']) || empty($data['senha']) || empty($data['telefone']) || empty($data['endereco'])) {
            http_response_code(400);
            echo json_encode(["error" => "Por favor, preencha todos os campos obrigatórios."]);
            return;
        }

        $data = $_POST;
        $cliente = new Cliente();
        $cliente->id = $id;
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha_hash = $data['senha'];
        $cliente->telefone = $data['telefone'];
        $cliente->endereco = $data['endereco'];

        if ($cliente->update()) {
            echo json_encode(["message" => "Cliente atualizado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar o cliente."]);
        }
    }
    public function delete($id)
    {
        $cliente = new Cliente();
        $cliente->id = $id;

        if ($cliente->delete($id)) {
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

    public function json()
    {
        $clienteModel = new Cliente();
        $clientesLista = $clienteModel->read();

        header('Content-Type: application/json');
        echo json_encode($clientesLista);
    }
    public function showCreateForm()
    {
        $data = ['title' => 'Novo Cliente'];
        View::render('clientes/create', $data);
    }

    public function showEditForm($id)
    {
        $clienteModel = new Cliente();
        $clienteData = $clienteModel->readOne($id);

        if (!$clienteData) {
            http_response_code(404);
            echo "Cliente não encontrado.";
            return;
        }
        $data = [
            'title' => 'Editar Cliente',
            'cliente' => $clienteData
        ];

        View::render('clientes/edit', $data);
    }
}
