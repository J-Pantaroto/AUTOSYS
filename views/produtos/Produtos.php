<h1>PRODUTOS</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descricao</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Categoria</th>
        <th>Ações</th>

    </tr>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= $produto['id'] ?></td>
            <td><?= $produto['nome'] ?></td>
            <td><?= $produto['descricao'] ?></td>
            <td><?= $produto['preco'] ?></td>
            <td><?= $produto['quantidade'] ?></td>
            <td><?= $produto['categoria'] ?></td>
            <td>
                <a href="produto_edit.php?id=<?= $produto['id'] ?>">Editar</a>
                <a href="produto_delete.php?id=<?= $produto['id'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="/produtos/create">Novo Produto</a>