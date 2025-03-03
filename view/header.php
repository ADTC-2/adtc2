<?php
session_start();
if ( !isset($_SESSION['nome']) and !isset($_SESSION['senha']) ) {  
  //Limpa
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  
  //Redireciona para a página de autenticação
  header('location:../login.php');   
        
}

if($_SESSION['nivel']==='admin'){

echo "
<!Doctype html>
<html lang='pt-br'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
   <!-- CSS only -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
    <link rel='stylesheet' href='../css/tela_login.css'>
    <link rel='stylesheet' href='../css/painel_adm.css'>     
    <link rel='stylesheet' href='../css/style_tela_carteirinha.css'>  
    <link rel='stylesheet' href='../css/vou_impprimir.css'>
    <link rel='stylesheet' href='../css/carta.css'>
    <link rel='stylesheet' href='../css/lancamentos.css'>
    <link rel='stylesheet' href='../css/style_tela_compprovante.css'>
    <link rel='stylesheet' href='../css/style_envelope.css'>
    <link rel='stylesheet' href='../css/scanner.css'>
    
    <link rel='shortcut icon' href='../imagens/diversas_imagens/favicon.png' />
    <title>Secretaria On Line</title>
  </head>
<body>
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
      <a class='navbar-brand' href='#'>Secretaria</a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='nav justify-content-end' mr-auto'>
          <li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' href='#'' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Cadastro
                  </a>
                  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                     <a class='dropdown-item' href='tela_cad_usuario.php'>Cadastro Usuário</a>                   
                     <a class='dropdown-item' href='tela_cad_filiado.php'>Cadastro Filiado</a>
                  <div class='dropdown-divider'></div>
                     <a class='dropdown-item' href='#'></a>
                  </div>
              </li>
          <li class='nav-item'>
            <a class='nav-link' href='../view/gestao_documentos.php'>Documentos</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../view/baixar_arquivo.php'>Relatórios</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../view/lancamentos.php'>Lançamentos</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../sair.php' my-2 my-sm-0><img src='../imagens/diversas_imagens/sair.png' alt='' title='Sair do Sistema' width='25'> Sair</a>
          </li>
        </ul>
        
      </div>
    </nav>";

}else{
echo "
<!Doctype html>
<html lang='pt-br'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
     <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
   <link rel='stylesheet' href='../css/tela_login.css'>
    <link rel='stylesheet' href='../css/painel_adm.css'>     
    <link rel='stylesheet' href='../css/style_tela_carteirinha.css'>  
    <link rel='stylesheet' href='../css/vou_impprimir.css'>
    <link rel='stylesheet' href='../css/carta.css'>
    <link rel='stylesheet' href='../css/lancamentos.css'>
    <link rel='stylesheet' href='../css/style_tela_compprovante.css'>
    <link rel='stylesheet' href='../css/style_envelope.css'>
    <link rel='stylesheet' href='../css/scanner.css'>
    
    <link rel='shortcut icon' href='../imagens/diversas_imagens/favicon.png' />
    <title>Secretaria On Line</title>
  </head>
<body>
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
      <a class='navbar-brand' href='../index_secretario.php'>Mod Secretaria</a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='nav justify-content-end' mr-auto'>
          <li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' href='#'' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Cadastro
                  </a>
                  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                       
                     <a class='dropdown-item' href='tela_cad_filiado.php'>Cadastro Filiado</a>
                  <div class='dropdown-divider'></div>
                     <a class='dropdown-item' href='#'></a>
                  </div>
              </li>
          
          <li class='nav-item'>
            <a class='nav-link' href='../sair.php'><img src='../imagens/diversas_imagens/sair.png' alt='' title='Sair do Sistema' width='25'> Sair</a>
          </li>
        </ul>
        
      </div>
    </nav>";
}


?>