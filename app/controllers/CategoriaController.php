<?php
namespace App\Controllers;
use App\Models\Categoria;

class CategoriaController{
    public function index()
{
    $categoriaModel = new Categoria();
    $categorias = $categoriaModel->getAll();

    header('Content-Type: application/json');
    echo json_encode($categorias);
}
} 
