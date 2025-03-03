<?php
session_start();

if ($_SESSION['nome'] === "Marcos"){
    header('location:painelReport.php');// ok
}elseif($_SESSION['nome'] === "Sede"){
    header('location:congregacao-sede.php'); // ok
}elseif($_SESSION['nome'] === "Alegria"){
    header('location:congregacao-alegria.php'); // ok
}elseif($_SESSION['nome'] === "Castelo"){
    header('location:congregacao-castelo.php'); //ok
}elseif($_SESSION['nome'] === "Iracema"){
    header('location:congregacao-iracema.php'); // ok
}elseif($_SESSION['nome'] === "Jubaia"){
    header('location:congregacao-jubaia.php'); // ok
}elseif($_SESSION['nome'] === "Lages"){
    header('location:congregacao-lages.php'); // ok
}elseif($_SESSION['nome'] === "Lameirao"){
    header('location:congregacao-lameirao.php');
}elseif($_SESSION['nome'] === "Nm1"){
    header('location:congregacao-nm1.php'); //ok
}elseif($_SESSION['nome'] === "Nm2"){
    header('location:congregacao-nm2.php'); // ok
}elseif($_SESSION['nome'] === "Nm3"){
    header('location:congregacao-nm3.php'); // ok
}elseif($_SESSION['nome'] === "Npi"){
    header('location:congregacao-npi.php'); // ok
}elseif($_SESSION['nome'] === "Outrabanda"){
    header('location:congregacao-outrabanda.php'); // ok
}elseif($_SESSION['nome'] === "Papara"){
    header('location:congregacao-papara.php');
}elseif($_SESSION['nome'] === "Paraiso"){
    header('location:congregacao-paraiso.php');// ok
}elseif($_SESSION['nome'] === "Planalto"){
    header('location:congregacao-planalto.php');
}elseif($_SESSION['nome'] === "Psj"){
    header('location:congregacao-psj.php');// ok
}elseif($_SESSION['nome'] === "Serrajubaia"){
    header('location:congregacao-serrajubaia.php');// ok
}elseif($_SESSION['nome'] === "Sitio"){
    header('location:congregacao-sitio.php');//ok
}elseif($_SESSION['nome'] === "Tabatinga"){
    header('location:congregacao-tabatinga.php');
}elseif($_SESSION['nome'] === "Uma"){
    header('location:congregacao-uma.php');
}elseif($_SESSION['nome'] === "Vicosa"){
    header('location:congregacao-vicosa.php');
}elseif($_SESSION['nome'] === "Vitoria"){
    header('location:congregacao-vitoria.php');
}else{
    header('location:404_user_fin.php');
}
?>