<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Core\View;

class ProdutoController
{
    // Função para criar um produto (POST)
    public function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
            http_response_code(403);
            echo json_encode(["error" => "Acesso negado."]);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['nome']) || !isset($data['descricao']) || !isset($data['preco']) || !isset($data['quantidade']) || (!isset($data['categoria_id']) && !isset($data['nova_categoria_nome']))) {
            http_response_code(400);
            echo json_encode(["error" => "Por favor, preencha todos os campos obrigatórios."]);
            return;
        }

        if (!empty($data['nova_categoria_nome'])) {
            $categoriaModel = new Categoria();
            $novaCategoriaId = $categoriaModel->create($data['nova_categoria_nome']);

            if (!$novaCategoriaId) {
                http_response_code(500);
                echo json_encode(["error" => "Erro ao criar nova categoria."]);
                return;
            }

            $data['categoria_id'] = $novaCategoriaId;
        }

        $produto = new Produto();
        $produto->nome = $data['nome'];
        $produto->descricao = $data['descricao'];
        $produto->preco = $data['preco'];
        $produto->quantidade = $data['quantidade'];
        $produto->categoria_id = $data['categoria_id'];

        if ($produto->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Produto criado com sucesso!"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao criar produto."]);
        }
    }


    // Função para listar todos os produtos (GET)
    public function read()
    {
        $produto = new Produto();
        $produtos = $produto->read();

        header('Content-Type: application/json');
        echo json_encode($produtos);
    }

    // Função para obter um único produto (GET)
    public function readOne($id)
    {
        $produto = new Produto();
        $produtoData = $produto->readOne($id);

        if ($produtoData) {
            header('Content-Type: application/json');
            echo json_encode($produtoData);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Produto não encontrado."]);
        }
    }

    // Função para atualizar um produto (POST)
    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['nome']) || empty($data['descricao']) || empty($data['preco']) || empty($data['quantidade']) || empty($data['categoria'])) {
            http_response_code(400);
            echo json_encode(["error" => "Por favor, preencha todos os campos obrigatórios."]);
            return;
        }

        $produto = new Produto();
        $produto->id = $id;
        $produto->nome = $data['nome'];
        $produto->descricao = $data['descricao'];
        $produto->preco = $data['preco'];
        $produto->quantidade = $data['quantidade'];
        $produto->categoria_id = $data['categoria'];

        if ($produto->update()) {
            echo json_encode(["message" => "Produto atualizado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar o produto."]);
        }
    }

    // Função para deletar um produto (POST)
    public function delete($id)
    {
        $produto = new Produto();
        $produto->id = $id;

        if ($produto->delete($id)) {
            echo json_encode(["message" => "Produto excluído com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir o produto."]);
        }
    }

    public function index()
    {
        $produtoModel = new Produto();
        $produtosLista = $produtoModel->read();
        $data = [
            'title' => 'Produtos',
            'produtos' => $produtosLista
        ];
        View::render('produtos/produtos', $data);
    }

    public function json()
    {
        $produtoModel = new Produto();
        $produtosLista = $produtoModel->read();

        header('Content-Type: application/json');
        echo json_encode($produtosLista);
    }

    public function showCreateForm()
    {
        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->getAll();

        $data = [
            'title' => 'Novo Produto',
            'categorias' => $categorias
        ];

        View::render('produtos/create', $data);
    }
    public function showEditForm($id)
    {
        $produtoModel = new Produto();
        $produtoData = $produtoModel->readOne($id);

        if (!$produtoData) {
            http_response_code(404);
            echo "Produto não encontrado.";
            return;
        }

        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->getAll();

        $data = [
            'title' => 'Editar Produto',
            'produto' => $produtoData,
            'categorias' => $categorias
        ];

        View::render('produtos/edit', $data);
    }
}
