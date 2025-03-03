<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    session_destroy();
    unset($_SESSION['nome'], $_SESSION['senha']);
    header('location:login.php');
    exit();
}

// Verifica se o nível de acesso é "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header('location:acesso_negado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- AdminLTE style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .print-icon {
        width: 25px;
        height: 25px;
    }

    .img-thumbnail {
        width: 100px;
        height: auto;
    }

    .filter-form {
        margin-bottom: 20px;
    }

    .table-responsive {
        margin: 20px;
    }

    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            white-space: nowrap;
            text-align: left;
            padding: 8px;
        }

        tbody td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        thead {
            display: none;
        }

        tr {
            display: block;
            margin-bottom: 1em;
        }

        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: .5em;
        }
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group .speech-btn {
        margin-left: 5px;
        height: 100%;
        display: flex;
        align-items: center;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
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
                        <a href="./index.php" class="nav-link">
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
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="./index.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./cadastro.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Cadastrar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./listar.php" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="../sair.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> <i class="nav-icon fas fa-user-plus"></i> Cadastro</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid">
                    <div class="row">
                        <form id="cadastroForm">
                            <div class="mb-3 input-group">
                                <label for="local" class="form-label">Local</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="local" name="local" required>
                                    <button type="button" class="speech-btn btn btn-outline-secondary">
                                        <i class="fas fa-microphone"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 input-group">
                                <label for="tipo" class="form-label">Tipo</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tipo" name="tipo" required>
                                    <button type="button" class="speech-btn btn btn-outline-secondary">
                                        <i class="fas fa-microphone"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 input-group">
                                <label for="conteudo" class="form-label">Conteúdo</label>
                                <div class="input-group">
                                    <textarea class="form-control" id="conteudo" name="conteudo" rows="5"
                                        required></textarea>
                                    <button type="button" class="speech-btn btn btn-outline-secondary">
                                        <i class="fas fa-microphone"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                        <div id="alert-container" class="mt-3"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#cadastroForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: 'processa_cadastro.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Exibe a mensagem de sucesso
                    $('#alert-container').html(
                        '<div class="alert alert-success">Cadastro realizado com sucesso!</div>'
                        );

                    // Limpa o formulário após o envio
                    $('#cadastroForm')[0].reset();

                    // Mantém a mensagem de sucesso por um tempo e depois a remove (opcional)
                    setTimeout(function() {
                        $('#alert-container').html(
                        ''); // Remover a mensagem após 5 segundos
                    }, 5000); // Exibe por 5 segundos
                },
                error: function(xhr, status, error) {
                    // Exibe a mensagem de erro
                    $('#alert-container').html(
                        '<div class="alert alert-danger">Erro ao realizar cadastro: ' +
                        xhr.responseText + '</div>');
                }
            });
        });

        // Código de reconhecimento de voz
        $('.speech-btn').on('click', function() {
            var recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
            var input = $(this).siblings('input, textarea');
            recognition.lang = 'pt-BR';
            recognition.start();

            recognition.onresult = function(event) {
                input.val(event.results[0][0].transcript);
            };
        });
    });
    </script>

</body>

</html>