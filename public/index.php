<?php
require_once __DIR__ . '/../vendor/autoload.php';


use App\Config\EnvLoader;
use App\Routes\Router;
use App\Core\Request;
EnvLoader::load(__DIR__ . '/../app/config/.env');
require_once __DIR__ . '/../app/config/script.php';

$router = new Router();
$request = new Request();

// Chama o roteador para despachar a requisição
$router->dispatch($request);