document.getElementById('registerForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const senhaconfirm = document.getElementById('senhaconfirm').value;
    const telefone = document.getElementById('telefone').value;
    const endereco = document.getElementById('endereco').value;
    if (senha !== senhaconfirm) {
        Swal.fire({
            icon: 'error',
            title: 'Erro no registro',
            text: 'As senhas não coincidem.',
        });
        return;
    }

    try {
        const response = await fetch('/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nome, email, senha, telefone, endereco }),
        });

        const result = await response.json();

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Registro realizado com sucesso!',
                confirmButtonText: 'OK',
            }).then(() => {
                window.location.href = '/login';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao registrar',
                text: result.error || 'Algo deu errado. Tente novamente.',
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Erro de conexão',
            text: error.message,
        });
    }
});
