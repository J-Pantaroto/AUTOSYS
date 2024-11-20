<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Digite seu email" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" class="form-control" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
                <div class="mt-3 text-center">
                    <a href="/register" class="text-decoration-none">Ainda não possui uma conta? Registre-se</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/js/login.js"></script>
</body>
</html>
