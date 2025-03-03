<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Destrói a sessão
    session_destroy();
    // Limpa as variáveis de sessão
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    // Redireciona para a página de autenticação
    header('Location: login.php');
    exit();
}

// Verifica se o nível de acesso é "card" ou "admin"
if (!isset($_SESSION['nivel']) || ($_SESSION['nivel'] != 'card' && $_SESSION['nivel'] != 'admin')) {
    // Redireciona para uma página de acesso negado ou outra página adequada
    header('Location: acesso_negado.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carteira Digital</title>
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    body {
        font-family: 'Source Sans Pro', Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .navbar {
        margin-bottom: 1rem;
    }

    .print-icon {
        width: 20px;
        height: 20px;
    }

    .img-thumbnail {
        max-width: 100px;
        height: auto;
    }

    .filter-form {
        margin-bottom: 1rem;
    }

    .table-responsive {
        margin: 1rem;
    }

    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
        }

        th, td {
            white-space: nowrap;
            text-align: left;
            padding: .75rem;
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
            margin-bottom: .5rem;
        }

        td::before {
            content: attr(data-label);
            font-weight: bold;
            display: block;
            margin-bottom: .5rem;
        }
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto">
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
                        <a href="../sair.php" class="nav-link"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid text-center">
                    <div class="row mb-2 justify-content-center">
                        <div class="col-sm-8">
                            <h1 class="m-0 text-dark">
                                <i class="nav-icon fas fa-wallet"></i> Carteira Digital
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.content-header -->

            <!-- Main content -->
            <main class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <form action="views/mobile.php" method="get" class="w-100">
                                <div class="mb-3 text-center">
                                    <label for="matricula" class="form-label">
                                        Matrícula (atual:
                                        <?php echo htmlspecialchars($_SESSION['matricula'] ?? 'não disponível', ENT_QUOTES, 'UTF-8'); ?>)
                                    </label>
                                    <input type="hidden" id="matricula" name="matricula"
                                        value="<?php echo htmlspecialchars($_SESSION['matricula'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Minha Carteira</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>
