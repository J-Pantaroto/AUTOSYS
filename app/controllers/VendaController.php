<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Venda;
use App\Models\ItensVenda;
use App\Models\Produto;

class VendaController
{
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Usuário não autenticado.']);
            return;
        }

        $userId = $_SESSION['user']['id'];
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            http_response_code(400);
            echo json_encode(['error' => 'Carrinho vazio.']);
            return;
        }

        $produtoModel = new Produto();
        $vendaModel = new Venda();
        $itensVendaModel = new ItensVenda();

        $total = 0;
        $itensVenda = [];

        foreach ($cart as $productId => $quantity) {
            $produto = $produtoModel->readOne($productId);
            if (!$produto) {
                http_response_code(400);
                echo json_encode(['error' => "Produto ID {$productId} não encontrado."]);
                return;
            }

            $subtotal = $produto['preco'] * $quantity;
            $total += $subtotal;

            $itensVenda[] = [
                'produto_id' => $productId,
                'quantidade' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        $vendaId = $vendaModel->create([
            'cliente_id' => $userId,
            'data_venda' => date('Y-m-d H:i:s'),
            'valor_total' => $total,
        ]);

        if (!$vendaId) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar a venda.']);
            return;
        }

        foreach ($itensVenda as $item) {
            $item['venda_id'] = $vendaId;
            $itensVendaModel->create($item);
        }

        unset($_SESSION['cart']);

        echo json_encode(['success' => 'Compra realizada com sucesso!']);
    }
    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $user = $_SESSION['user'];
        $vendaModel = new Venda();

        $vendas = $vendaModel->getVendasByClienteId($user['id']);
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'vendas' => $vendas
        ];

        View::render('/dashboard', $data);
    }
}
