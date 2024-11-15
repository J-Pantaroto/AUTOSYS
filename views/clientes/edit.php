<main class="container my-5" id="background">
    <h1 class="text-center mb-4">Editar Cliente</h1>
    <form id="updateClienteForm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
            <div id="nomeError" class="text-danger"></div>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
            <div id="emailError" class="text-danger"></div>
        </div>
        
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
            <div id="telefoneError" class="text-danger"></div>
        </div>
        
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <textarea class="form-control" id="endereco" name="endereco" rows="3" required><?= htmlspecialchars($cliente['endereco']) ?></textarea>
            <div id="enderecoError" class="text-danger"></div>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <div id="senhaError" class="text-danger"></div>
        </div>
        
        <div class="mb-3">
            <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
            <div id="confirmarSenhaError" class="text-danger"></div>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</main>

<script src="/js/clientes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

