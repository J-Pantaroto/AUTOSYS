document.addEventListener('DOMContentLoaded', () => {
    const viewCartButton = document.getElementById('view-cart');
    const cartItemsContainer = document.getElementById('cart-items');
    const checkoutButton = document.getElementById('checkout-button');
    const clearCartButton = document.getElementById('clear-cart');
    const cartCount = document.getElementById('cart-count');

    function updateCartCount() {
        fetch('/cart')
            .then(response => response.json())
            .then(data => {
                const totalItems = Object.values(data.cart || {}).reduce((sum, qty) => sum + qty, 0);
                cartCount.textContent = totalItems;
            })
            .catch(error => console.error('Erro ao atualizar contador do carrinho:', error));
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');

            if (!productId) {
                console.error('ID do produto não encontrado no botão.');
                return;
            }

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: productId }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        let timerInterval;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Você precisa estar logado!',
                            html: 'Redirecionando para a página de login em <b></b> milissegundos.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector('b');
                                timerInterval = setInterval(() => {
                                    timer.textContent = Swal.getTimerLeft();
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then(() => {
                            window.location.href = data.redirect;
                        });
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Adicionado ao carrinho"
                        });
                        updateCartCount();
                    }
                })
                .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
        });
    });

    function loadCartItems() {
        fetch('/cart')
            .then(response => response.json())
            .then(data => {
                cartItemsContainer.innerHTML = '';
                if (data.cart && Object.keys(data.cart).length > 0) {
                    for (const [productId, quantity] of Object.entries(data.cart)) {
                        const item = document.createElement('li');
                        item.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                        item.innerHTML = `
                            Produto ID: ${productId} - Quantidade: ${quantity}
                            <button class="btn btn-danger btn-sm remove-item" data-id="${productId}">Remover</button>
                        `;
                        cartItemsContainer.appendChild(item);
                    }

                    document.querySelectorAll('.remove-item').forEach(button => {
                        button.addEventListener('click', function () {
                            const productId = this.getAttribute('data-id');
                            removeFromCart(productId);
                        });
                    });
                } else {
                    const emptyMessage = document.createElement('li');
                    emptyMessage.classList.add('list-group-item', 'text-center');
                    emptyMessage.textContent = 'Seu carrinho está vazio.';
                    cartItemsContainer.appendChild(emptyMessage);
                }
            })
            .catch(error => console.error('Erro ao carregar o carrinho:', error));
    }

    function removeFromCart(productId) {
        fetch('/cart/remove', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: productId }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCartItems();
                    updateCartCount();
                } else {
                    console.error('Erro ao remover item:', data.error);
                }
            })
            .catch(error => console.error('Erro ao remover item:', error));
    }
    if (clearCartButton) {
        clearCartButton.addEventListener('click', () => {
            fetch('/cart/clear', { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadCartItems();
                        updateCartCount();
                    } else {
                        console.error('Erro ao limpar o carrinho:', data.error);
                    }
                })
                .catch(error => console.error('Erro ao limpar o carrinho:', error));
        });

        viewCartButton.addEventListener('click', loadCartItems);
        updateCartCount();
    }
});


document.getElementById('finalizar-compra').addEventListener('click', () => {
    fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Compra finalizada!',
                    text: 'Sua compra foi realizada com sucesso.',
                    showConfirmButton: false,
                    timer: 3000,
                }).then(() => {
                    window.location.href = '/dashboard';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: data.error || 'Erro ao finalizar a compra.',
                });
            }
        })
        .catch(error => {
            console.error('Erro ao finalizar a compra:', error);
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Erro inesperado ao finalizar a compra.',
            });
        });
});
