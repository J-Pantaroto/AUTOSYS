<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = $_SERVER['REQUEST_URI'];
$dashboardRoutes = ['/dashboard', '/produtos', '/clientes'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/css/main.css" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $title ?? 'Teste'; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar bg fixed-top shadow">
        <div class="container-fluid align-items-center">
            <a href="/" class="navbar-brand">
                <img src="/imgs/logo.png" class="w-20 h-20 fill-current" id="logo" />
            </a>
            <ul class="navbar-nav">
            <?php if (in_array(parse_url($currentPage, PHP_URL_PATH), $dashboardRoutes)): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($currentPage, '/dashboard') === 0 ? 'active' : '' ?> text-white" href="/dashboard">Minhas Compras</a>
                    </li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin']): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($currentPage, '/clientes') === 0 ? 'active' : '' ?> text-white" href="/clientes">Lista de Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($currentPage, '/produtos') === 0 ? 'active' : '' ?> text-white" href="/produtos">Lista de Produtos</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                </ul>
            </div>
            <div class="dropdown" id="userDropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="userDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Olá! <?= isset($_SESSION['user']['nome']) ? explode(' ', $_SESSION['user']['nome'])[0] : 'Visitante' ?>

                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                </a>
                <ul id="drop" class="dropdown-menu dropdown-menu-end">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        <li>
                            <form method="POST" action="/logout" id="logoutForm">
                                <button type="submit" class="dropdown-item">Sair</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="/login">Entrar</a></li>
                        <li><a class="dropdown-item" href="/register">Cadastrar-se</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
