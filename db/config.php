<?php

 //$dsn = "mysql:dbname=codig267_db_teste1;host=localhost";
 //$dbuser="root";
 //$dbpass = "";

 $dsn = "mysql:dbname=adtc2m99_adtc2;host=50.116.87.140";
 $dbuser="adtc2m99_adtc2";
 $dbpass = "6lE+]tuYjghj";

 try {

 	$pdo = new PDO( $dsn,$dbuser,$dbpass);

 	
 } catch (PDOException $e) {

 	echo "Falhou :".$e->getMessage();
 	
 }










?>