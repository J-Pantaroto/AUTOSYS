<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

if (isset($adminOnly) && $adminOnly && !$_SESSION['user']['is_admin']) {
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
    <h1 class="text-center mb-4">Produtos</h1>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" onclick="window.location.href='/produtos/create'">Novo Produto</button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody id="produtosTabela">
            </tbody>
        </table>
    </div>
</main>

<script src="/js/produtos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    listarProdutos();
});
</script>
