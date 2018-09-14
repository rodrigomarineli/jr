<?php ob_start(); ?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php

$user = CRUD::Select('pedido','id DESC');

$cont = 1;
// NOME DO ARQUIVO
$arquivo = 'relatorio-pedidos.xls';

// TABELA QUE SERÁ GERADA
$html = '';
$html .= '<table>';
$html .= '<tr>';
	$html .= '<td colspan="15"><b>'.utf8_decode('Relatório de Pedidos').'</b></tr>';
$html .= '</tr>';
$html .= '<tr>';
	$html .= '<td><b>'.utf8_decode('Pedido').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Data do Pedido').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Tipo de Entrega').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Valor do Frete').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Prazo').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Rastreio').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Forma de Pagamento').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Valor Pedido').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Cupom de desconto').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Status').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Cliente').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Produto').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Referência').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Coleção').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Quantidade').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Atributos').'</b></td>';
$html .= '</tr>';
foreach ($user['dados'] as $lista) {
	$cliente = CRUD::SelectOne('cliente','id',$lista['id_cliente']);
	$status = CRUD::SelectOne('status','id',$lista['status']);
	switch ($lista['pagamento']) {
		case '1':
			$tipo_pagamento = 'PagSeguro';
			break;
		case '2':
			$tipo_pagamento = 'Cartão de Crédito';
			break;
		case '3':
			$tipo_pagamento = 'Boleto Bancário';
			break;
	}
	$itens = CRUD::SelectOne('pedido_item','id_pedido',$lista['id']);
	foreach ($itens['dados'] as $lista_itens) {
		$atributos = '';
		if($lista_itens['tipo'] == 0) {
			$produtos = CRUD::SelectOne('produtos','id',$lista_itens['id_produto']);
			$id_colecao = explode(',',$produtos['dados'][0]['colecao']);
			$colecao = CRUD::SelectOne('colecoes','id',$id_colecao[0]);
			$preco = $lista_itens['valor'];
			$valor_produto = $lista_itens['qtd'] * $preco;
			if($lista_itens['atributos'] != '') {
				$atts = explode(',', $lista_itens['atributos']);
				foreach ($atts as $lista_atributos) {
					$att = CRUD::SelectOne('acabamentos','id',$lista_atributos);
					$grupo = CRUD::SelectOne('acabamentos_grupo','id',$att['dados'][0]['grupo']);
					$atributos .= $grupo['dados'][0]['nome'].': '.$att['dados'][0]['nome'].'<br/>';
				}
			}
		}
		else if($lista_itens['tipo'] == 1) {
			$produtos = CRUD::SelectOne('produtos','id',$lista_itens['id_produto']);
			$id_colecao = explode(',',$produtos['dados'][0]['colecao']);
			$colecao = CRUD::SelectOne('colecoes','id',$id_colecao[0]);
			$preco = $lista_itens['valor'];
			$valor_produto = $lista_itens['qtd'] * $preco;
			$atributos = $lista_itens['atributos'];
		}

		$html .= '<tr>';
			$html .= '<td>'.utf8_decode($lista['id']).'</td>';
			$html .= '<td>'.utf8_decode(date('d/m/Y' ,strtotime($lista['data']))).'</td>';
			$html .= '<td>'.utf8_decode($lista['tipo_frete']).'</td>';
			$html .= '<td>'.utf8_decode($lista['frete']).'</td>';
			$html .= '<td>'.utf8_decode($lista['prazo_frete']).'</td>';
			$html .= '<td>'.utf8_decode($lista['rastreio']).'</td>';
			$html .= '<td>'.utf8_decode($tipo_pagamento).'</td>';
			$html .= '<td>R$ '.utf8_decode(number_format($lista['valor'],2,',','.')).'</td>';
			$html .= '<td>'.utf8_decode($lista['cupom']).'</td>';
			$html .= '<td>'.utf8_decode($status['dados'][0]['status']).'</td>';
			$html .= '<td>'.utf8_decode($cliente['dados'][0]['nome']).'</td>';
			$html .= '<td>'.utf8_decode($produtos['dados'][0]['nome']).'</td>';
			$html .= '<td>'.utf8_decode($produtos['dados'][0]['referencia']).'</td>';
			$html .= '<td>'.utf8_decode($colecao['dados'][0]['nome']).'</td>';
			$html .= '<td>'.utf8_decode($lista_itens['qtd']).'</td>';
			$html .= '<td>'.utf8_decode($atributos).'</td>';
		$html .= '</tr>';
		$cont++;
	}
}
$html .= '</table>';

// CONFIGURAÇÃO DO HEADER PARA FORÇAR DOWNLOAD
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