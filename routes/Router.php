<?php

namespace App\Routes;

use App\Core\Request;
use Exception;
use App\Core\View;

class Router
{
    private $routes = [];

    public function __construct()
    {
        // Definindo as rotas GET
        $this->add("GET", "/", "HomeController", "index");
        $this->add("GET", "/home", "HomeController", "index");
        $this->add("GET", "/clientes", "ClienteController", "index");
        $this->add("GET", "/produtos", "ProdutoController", "index");
        $this->add("GET", "/vendas", "VendaController", "index");
        $this->add("GET", "/vendas/create", "VendaController", "showCreateForm");
        $this->add("GET", "/produtos/create", "ProdutoController", "showCreateForm");
        $this->add("GET", "/clientes/create", "ClienteController", "showCreateForm");
        $this->add("GET", "/clientes/edit/{id}", "ClienteController", "edit");
        $this->add("GET", "/produtos/edit/{id}", "ProdutoController", "edit");
        $this->add("GET", "/vendas/edit{id}", "VendaController", "edit");


        // Definindo as rotas POST
        $this->add("POST", "/clientes/update/{id}", "ClienteController", "update");
        $this->add("POST", "/clientes/delete", "ClienteController", "delete");
        $this->add("POST", "/clientes/store", "ClienteController", "create");
        $this->add("POST", "/produtos/store", "ProdutoController", "create");
        $this->add("POST", "/produtos/update/{id}", "ProdutoController", "update");
        $this->add("POST", "/produtos/delete", "ProdutoController", "delete");
        $this->add("POST", "/vendas/store", "VendaController", "store");
        $this->add("POST", "/vendas/update/{id}", "VendaController", "update");
        $this->add("POST", "/vendas/delete", "VendaController", "delete");
    }
    public function add($method, $path, $controller, $action)
    {
        $this->routes[] = compact('method', 'path', 'controller', 'action');
    }

    public function dispatch(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $request->getMethod() && preg_match($this->convertToRegex($route['path']), $request->getUri(), $matches)) {
                return $this->callController($route['controller'], $route['action'], array_slice($matches, 1));
            }
        }
        return $this->notFound();
    }

    private function callController($controller, $action, $params)
    {
        $controllerClass = "App\\Controllers\\{$controller}";

        if (!class_exists($controllerClass) || !method_exists($controllerClass, $action)) {
            return $this->notFound();
        }

        $controllerInstance = new $controllerClass();
        return call_user_func_array([$controllerInstance, $action], $params);
    }

    private function convertToRegex($path)
    {
        return "@^" . preg_replace('/\{[a-zA-Z]+\}/', '([^/]+)', $path) . "$@";
    }

    private function notFound()
    {
        http_response_code(404);
        $data = ['title' => 'Página não encontrada'];
        View::render('home/index', $data);
    }
}
