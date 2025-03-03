<?php
session_start();
 require '../db/config.php';
 if (!isset($_SESSION['login']) and !isset($_SESSION['senha'])) {
  //Destrói
  session_destroy();
  //Limpa
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  //Redireciona para a página de autenticação
  header('location:login.php');
}


$arquivo='Membros_Castelo.xls';

$html='';
$html.='<table border="1">';
$html.='<tr>';
$html.='<td colspan="12">Total Membros - Castelo</td>';
$html.='</tr>';

$html.='<tr>';
$html.='<td><b>Matricula</b></td>';
$html.='<td><b>Nome</b></td>';
$html.='<td><b>Funcao</b></td>';
$html.='<td><b>Congregacao</b></td>';
$html.='<td><b>Status</b></td>';
$html.='<td><b>Criado em :</b></td>';
$html.='</tr>';

//Selecionar todos os itens da tabela 
          require_once '../db/config.php';
          
         
		  $sql = " SELECT matricula,nome,funcao,congregacao,status FROM filiado WHERE congregacao = 'CASTELO'";
		  $sql = $pdo->query($sql);
		
		if ($sql->rowCount() > 0) {
            # code...
            foreach ($sql->fetchAll() as  $linhas) {
    # code...
			$html .= '<tr>';
			$html .= '<td>'.$linhas["matricula"].'</td>';
			$html .= '<td>'.$linhas["nome"].'</td>';
			$html .= '<td>'.$linhas["funcao"].'</td>';
			$html .= '<td>'.$linhas["congregacao"].'</td>';     
      $html .= '<td>'.$linhas["status"].'</td>';
			$data = date('d/m/Y H:i:s');
			$html .= '<td>'.$data.'</td>';
			$html .= '</tr>';
			;
		}

// Configurações header para forçar o download
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		
    echo $html;
 ?>	

<?php
  }
 

 ?> 