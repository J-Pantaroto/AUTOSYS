<?php

namespace App\Controllers;

class CartController
{
    public function addToCart()
    {

        session_start();

        if (!isset($_SESSION['user'])) {
            echo json_encode([
                "error" => true,
                "message" => "Você precisa estar logado para adicionar produtos ao carrinho.",
                "redirect" => "/login" // URL para redirecionamento
            ]);
            http_response_code(401);
            return;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $productId = $data['id'] ?? null;

        if (!$productId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do produto é obrigatório.']);
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 1;
        } else {
            $_SESSION['cart'][$productId]++;
        }

        echo json_encode(['success' => 'Produto adicionado ao carrinho.']);
    }

    public function removeFromCart()
    {
        session_start();

        $data = json_decode(file_get_contents('php://input'), true);
        $productId = $data['id'] ?? null;

        if (!$productId || !isset($_SESSION['cart'][$productId])) {
            http_response_code(400);
            echo json_encode(['error' => 'Produto não encontrado no carrinho.']);
            return;
        }

        unset($_SESSION['cart'][$productId]);
        echo json_encode(['success' => 'Produto removido do carrinho.']);
    }

    public function getCart()
    {
        session_start();

        $cart = $_SESSION['cart'] ?? [];
        echo json_encode(['cart' => $cart]);
    }

    public function clearCart()
    {
        session_start();

        $_SESSION['cart'] = [];
        echo json_encode(['success' => 'Carrinho limpo com sucesso.']);
    }
}
