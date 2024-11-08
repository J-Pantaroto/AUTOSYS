<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/public/css/main.css" rel="stylesheet">
    <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $title ?? 'Teste'; ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100 ">
    <nav class="navbar navbar-expand-lg shadow fixed-top">
        <div class="container-fluid align-items-center">
            <div class="navbar-collapse" id="navbarSupportedContent">
                <a href="/">
                    <img src="public/imgs/logo.png" class="w-20 h-20 fill-current" id="logo" />
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-fill" id="background">
        <div class="center">
        <a href="/clientes">Lista de clientes</a>
        <a href="/produtos">Lista de produtos</a>
        </div>
    </main>
    <footer class="mt-auto">
        <div id="footer_copyright">
            <div id="footer_social_media">
                <a href="{{ config('social.instagram') }}" target="_blank" class="footer-link" id="instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="{{ config('social.facebook') }}" target="_blank" class="footer-link" id="facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="{{ config('social.whatsapp') }}" target="_blank" class="footer-link" id="whatsapp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
            <p id="texto-copyright">
                &#169; Teste ® 2024 - Todos os direitos reservados | Site criado por:
                <a style="color:white" id="link-footer" href="https://github.com/J-Pantaroto">
                    J-Pantaroto
                </a>
            </p>
        </div>
    </footer>
    <script src="/public/bootstrap/css/bootstrap.min.css"></script>

</body>

</html>