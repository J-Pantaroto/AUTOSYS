<main class="container my-5" id="background">
    <h1 class="mb-4 text-center">Suas Compras, <?= htmlspecialchars(explode(' ', $user['nome'])[0]) ?>!</h1>

    <?php if (!empty($vendas)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Total (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $venda): ?>
                        <tr>
                            <td><?= $venda['id'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($venda['data_venda'])) ?></td>
                            <td><?= number_format($venda['valor_total'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">Você ainda não realizou nenhuma compra.</p>
    <?php endif; ?>
</main>
