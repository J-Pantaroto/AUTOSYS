document.addEventListener('DOMContentLoaded', () => {
    listarClientes();
});
document.getElementById('createClienteForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    document.getElementById('nomeError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('senhaError').textContent = '';
    document.getElementById('senhaconfirmError').textContent = '';
    document.getElementById('telefoneError').textContent = '';
    document.getElementById('enderecoError').textContent = '';
    
    const nome = document.getElementById('nome').value.trim();
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;
    const senhaconfirm = document.getElementById('senhaconfirm').value;
    const telefone = document.getElementById('telefone').value.trim();
    const endereco = document.getElementById('endereco').value.trim();

    let valid = true;
    if (!nome) {
        document.getElementById('nomeError').textContent = "Por favor, preencha o nome.";
        valid = false;
    }
    if (!email) {
        document.getElementById('emailError').textContent = "Por favor, preencha o email.";
        valid = false;
    }
    if (!senha) {
        document.getElementById('senhaError').textContent = "Por favor, preencha a senha.";
        valid = false;
    }
    if (senha !== senhaconfirm) {
        document.getElementById('senhaconfirmError').textContent = "As senhas não coincidem.";
        valid = false;
    }
    if (telefone.length < 10) {
        document.getElementById('telefoneError').textContent = "Por favor, insira um número de telefone válido.";
        valid = false;
    }
    if (!endereco) {
        document.getElementById('enderecoError').textContent = "Por favor, preencha o endereço.";
        valid = false;
    }
    
    if (!valid) return;

    const data = { nome, email, senha, telefone, endereco };
    await criarCliente(data);
});

// Função CREATE (POST)
async function criarCliente(data) {
    try {
        const response = await fetch('/clientes/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Cliente criado com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "/clientes";
            });
        } else {
            const errorMessage = await response.text();
            Swal.fire({
                icon: 'error',
                title: 'Erro ao criar cliente',
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

// Função READ (GET)
async function listarClientes() {
    try {
        const response = await fetch('/clientes');
        const clientes = await response.json();

        const tabelaClientes = document.getElementById('clientesTabela');
        tabelaClientes.innerHTML = '';

        if (clientes.length === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td colspan="6" class="text-center">Nenhum cliente cadastrado</td>
            `;
            tabelaClientes.appendChild(row);
        } else {
            clientes.forEach(cliente => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${cliente.id}</td>
                    <td>${cliente.nome}</td>
                    <td>${cliente.email}</td>
                    <td>${cliente.telefone}</td>
                    <td>${cliente.endereco}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" onclick="editarCliente(${cliente.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="deletarCliente(${cliente.id})">Excluir</button>
                    </td>
                `;
                tabelaClientes.appendChild(row);
            });
        }
    } catch (error) {
        console.error("Erro ao listar clientes:", error);
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao carregar a lista de clientes.'
        });
    }
}

// Função EDITAR CLIENTE (GET)
async function editarCliente(id) {
    try {
        const response = await fetch(`/clientes/edit/${id}`);
        const cliente = await response.json();

        document.getElementById('nome').value = cliente.nome;
        document.getElementById('email').value = cliente.email;

        document.getElementById('updateClienteForm').onsubmit = function(event) {
            event.preventDefault();
            atualizarCliente(id);
        };
    } catch (error) {
        console.error("Erro ao carregar dados do cliente para edição:", error);
    }
}

// Função UPDATE CLIENTE (POST)
async function atualizarCliente(id) {
    const data = {
        nome: document.getElementById('nome').value,
        email: document.getElementById('email').value
    };

    try {
        const response = await fetch(`/clientes/update/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Cliente atualizado com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => listarClientes());
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao atualizar cliente.'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao atualizar cliente.'
        });
        console.error("Erro ao atualizar cliente:", error);
    }
}

// Função DELETAR CLIENTE (POST)
async function deletarCliente(id) {
    try {
        const response = await fetch(`/clientes/delete/${id}`, {
            method: 'POST'
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Cliente excluído com sucesso!',
                confirmButtonText: 'OK'
            }).then(() => listarClientes());
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao excluir cliente.'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Erro ao excluir cliente.'
        });
        console.error("Erro ao excluir cliente:", error);
    }
}