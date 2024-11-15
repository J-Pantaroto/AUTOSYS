<main class="container my-5" id="background">
    <h1 class="text-center mb-4">Clientes</h1>

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" onclick="window.location.href='/produtos/create'">Novo Cliente</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/clientes.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        listarClientes(); 
    });
</script>
