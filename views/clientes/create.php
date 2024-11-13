<main class="container my-5">
    <h1 class="text-center mb-4">Novo Cliente</h1>
    <form action="/clientes/store" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="mb-3">
            <label for="senhaconfirm" class="form-label">Confirme sua senha</label>
            <input type="password" class="form-control" id="senhaconfirm" name="senhaconfirm" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</main>
