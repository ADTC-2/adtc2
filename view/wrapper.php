<?php
session_start();

if ($_SESSION['nome'] === "Marcos"){
    header('location:painelReport.php');
}elseif($_SESSION['nome'] === "Sede"){
    header('location:painelReport_apoio_financeiro.php'); // ok
}elseif($_SESSION['nome'] === "Alegria"){
    header('location:painelReport_apoio_financeiro.php');  // ok
}elseif($_SESSION['nome'] === "Castelo"){
    header('location:painelReport_apoio_financeiro.php'); //ok
}elseif($_SESSION['nome'] === "Iracema"){
    header('location:painelReport_apoio_financeiro.php');  // ok
}elseif($_SESSION['nome'] === "Jubaia"){
    header('location:painelReport_apoio_financeiro.php');  // ok
}elseif($_SESSION['nome'] === "Lages"){
    header('location:painelReport_apoio_financeiro.php'); // ok
}elseif($_SESSION['nome'] === "Lameirao"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Nm1"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Nm2"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Nm3"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Npi"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Outrabanda"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Papara"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Paraiso"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Planalto"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Psj"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Serrajubaia"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Sitio"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Tabatinga"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Uma"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Vicosa"){
    header('location:painelReport_apoio_financeiro.php'); 
}elseif($_SESSION['nome'] === "Vitoria"){
    header('location:painelReport_apoio_financeiro.php'); 
}else{
    header('location:404_user_fin.php');
}
?>