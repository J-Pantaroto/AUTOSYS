<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Routes\Router;
use App\Core\Request;

$router = new Router();
$request = new Request();

// Chama o roteador para despachar a requisição
$router->dispatch($request);