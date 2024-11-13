<?php
namespace App\Controllers;
use App\Core\View;
class HomeController
{
    public function index()
    {
        $data = [
            'title' => 'Página Inicial',
            'content' => 'Bem-vindo à página inicial!'
        ];
        View::render('home', $data);
    }
}
