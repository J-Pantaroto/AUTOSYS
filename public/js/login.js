document.getElementById('loginForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;

    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, senha }),
        });

        const result = await response.json();

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Login realizado com sucesso!',
                confirmButtonText: 'OK',
            }).then(() => {
                window.location.href = '/';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao fazer login',
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
