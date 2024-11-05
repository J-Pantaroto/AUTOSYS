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
                throw new Exception("O controller {$controller} não existe!");
            }
            $controllerInstance = new $controllerNameSpace();
            if (!method_exists($controllerInstance, $method)) {
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
                "/home" => fn() => self::loadController("HomeController", "index"),
                "" => fn() => self::loadController("HomeController", "index"),
            ],
            "POST" => [
                "/contact" => fn() => self::loadController("ContactController", "store"),
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
                
                echo("teste2");
                throw new Exception("A rota não existe");
            }
    
            $routeHandler = $routes[$requestMethod][$uri];
            if (!is_callable($routeHandler)) {
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
            throw new Exception("O controller {$controller} não existe!");
        }

        $controllerInstance = new $controllerNamespace();
        if (!method_exists($controllerInstance, $method)) {
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
            throw new Exception("A view {$view} não foi encontrada!");
        }
    }
}
