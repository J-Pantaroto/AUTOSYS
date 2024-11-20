<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
            <h3 class="text-center mb-4">Registrar-se</h3>
            <form id="registerForm">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" class="form-control" placeholder="Digite seu nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Digite seu email" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" class="form-control" placeholder="Digite sua senha" required>
                </div>
                <div class="mb-3">
                    <label for="senhaconfirm" class="form-label">Confirme a Senha</label>
                    <input type="password" id="senhaconfirm" class="form-control" placeholder="Confirme sua senha" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" id="telefone" class="form-control" placeholder="Digite seu telefone" required>
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" id="endereco" class="form-control" placeholder="Digite seu endereço" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Registrar</button>
                <div class="mt-3 text-center">
                    <a href="/login" class="text-decoration-none">Já possui uma conta? Faça login</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/register.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>