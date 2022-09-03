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


$arquivo='Membros_SitioSaoLuiz.xls';

$html='';
$html.='<table border="1">';
$html.='<tr>';
$html.='<td colspan="12">Total Membros - sitio são Luiz</td>';
$html.='</tr>';

$html.='<tr>';
$html.='<td><b>Matricula</b></td>';
$html.='<td><b>Nome</b></td>';
$html.='<td><b>Funcao</b></td>';
$html.='<td><b>Congregacao</b></td>';
$html.='<td><b>Documento</b></td>';
$html.='<td><b>Data Nascimento</b></td>';
$html.='<td><b>Data Batismo</b></td>';
$html.='<td><b>Estado Civil</b></td>';
$html.='<td><b>Mae</b></td>';
$html.='<td><b>Pai</b></td>';
$html.='<td><b>DatA Cadastro</b></td>';
$html.='<td><b>Arquivo</b></td>';
$html.='<td><b>Logradouro</b></td>';
$html.='<td><b>Endereco</b></td>';
$html.='<td><b>Numero</b></td>';
$html.='<td><b>Bairro</b></td>';
$html.='<td><b>Cep</b></td>';
$html.='<td><b>Cidade</b></td>';
$html.='<td><b>Uf</b></td>';
$html.='<td><b>Telefone</b></td>';
$html.='<td><b>Email</b></td>';

$html.='</tr>';

//Selecionar todos os itens da tabela 
          require_once '../db/config.php';
          
         
		  $sql = " SELECT * FROM filiado WHERE congregacao = 'SITIO SÃO LUIZ'";
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
           	$html .= '<td>'.$linhas["documento"].'</td>';
           	$html .= '<td>'.$linhas["dataNascimento"].'</td>';
           	$html .= '<td>'.$linhas["dataBatismo"].'</td>';
            $html .= '<td>'.$linhas["estadoCivil"].'</td>';
            $html .= '<td>'.$linhas["mae"].'</td>';
            $html .= '<td>'.$linhas["pai"].'</td>';
            $html .= '<td>'.$linhas["datCadastro"].'</td>';
            $html .= '<td>'.$linhas["arquivo"].'</td>';
            $html .= '<td>'.$linhas["logradouro"].'</td>';
            $html .= '<td>'.$linhas["endereco"].'</td>'; 
            $html .= '<td>'.$linhas["numero"].'</td>';
			$html .= '<td>'.$linhas["bairro"].'</td>';
           	$html .= '<td>'.$linhas["cep"].'</td>';
           	$html .= '<td>'.$linhas["cidade"].'</td>';
           	$html .= '<td>'.$linhas["uf"].'</td>';
            $html .= '<td>'.$linhas["telefone"].'</td>';
            
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