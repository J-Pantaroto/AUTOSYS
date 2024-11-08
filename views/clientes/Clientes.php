<h1>CLIENTES</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td><?= $cliente['id'] ?></td>
            <td><?= $cliente['nome'] ?></td>
            <td><?= $cliente['email'] ?></td>
            <td><?= $cliente['telefone'] ?></td>
            <td>
                <a href="cliente_edit.php?id=<?= $cliente['id'] ?>">Editar</a>
                <a href="cliente_delete.php?id=<?= $cliente['id'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="/clientes/create">Novo Cliente</a>