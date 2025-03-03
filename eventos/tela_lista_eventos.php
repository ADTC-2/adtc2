<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('location:../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos ADTC2</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <!-- Moment Timezone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>

    <!-- FullCalendar Locale -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/pt-br.js"></script>

    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    #calendar {
        max-width: 100%;
        margin: 20px auto;
    }

    @media (max-width: 768px) {
        .main-header .navbar-nav {
            text-align: center;
        }

        .main-sidebar .brand-link {
            text-align: center;
        }

        .main-sidebar .nav-sidebar {
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            text-align: center;
        }
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-white navbar-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="tela_lista_eventos.php" class="nav-link">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-warehouse"></i> Congregação:
                            <?php echo htmlspecialchars($_SESSION['congregacao'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../sair.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i></a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="./../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">System ADTC2</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="tela_lista_eventos.php" class="nav-link">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tela_cadastro.php" class="nav-link">
                                <i class="fas fa-user-plus"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="../sair.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i>Sair</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <main class="content">
                <div class="container mt-4">
                    <h3>Eventos</h3>
                    <div id="calendar"></div>
                </div>
            </main>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Detalhes do Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 id="eventTitle"></h4>
                        <p id="eventDescription"></p>
                        <!-- Campo para mostrar a congregação -->
                        <p id="eventCongregation"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="editEventBtn">Editar</button>
                        <button type="button" class="btn btn-danger" id="deleteEventBtn">Excluir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>&copy; 2024 <a href="#">Sistema ADTC</a>.</strong> Todos os direitos reservados.
        </footer>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            timeZone: 'America/Sao_Paulo',
            locale: 'pt-br', // Configuração para português do Brasil
            events: 'eventos_data.php',
            editable: true,
            selectable: true,
            eventClick: function(info) {
                // Preenche os dados do modal
                document.getElementById('eventTitle').textContent = info.event.title;
                document.getElementById('eventDescription').textContent = info.event.extendedProps.description || 'Sem descrição';
                document.getElementById('eventCongregation').textContent =
                    'Congregação: ' + (info.event.extendedProps.congregacao || 'Sem congregação');

                // Atualiza os dados do botão
                document.getElementById('editEventBtn').dataset.eventId = info.event.id;
                document.getElementById('deleteEventBtn').dataset.eventId = info.event.id;

                // Mostra o modal
                var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
            },
        });

        calendar.render();

        document.getElementById('editEventBtn').addEventListener('click', function() {
            var eventId = this.dataset.eventId;
            if (eventId) {
                window.location.href = 'tela_alterar_eventos.php?id=' + eventId;
            }
        });

        document.getElementById('deleteEventBtn').addEventListener('click', function() {
    var eventId = this.dataset.eventId;
    if (eventId) {
        if (confirm('Deseja realmente excluir este evento?')) {
            // Envia uma requisição POST usando fetch
            fetch('procedimento_excluir_eventos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: eventId }) // Envia o ID do evento como JSON
            })
            .then(response => response.json()) // Processa a resposta JSON
            .then(data => {
                if (data.success) {
                    alert('Evento excluído com sucesso.');
                    // Redireciona ou atualiza a página conforme necessário
                    window.location.reload();
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao tentar excluir o evento.');
            });
        }
    }
});

    });
    </script>
</body>

</html>
