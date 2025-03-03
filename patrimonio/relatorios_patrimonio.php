<?php
session_start();
 require '../db/config.php';
 if (!isset($_SESSION['nome']) and !isset($_SESSION['senha'])) {
  //Destrói
  session_destroy();
  //Limpa
  unset($_SESSION['nome']);
  unset($_SESSION['senha']);
  //Redireciona para a página de autenticação
  header('location:login.php');
}


$arquivo='Patrimonio.xls';

$html='';
$html.='<table border="1">';
$html.='<tr>';
$html.='<td colspan="12">Patrimonio_$congregacao</td>';
$html.='</tr>';

$html.='<tr>';
$html.='<td><b>Codigo</b></td>';
$html.='<td><b>Descrição</b></td>';
$html.='<td><b>Quantidade</b></td>';
$html.='<td><b>Congregacao</b></td>';
$html.='<td><b>Data</b></td>';
$html.='</tr>';

//Selecionar todos os itens da tabela 
          require_once '../db/config.php';
          
          $congregacao = $_GET['congregacao'];
		  $sql = " SELECT id_patrimonio, descricao, qtde, congregacao FROM patrimonio WHERE congregacao ='$congregacao'";
		  $sql = $pdo->query($sql);
		
		if ($sql->rowCount() > 0) {
            # code...
            foreach ($sql->fetchAll() as  $linhas) {
    # code...
			$html .= '<tr>';
			$html .= '<td>'.$linhas["id_patrimonio"].'</td>';
			$html .= '<td>'.$linhas["descricao"].'</td>';
			$html .= '<td>'.$linhas["qtde"].'</td>';
			$html .= '<td>'.$linhas["congregacao"].'</td>';   
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