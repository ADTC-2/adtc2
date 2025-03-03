<?php
session_start();
if (empty($_SESSION['nome']) || empty($_SESSION['senha'])) {
    // Redireciona para a página de autenticação se a sessão não estiver definida
    header('location:login.php');
    exit(); // Encerra o script após o redirecionamento
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
        /* Estilos CSS aqui */
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar e outros elementos aqui -->
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
          <i class="fas fa-user">&nbsp;</i><strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>
        </a>
      </li>
    </ul>    
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../imagens/img_carteira/ADTC2 BRANCO.png" alt="ADTC II" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> ADTC2</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="tela_lista_agendamento.php" class="nav-link active">
              <i class="fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="tela_cadastro.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Cadastro</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="tela_lista_agendamento.php" class="nav-link">
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
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Gestão de Documentos | Upload | Modelos</h3>
          </div>
        </div>
      </div>
    </div>
    <main class="content">
      <div class="container">
        <table id="agendamentoTable" class="display">
          <thead>            
            <tr>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">ID</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Solicitante</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Evento</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Horário</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Data_Evento</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Telefone</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Status</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;">Realizado</th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;"><i class="fas fa-edit"></th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;"><i class="fas fa-trash-alt"></i></th>
                <th style="text-align: center; font-family: Arial, sans-serif; font-size: 12px;"><i class="fas fa-receipt"></th>
            </tr>                
          </thead>
        </table>
      </div> 
    </main>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#agendamentoTable').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": true,
        "ajax": {
            "url": "lista_agendamentos.php",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "solicitante" },
            { "data": "tipo_evento" },
            { "data": "horario" },
            {
                "data": "data_evento",
                "render": function(data, type, row) {
                    if (data && data.length >= 10) {
                        var parts = data.split('-');
                        if (parts.length === 3) {
                            var dia = parts[2];
                            var mes = parts[1];
                            var ano = parts[0];
                            return dia + '/' + mes + '/' + ano;
                        }
                    }
                    return data;
                }
            },
            { "data": "telefone" },
            { "data": "situacao" },
            {
                "data": "dataAgendamento",
                "render": function(data, type, row) {
                    if (data && data.length >= 10) {
                        var parts = data.split('-');
                        if (parts.length === 3) {
                            var dia = parts[2];
                            var mes = parts[1];
                            var ano = parts[0];
                            return dia + '/' + mes + '/' + ano;
                        }
                    }
                    return data;
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a href="tela_alterar_agendamento.php?id=' + row.id + '"><i class="fas fa-edit"></i></a>';
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a href="procedimento_excluir_agendamento.php?id=' + row.id + '"><i class="fas fa-trash-alt"></i></a>';
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a href="tela_comprovante_agendamento.php?id=' + row.id + '"><i class="fas fa-receipt"></i></a>';
                }
            }
        ],
        "responsive": true // Ativar responsividade
    });
});


</script>
</body>
</html>