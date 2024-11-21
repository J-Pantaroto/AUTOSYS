
// Função CREATE (POST)
async function criarProduto(data) {
    try {
        const response = await fetch('/produtos/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Produto criado com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/produtos';
                listarProdutos();
                document.getElementById('createProdutoForm').reset();
            });
        } else {
            const errorMessage = await response.text();
            Swal.fire({
                icon: 'error',
                title: 'Erro ao criar produto',
                text: errorMessage
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao se conectar com o servidor.'
        });
        console.error("Erro:", error);
    }
}
const form = document.getElementById('createProdutoForm');
if (form) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = {
            nome: document.getElementById('nome').value,
            descricao: document.getElementById('descricao').value,
            preco: document.getElementById('preco').value,
            quantidade: document.getElementById('quantidade').value,
            categoria: document.getElementById('categoria').value
        };
        if (!data.nome || !data.descricao || !data.preco || !data.quantidade || !data.categoria) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Por favor, preencha todos os campos obrigatorios.'
            });
            return;
        }

        if (data.categoria === 'nova_categoria') {
            data.nova_categoria_nome = document.getElementById('nova_categoria_nome').value;
            if (!data.nova_categoria_nome) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Por favor, insira o nome da nova categoria.'
                });
                return;
            }
        }

        await criarProduto(data);
    });
}

// Função READ (GET)
async function listarProdutos() {
    try {
        const response = await fetch('/produtos/json');

        if (response.headers.get('content-type').includes('application/json')) {
            const produtos = await response.json();
            const tabelaProdutos = document.getElementById('produtosTabela');
            tabelaProdutos.innerHTML = '';

            if (produtos.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="6" class="text-center">Nenhum produto cadastrado</td>`;
                tabelaProdutos.appendChild(row);
            } else {
                produtos.forEach(produto => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${produto.id}</td>
                        <td>${produto.nome}</td>
                        <td>${produto.descricao}</td>
                        <td>${produto.preco}</td>
                        <td>${produto.quantidade}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1" onclick="editarProduto(${produto.id})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="deletarProduto(${produto.id})">Excluir</button>
                        </td>
                    `;
                    tabelaProdutos.appendChild(row);
                });
            }
        } else {
            console.error("Erro: Resposta não é JSON.");
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Erro ao carregar a lista de produtos.'
            });
        }
    } catch (error) {
        console.error("Erro ao listar produtos:", error);
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao carregar a lista de produtos.'
        });
    }
}

async function atualizarProduto(id) {
    const data = {
        nome: document.getElementById('nome').value,
        descricao: document.getElementById('descricao').value,
        preco: document.getElementById('preco').value,
        quantidade: document.getElementById('quantidade').value,
        categoria: document.getElementById('categoria').value
    };

    try {
        const response = await fetch(`/produtos/update/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Produto atualizado com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/produtos';
            });
        } else {
            const error = await response.json();
            Swal.fire({
                icon: 'error',
                title: 'Erro ao atualizar produto',
                text: error.error || 'Erro desconhecido'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao atualizar produto.'
        });
        console.error("Erro ao atualizar produto:", error);
    }
}

function editarProduto(id) {
    window.location.href = `/produtos/edit/${id}`;
}


document.addEventListener('DOMContentLoaded', () => {
    const updateForm = document.getElementById('updateProdutoForm');
    if (updateForm) {
        const id = updateForm.querySelector('input[name="id"]').value;
        updateForm.addEventListener('submit', function (event) {
            event.preventDefault();
            atualizarProduto(id);
        });
    }
});

// Função DELETAR PRODUTO (POST)
async function deletarProduto(id) {
    try {
        const response = await fetch(`/produtos/delete/${id}`, {
            method: 'POST'
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Produto excluído com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => listarProdutos());
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao excluir produto.'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao excluir produto.'
        });
        console.error("Erro ao excluir produto:", error);
    }
}

async function carregarCategorias() {
    try {
        const response = await fetch('/categorias');
        if (response.ok) {
            const categorias = await response.json();
            const selectCategoria = document.getElementById('categoria');

            categorias.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.descricao;
                selectCategoria.appendChild(option);
            });
        } else {
            console.error('Erro ao carregar categorias:', await response.text());
        }
    } catch (error) {
        console.error('Erro ao carregar categorias:', error);
    }
}

inputCategoria = document.getElementById('categoria');
if (inputCategoria) {
    document.addEventListener('DOMContentLoaded', () => {
        carregarCategorias();

        inputCategoria.addEventListener('change', function () {
            document.getElementById('novaCategoriaField').style.display = this.value === 'nova_categoria' ? 'block' : 'none';
        });

        formProd = document.getElementById('createProdutoForm');
        if (formProd) {
            formProd.addEventListener('submit', async (e) => {
                e.preventDefault();
                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                const data = {
                    nome: document.getElementById('nome').value,
                    descricao: document.getElementById('descricao').value,
                    preco: document.getElementById('preco').value,
                    quantidade: document.getElementById('quantidade').value,
                };
                if (document.getElementById('categoria').value === 'nova_categoria') {
                    data.nova_categoria_nome = document.getElementById('nova_categoria_nome').value;
                    if (!data.nova_categoria_nome) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: 'Por favor, insira o nome da nova categoria.'
                        });
                        submitButton.disabled = false;
                        return;
                    }
                } else {
                    data.categoria_id = document.getElementById('categoria').value;
                }
                await criarProduto(data);
                submitButton.disabled = false;
            });
        }
    });
}