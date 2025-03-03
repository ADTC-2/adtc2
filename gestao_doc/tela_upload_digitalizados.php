<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    //Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    //Redireciona para a página de autenticação
    header('location: login.php');
    exit(); // Importante para evitar que o código HTML seja executado
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADTC System | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    #documentForm {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: #ff0000;
        font-size: 12px;
    }

    small {
        display: block;
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i
                            class="fas fa-user">&nbsp;</i><strong><?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : ''; ?></strong>
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
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> ADTC2</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="upload.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Cadastro</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="view_doc.php" class="nav-link">
                                <i class="nav-icon fas fa-eye"></i>
                                <p>Visualizar</p>
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
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">Gestão de Documentos | Upload | Digitalizados</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <main class="content">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 col-12">
                            <div class="container">
                                <form id="documentForm" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="descricao">Descrição:</label>
                                        <input type="text" id="descricao" name="descricao" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo">Tipo:</label>
                                        <input type="text" id="tipo" name="tipo" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="responsavel">Responsável:</label>
                                        <input type="text" id="responsavel" name="responsavel" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="arquivo">Arquivo:</label>
                                        <input type="file" id="arquivo" name="arquivo" required>
                                        <small>Por favor, selecione o arquivo relevante.</small>
                                    </div>

                                    <input type="submit" value="Cadastrar Documento">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- /.content -->

            <!-- Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    <b>Version</b> 1.2.0
                </div>
                <strong>Copyright &copy; 2021-2025 <a href="#">ADTC II - Maranguape</a>.</strong>
                Todos os direitos reservados.
            </footer>
            <!-- /.content-wrapper -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#documentForm').submit(function(e) {
            e.preventDefault(); // Evita o comportamento padrão do formulário

            // Obtém os dados do formulário, incluindo o arquivo
            var formData = new FormData($(this)[0]);

            // Realiza a solicitação AJAX
            $.ajax({
                url: 'cadastro_doc_digitalizados.php', // Substitua pelo seu script de inserção real
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Manipula a resposta do servidor
                    alert('Documento cadastrado com sucesso!');
                    // Aqui você pode redirecionar a página ou fazer qualquer outra coisa que desejar
                    limparFormulario(); // Limpar o formulário após o sucesso
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Manipula erros
                    alert('Ocorreu um erro ao cadastrar o documento: ' + textStatus);
                }
            });

            return false;
        });

        function limparFormulario() {
            $('#documentForm')[0].reset();
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        >
    </script>
</body>

</html>