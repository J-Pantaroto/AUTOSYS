<main class="container my-5">
    <h1 class="text-center mb-4">Editar Cliente</h1>
    <form action="/clientes/update/<?= $cliente['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</main>
