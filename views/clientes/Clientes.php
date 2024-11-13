<main class="container my-5" id="background">
    <h1 class="text-center mb-4">Clientes</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="/clientes/create" class="btn btn-primary">Novo Cliente</a>
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
            <tbody>
                <?php if (empty($clientes)) { ?>
                    <td colspan="5"> Nenhum cliente cadastrado</td>
                <?php } ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['id']) ?></td>
                        <td><?= htmlspecialchars($cliente['nome']) ?></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                        <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                        <td>
                            <a href="/clientes/edit/<?= $cliente['id'] ?>" class="btn btn-sm btn-warning me-1">Editar</a>
                            <a href="clientes/delete?id=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>