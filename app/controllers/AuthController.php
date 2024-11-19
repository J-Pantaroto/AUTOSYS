<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Core\View;
class AuthController
{
    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar dados
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            http_response_code(400);
            echo json_encode(["error" => "Por favor, preencha todos os campos obrigatórios."]);
            return;
        }

        $senhaHash = password_hash($data['senha'], PASSWORD_BCRYPT);

        $cliente = new Cliente();
        $cliente->nome = $data['nome'];
        $cliente->email = $data['email'];
        $cliente->senha_hash = $senhaHash;
        $cliente->is_admin = $data['is_admin'] ?? 0;

        if ($cliente->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Usuário registrado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao registrar usuário."]);
        }
    }

    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar dados
        if (empty($data['email']) || empty($data['senha'])) {
            http_response_code(400);
            echo json_encode(["error" => "Por favor, forneça email e senha."]);
            return;
        }

        $cliente = new Cliente();
        $clienteData = $cliente->findByEmail($data['email']);

        if (!$clienteData || !password_verify($data['senha'], $clienteData['senha_hash'])) {
            http_response_code(401);
            echo json_encode(["error" => "Credenciais inválidas."]);
            return;
        }

        echo json_encode([
            "message" => "Login realizado com sucesso.",
            "user" => [
                "id" => $clienteData['id'],
                "nome" => $clienteData['nome'],
                "email" => $clienteData['email'],
                "is_admin" => $clienteData['is_admin']
            ]
        ]);
    }
    public function indexLogin(){
        View::render('login');
    }
    public function indexRegister(){
        $data[] = '';
        View::render('register',$data);
    }
}
