<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

if (!$_SESSION['user']['is_admin']){
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Acesso negado',
            text: 'Área restrita a administradores.'
        }).then(() => {
            window.location.href = '/';
        });
    </script>";
    exit;
}
?>
<main class="container my-5" id="background">
    <h1 class="text-center mb-4">Clientes</h1>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" onclick="window.location.href='/clientes/create'">Novo Cliente</button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody id="clientesTabela">
            </tbody>
        </table>
    </div>
</main>
<script src="/js/clientes.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        listarClientes(); 
    });
</script>
