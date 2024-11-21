<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

// Verificar se o usuário é administrador
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
    <h1 class="text-center mb-4">Editar Produto</h1>
    <form id="updateProdutoForm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
            <div id="nomeError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
            <div id="descricaoError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>
            <div id="precoError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade em Estoque</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>
            <div id="quantidadeError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria['id']) ?>" <?= $categoria['id'] == $produto['categoria'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria['nome']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="nova_categoria">Cadastrar nova categoria</option>
            </select>
            <div id="categoriaError" class="text-danger"></div>
        </div>
        <div class="mb-3" id="novaCategoriaField" style="display:none;">
            <label for="nova_categoria_nome" class="form-label">Nome da Nova Categoria</label>
            <input type="text" class="form-control" id="nova_categoria_nome" name="nova_categoria_nome">
            <div id="novaCategoriaError" class="text-danger"></div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="/produtos" class="btn btn-secondary">Cancelar</a>
    </form>
</main>

<script src="/js/produtos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('categoria').addEventListener('change', function () {
        document.getElementById('novaCategoriaField').style.display = this.value === 'nova_categoria' ? 'block' : 'none';
    });
</script>
