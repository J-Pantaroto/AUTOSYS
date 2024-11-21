<main class="container my-5" id="background">
<div id="product-list" class="container my-5">
    <h2 class="text-center mb-4">Produtos Disponíveis</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (!empty($produtos)) : ?>
            <?php foreach ($produtos as $produto) : ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= $produto['nome'] ?></h5>
                            <p class="card-text"><?= $produto['descricao'] ?></p>
                            <p class="card-text"><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                            <button class="btn btn-success add-to-cart" data-id="<?= $produto['id'] ?>">Adicionar ao Carrinho</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <p class="text-center">Nenhum produto cadastrado.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php if (isset($_SESSION['user'])): ?>
<div id="cart-modal" class="modal fade" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Seu Carrinho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <ul id="cart-items" class="list-group">
                </ul>
            </div>
            <div class="modal-footer">
                <button id="clear-cart" class="btn btn-danger">Limpar Carrinho</button>
                <button id="finalizar-compra" class="btn btn-success">Finalizar Compra</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div id="floating-cart" class="position-fixed bottom-0 end-0 m-3">
    <button id="view-cart" class="btn cart-button position-relative" data-bs-toggle="modal" data-bs-target="#cart-modal">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
</svg>
        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            0
        </span>
    </button>
</div>
<?php endif; ?>

</main>