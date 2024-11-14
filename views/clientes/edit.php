<main class="container my-5" id="background">
    <h1 class="text-center mb-4">Editar Cliente</h1>
    <form id="updateClienteForm">
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
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</main>

<script src="/js/clientes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const clienteId = <?= json_encode($cliente['id']) ?>;
        editarCliente(clienteId);
    });
</script>
