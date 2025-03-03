<?php
include 'verifica_acesso.php';
 //$dsn = "mysql:dbname=db_teste1;host=localhost";
 //$dbuser="root";
 //$dbpass = "";

 $dsn = "mysql:dbname=tcmarang_db_teste1;host=162.241.2.16";
 $dbuser="tcmarang_root";
 $dbpass = "alves1974";

 try {

 	$pdo = new PDO( $dsn,$dbuser,$dbpass);

 	
 } catch (PDOException $e) {

 	echo "Falhou :".$e->getMessage();
 	
 }










?>