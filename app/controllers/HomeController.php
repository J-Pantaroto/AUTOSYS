<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Produto;
class HomeController
{
    public function index()
    {
        $produtoModel = new Produto();
        $produtos = $produtoModel->read();
        $data = [
            'title' => 'AutoSys',
            'produtos' => $produtos,
        ];
        View::render('home', $data);
    }
}
