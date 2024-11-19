<?php
namespace App\Core;

class View
{
    public static function render($viewPath, $data = [])
    {
        extract($data); 
 
        if ($viewPath === 'login' || $viewPath === 'register') {
            $fullPath = __DIR__ . "/../../views/{$viewPath}.php";
            if (file_exists($fullPath)) {
                include $fullPath;
            } else {
                echo "Erro ao carregar a view {$viewPath}.";
            }
        } else {
            include __DIR__ . "/../../views/layouts/header.php";

            $fullPath = __DIR__ . "/../../views/{$viewPath}.php";
            if (file_exists($fullPath)) {
                include $fullPath;
            } else {
                echo "Erro ao carregar a view {$viewPath}.";
            }
            include __DIR__ . "/../../views/layouts/footer.php";
        }
    }
}
