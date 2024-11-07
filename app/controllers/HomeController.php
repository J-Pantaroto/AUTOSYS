<?php

namespace App\Controllers;
use App\Controllers\ClienteController;
class HomeController
{
    public function index()
    {
        require __DIR__ . '/../../views/home.php';

    }
}
