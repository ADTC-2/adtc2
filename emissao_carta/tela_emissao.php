<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    // Limpa
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);

    // Redireciona para a página de autenticação
    header('Location: ../login.php');
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
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
    .main-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        /* altere a cor de fundo conforme necessário */
        padding: 10px 20px;
        /* ajuste o preenchimento conforme necessário */
        text-align: center;
        z-index: 1000;
        /* garante que o footer fique acima de outros elementos, se houver */
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
                        <i class="fas fa-user nav-icon"></i> Usuario: <?php echo $_SESSION['nome']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        Congregação: <?php echo $_SESSION['congregacao']; ?>
                    </a>
                </li>
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
                <span class="brand-text font-weight-light">ADTC System</span>
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
                            <a href="tela_emissao.php" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>Emissão</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tela_upload.php" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>Upload</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tela_lista.php" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Carta Emitidas</p>
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

            <!-- Main content -->
            <main class="content">
                <div class="row">
                    <div class="col-sm-12 mt-3">
                        <h3 class="ml-3">Emissão de Cartas</h3>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <form id="formulario">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>

                                <div class="col-md-5">
                                    <label for="estadocivil" class="form-label">Estado Civil</label>
                                    <select id="estadocivil" class="form-select" name="estadocivil">
                                        <option selected>Selecione uma opção...</option>
                                        <option>Casado</option>
                                        <option>Casada</option>
                                        <option>Solteiro</option>
                                        <option>Solteira</option>
                                        <option>Divorciado</option>
                                        <option>Divorciada</option>
                                        <option>Viuvo</option>
                                        <option>Viuva</option>
                                        <option>Separado</option>
                                        <option>Separada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="cidade" class="form-label">Cidade de destino</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade">
                                </div>

                                <div class="col-md-5">
                                    <label for="funcao" class="form-label">Função</label>
                                    <select id="funcao" class="form-select" name="funcao">
                                        <option selected>Selecione uma opção...</option>
                                        <option>Membro</option>
                                        <option>Auxiliar</option>
                                        <option>Diácono</option>
                                        <option>Presbítero</option>
                                        <option>Evangelista</option>
                                        <option>Pastor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="status" class="form-label">Tipo de carta</label>
                                    <select id="status" class="form-select" name="status">
                                        <option selected>Selecione uma opção...</option>
                                        <option>Mudança</option>
                                        <option>Recomendação</option>
                                        <option>Em Trânsito</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-file-alt"></i> Emitir
                                Carta</button>
                        </form>


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
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault(); // Evita o envio padrão do formulário

            // Captura os dados do formulário
            var formData = {
                nome: $('#nome').val(),
                estadocivil: $('#estadocivil').val(),
                cidade: $('#cidade').val(),
                funcao: $('#funcao').val()
            };

            // Envia os dados para o PHP via AJAX
            $.ajax({
                type: 'POST', // Método HTTP usado
                url: 'processamento_emissao.php', // URL para onde os dados serão enviados
                data: formData, // Dados a serem enviados
                dataType: 'json', // Tipo de dados esperado de volta do servidor (opcional)
                encode: true,
                success: function(response) {
                    // Manipular resposta de sucesso aqui, se necessário
                    console.log(response);
                    alert('Dados enviados com sucesso!');
                    // Limpar o formulário após o envio
                    $('form')[0].reset();
                },
                error: function(xhr, status, error) {
                    // Manipular erros de requisição aqui, se necessário
                    console.error(xhr.responseText);
                    alert('Ocorreu um erro ao enviar os dados.');
                }
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona os inputs que devem ser convertidos para maiúsculas
        var inputs = document.querySelectorAll('input[type="text"]');

        // Função para converter texto para maiúsculas
        function toUpperCase(event) {
            var input = event.target;
            input.value = input.value.toUpperCase();
        }

        // Adiciona evento keyup para cada input
        inputs.forEach(function(input) {
            input.addEventListener('keyup', toUpperCase);
        });
    });
    </script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>