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
        $this->add("GET", "/produtos/json", "ProdutoController", "json");
        $this->add("GET", "/vendas/json", "VendaController", "json");
        $this->add("GET", "/clientes/json", "ClienteController", "json");
        $this->add("GET", "/vendas", "VendaController", "index");
        $this->add("GET", "/vendas/create", "VendaController", "showCreateForm");
        $this->add("GET", "/produtos/create", "ProdutoController", "showCreateForm");
        $this->add("GET", "/clientes/create", "ClienteController", "showCreateForm");
        $this->add("GET", "/clientes/edit/{id}", "ClienteController", "showEditForm");
        $this->add("GET", "/produtos/edit/{id}", "ProdutoController", "showEditForm");
        $this->add("GET", "/vendas/edit{id}", "VendaController", "showEditForm");
        $this->add("GET", "/login", "AuthController", "indexLogin");
        $this->add("GET", "/register", "AuthController", "indexRegister");
        $this->add("GET", "/categorias", "CategoriaController", "index");
        $this->add("GET", "/cart", "CartController", "getCart");
        $this->add("GET", "/dashboard", "VendaController", "dashboard");
        
        // Definindo as rotas POST

        $this->add("POST", "/checkout", "VendaController", "checkout");
        $this->add("POST", "/logout", "AuthController", "logout");
        $this->add("POST", "/cart/add", "CartController", "addToCart");
        $this->add("POST", "/cart/remove", "CartController", "removeFromCart");
        $this->add("POST", "/cart/clear", "CartController", "clearCart");
        $this->add("POST", "/cart/checkout", "VendaController", "checkout");
        $this->add("POST", "/register", "AuthController", "register");
        $this->add("POST", "/login", "AuthController", "login");
        $this->add("POST", "/clientes/update/{id}", "ClienteController", "update");
        $this->add("POST", "/clientes/delete/{id}", "ClienteController", "delete");
        $this->add("POST", "/clientes/store", "ClienteController", "create");
        $this->add("POST", "/produtos/store", "ProdutoController", "create");
        $this->add("POST", "/produtos/update/{id}", "ProdutoController", "update");
        $this->add("POST", "/produtos/delete/{id}", "ProdutoController", "delete");
        $this->add("POST", "/vendas/store", "VendaController", "create");
        $this->add("POST", "/vendas/update/{id}", "VendaController", "update");
        $this->add("POST", "/vendas/delete/{id}", "VendaController", "delete");
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
        View::render('404', $data);
    }
}
