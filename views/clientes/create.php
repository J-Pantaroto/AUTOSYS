<main class="container my-5" id="background">
    <h1 class="text-center mb-4">Novo Cliente</h1>
    <form id="createClienteForm">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
            <div id="nomeError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div id="emailError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <div id="senhaError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="senhaconfirm" class="form-label">Confirme sua senha</label>
            <input type="password" class="form-control" id="senhaconfirm" name="senhaconfirm" required>
            <div id="senhaconfirmError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
            <div id="telefoneError" class="text-danger"></div>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
            <div id="enderecoError" class="text-danger"></div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</main>

<script src="/js/clientes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
