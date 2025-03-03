document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formCadastro');
    const alertContainer = document.getElementById('alertContainer');
    const toggleSenha = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita o envio padrão do formulário

        const formData = new FormData(form);

        fetch('processamento/editar.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alertContainer.innerHTML = `<div class="alert alert-success" role="alert">${data.message}</div>`;
                form.reset(); // Limpa o formulário após sucesso
            } else {
                alertContainer.innerHTML = `<div class="alert alert-danger" role="alert">${data.message}</div>`;
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alertContainer.innerHTML = `<div class="alert alert-danger" role="alert">Erro ao processar a solicitação.</div>`;
        });
    });

    toggleSenha.addEventListener('click', function() {
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
            toggleSenha.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            senhaInput.type = 'password';
            toggleSenha.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
});
