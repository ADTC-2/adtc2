<?php
session_start();
if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {  
  // Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  
  // Redireciona para a página de autenticação
  header('location:login.php');   
  exit(); // Adiciona um exit após redirecionar para garantir que o código não continue a ser executado
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Relatório de Agendamentos</title>
  <style>
    body {
      padding-top: 20px;
    }
    .navbar {
      margin-bottom: 20px;
    }
    .container {
      max-width: 600px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .btn-block {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="#" class="navbar-brand">Gerar Relatórios</a>
  </nav>
  <div class="container">
    <form novalidate class="needs-validation" action="relatorios_eventos.php" method="GET">
      <div class="form-row">     
        <div class="col form-group">       
          <label for="data_inicio">Data Inicial</label>
          <input type="date" name="data_inicio" class="form-control" id="data_inicio" required>
        </div>
      </div>
      <div class="form-row">     
        <div class="col form-group">       
          <label for="data_fim">Data Final</label>
          <input type="date" name="data_fim" class="form-control" id="data_fim" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Gerar Relatório</button>  
    </form>
  </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
      if (form.checkValidity() === false) {
        e.preventDefault();
        e.stopImmediatePropagation();
      }
      form.classList.add('was-validated');
    });
  });
</script>
</body>
</html>
