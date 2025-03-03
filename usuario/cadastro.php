<?php
session_start();
require_once "../db/config.php";
// Verificar se o usuário está autenticado
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header('Location: login.php');
    exit; // Encerrar o script para evitar que o restante da página seja carregado
}

// Verificar se o usuário possui o nível de permissão de administrador
if ($_SESSION['nivel'] !== 'admin') {
    // Se não for um administrador, redirecionar para alguma outra página ou mostrar uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit; // Encerrar o script
}
      $total =0;
          $sql ="SELECT COUNT(*) as c FROM filiado";
          $sql = $pdo->query($sql);
          $sql = $sql->fetch();
          $total = $sql['c'];     
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="home.php" class="nav-link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user nav-icon"></i> Usuario: <?php echo $_SESSION['nome']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        Congregação: <?php echo $_SESSION['congregacao']; ?>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="home.php" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ADTC System</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cadastro.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lista.php" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Lista</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../sair.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Sair</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Cadastro</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->


            <main class="content">
                <div class="container mt-1">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8 col-12">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h3 class="card-title">Cadastro de Usuário</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formCadastro">
                                        <div class="mb-3">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="senha" class="form-label">Senha</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="senha" name="senha"
                                                    required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="toggleSenha">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confirmarSenha"
                                                    name="confirmarSenha" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="toggleConfirmarSenha">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nivel" class="form-label">Nível</label>
                                            <select class="form-select" id="nivel" name="nivel"
                                                aria-label="Default select example" required>
                                                <option value="" disabled selected>Escolha o nível</option>
                                                <option value="apoio">Apoio</option>
                                                <option value="financeiro">Financeiro</option>
                                                <option value="card">Card</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="congregacao" class="form-label">Congregação</label>
                                            <select class="form-control" id="congregacao" name="congregacao" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="SEDE">SEDE</option>
                                                <option value="ALEGRIA">ALEGRIA</option>
                                                <option value="JUBAIA">JUBAIA</option>
                                                <option value="LAGES">LAGES</option>
                                                <option value="NOVO MARANGUAPE 1">NOVO MARANGUAPE 1</option>
                                                <option value="NOVO MARANGUAPE 2">NOVO MARANGUAPE 2</option>
                                                <option value="NOVO MARANGUAPE 3">NOVO MARANGUAPE 3</option>
                                                <option value="NOVO MARANGUAPE 4">NOVO MARANGUAPE 4</option>
                                                <option value="OUTRA BANDA">OUTRA BANDA</option>
                                                <option value="PARQUE SÃO JOÃO">PARQUE SÃO JOÃO</option>
                                                <option value="NOVO PARQUE IRACEMA">NOVO PARQUE IRACEMA</option>
                                                 <option value="NOVO PARQUE IRACEMA">NOVO PARQUE IRACEMA 2</option>
                                                <option value="SITIO SÃO LUIZ">SITIO SÃO LUIZ</option>
                                                <option value="TABATINGA">TABATINGA</option>
                                                <option value="UMARIZEIRAS">UMARIZEIRAS</option>
                                                <option value="VITÓRIA">VITÓRIA</option>
                                                <option value="VIÇOSA">VIÇOSA</option>
                                                <option value="PAPARA">PAPARA</option>
                                                <option value="PLANALTO">PLANALTO</option>
                                                <option value="SERRA JUBAIA">SERRA JUBAIA</option>
                                                <option value="IRACEMA">IRACEMA</option>
                                                <option value="PARAISO">PARAISO</option>
                                                <option value="CASTELO">CASTELO</option>
                                                <option value="LAMEIRÃO">LAMEIRÃO</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="matricula" class="form-label">Matrícula</label>
                                            <input type="text" class="form-control" id="matricula" name="matricula"
                                                >
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                    </form>
                                    <div id="alertContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/cadastro.js"></script>


    </div>
</body>

</html>