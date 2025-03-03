document.addEventListener('DOMContentLoaded', function() {
    const senhaInput = document.getElementById('senha');
    const confirmarSenhaInput = document.getElementById('confirmarSenha');
    const toggleSenha = document.getElementById('toggleSenha');
    const toggleConfirmarSenha = document.getElementById('toggleConfirmarSenha');
    const formCadastro = document.getElementById('formCadastro');

    function toggleVisibility(input, button) {
        if (input.type === 'password') {
            input.type = 'text';
            button.querySelector('i').classList.remove('fa-eye');
            button.querySelector('i').classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            button.querySelector('i').classList.remove('fa-eye-slash');
            button.querySelector('i').classList.add('fa-eye');
        }
    }

    toggleSenha.addEventListener('click', function() {
        toggleVisibility(senhaInput, this);
    });

    toggleConfirmarSenha.addEventListener('click', function() {
        toggleVisibility(confirmarSenhaInput, this);
    });

    formCadastro.addEventListener('submit', function(e) {
        e.preventDefault();
        const senha = senhaInput.value;
        const confirmarSenha = confirmarSenhaInput.value;

        if (senha !== confirmarSenha) {
            showAlert('As senhas não coincidem. Verifique e tente novamente.', 'danger');
            return;
        }

        const formData = new FormData(formCadastro);
        fetch('processamento/cadastro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showAlert(data.message, data.status);
                if (data.status === 'success') {
                    formCadastro.reset(); // Limpa os campos do formulário
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                showAlert('Erro ao cadastrar. Tente novamente!', 'danger');
            });
    });

    function showAlert(message, type) {
        const alertContainer = document.getElementById('alertContainer');
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    
        // Remover o alerta após 5 segundos
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade'); // Adiciona a classe fade para uma transição suave
                setTimeout(() => alert.remove(), 500); // Remove o alerta após a transição
            }
        }, 5000);
    }
});


