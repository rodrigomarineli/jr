<?php ob_start(); ?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php

$user = CRUD::Select('pedidos','id DESC');

$cont = 1;
// NOME DO ARQUIVO
$arquivo = 'relatorio-orcamentos.xls';

// TABELA QUE SERÁ GERADA
$html = '';
$html .= '<table>';
$html .= '<tr>';
	$html .= '<td colspan="15"><b>'.utf8_decode('Relatório de Orçamentos').'</b></tr>';
$html .= '</tr>';
$html .= '<tr>';
	$html .= '<td><b>'.utf8_decode('Orçamento').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Data do Orçamentos').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Cliente').'</b></td>';
$html .= '</tr>';
foreach ($user['dados'] as $lista) {
	$cliente = CRUD::SelectOne('cliente','id',$lista['id_cliente']);

	$html .= '<tr>';
		$html .= '<td>'.utf8_decode($lista['id']).'</td>';
		$html .= '<td>'.utf8_decode(date('d/m/Y' ,strtotime($lista['data']))).'</td>';
		$html .= '<td>'.utf8_decode($cliente['dados'][0]['nome']).'</td>';
	$html .= '</tr>';
	$cont++;

}
$html .= '</table>';

// // CONFIGURAÇÃO DO HEADER PARA FORÇAR DOWNLOAD
header ("Expires: Mon, 01 Jul 2013 11:21:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
header ("Content-Type: text/html; charset=utf-8",true);

// ENVIA O CONTEÚDO DO ARQUIVO
echo $html;
exit;

?>