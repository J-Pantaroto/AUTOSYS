<?php

namespace App\Routes;

use App\Helpers\Uri;
use App\Helpers\Request;
use Exception;

class Router
{
    const CONTROLLER_NAMESPACE = 'App\\Controllers';
    public static function load(string $controller, string $method)
    {
        try {
            $controllerNameSpace = self::CONTROLLER_NAMESPACE . '\\' . $controller;
            if (!class_exists($controllerNameSpace)) {
                echo ('teste0');
                throw new Exception("O controller {$controller} não existe!");
            }
            $controllerInstance = new $controllerNameSpace();
            if (!method_exists($controllerInstance, $method)) {
                echo ('teste1');
                throw new Exception("O metodo {$method} não existe no {$controller} !");
            }
            $controllerInstance->$method();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public static function routes(): array
    {
        return [
            "GET" => [
                "/" => fn() => self::loadController("HomeController", "index"),
                "home" => fn() => self::loadController("HomeController", "index"),
                "" => fn() => self::loadController("HomeController", "index"),
                "/clientes" => fn() => self::loadController("ClienteController", "index"),           // Lista clientes
                "/clientes/create" => fn() => self::loadController("ClienteController", "create"),   // Formulário de criação de cliente
                "/clientes/edit" => fn() => self::loadController("ClienteController", "edit"),       // Formulário de edição de cliente
                "/produtos" => fn() => self::loadController("ProdutoController", "index"),           // Lista produtos
                "/produtos/create" => fn() => self::loadController("ProdutoController", "create"),   // Formulário de criação de produto
                "/produtos/edit" => fn() => self::loadController("ProdutoController", "edit"),       // Formulário de edição de produto
                "/vendas" => fn() => self::loadController("VendaController", "index"),               // Lista vendas
                "/vendas/create" => fn() => self::loadController("VendaController", "create"),       // Formulário de criação de venda
                "/vendas/edit" => fn() => self::loadController("VendaController", "edit"),           // Formulário de edição de venda
            ],
            "POST" => [
                "/clientes/store" => fn() => self::loadController("ClienteController", "store"),     // Salvar cliente
                "/clientes/update" => fn() => self::loadController("ClienteController", "update"),   // Atualizar cliente
                "/clientes/delete" => fn() => self::loadController("ClienteController", "delete"),   // Excluir cliente
                "/produtos/store" => fn() => self::loadController("ProdutoController", "store"),     // Salvar produto
                "/produtos/update" => fn() => self::loadController("ProdutoController", "update"),   // Atualizar produto
                "/produtos/delete" => fn() => self::loadController("ProdutoController", "delete"),   // Excluir produto
                "/vendas/store" => fn() => self::loadController("VendaController", "store"),         // Salvar venda
                "/vendas/update" => fn() => self::loadController("VendaController", "update"),       // Atualizar venda
                "/vendas/delete" => fn() => self::loadController("VendaController", "delete"),       // Excluir venda
            ],
        ];
    }

    public static function execute()
    {
        try {
            $routes = self::routes();
            $requestMethod = Request::get();
            $uri = Uri::get('path');

            $prefix = '/AutoSys';
            if (strpos($uri, $prefix) === 0) {
                $uri = substr($uri, strlen($prefix));
            }

            if (!isset($routes[$requestMethod]) || !array_key_exists($uri, $routes[$requestMethod])) {

                echo ("teste3");
                throw new Exception("A rota não existe");
            }

            $routeHandler = $routes[$requestMethod][$uri];
            if (!is_callable($routeHandler)) {
                echo ('teste4');
                throw new Exception("A rota: {$uri} não foi definida como function!");
            }
            $routeHandler();
        } catch (Exception $e) {
            self::view("404");
        }
    }

    private static function loadController(string $controller, string $method)
    {
        $controllerNamespace = 'App\\Controllers\\' . $controller;
        if (!class_exists($controllerNamespace)) {
            echo ('teste5');
            throw new Exception("O controller {$controller} não existe!");
        }

        $controllerInstance = new $controllerNamespace();
        if (!method_exists($controllerInstance, $method)) {
            echo ('teste6');
            throw new Exception("O método {$method} não existe no {$controller}!");
        }

        $controllerInstance->$method();
    }

    private static function view(string $view)
    {
        $viewPath = __DIR__ . "/../views/{$view}.php";
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo ('teste7');
            throw new Exception("A view {$view} não foi encontrada!");
        }
    }
}
