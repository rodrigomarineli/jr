<?php ob_start(); ?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php 
	$form = 'produtos';
?>
<?php 
	if(isset($form)) {
		$table_form = (isset($form2)) ? $form.'_'.$form2 : $form;
		$formulario = CRUD::SelectOne('formularios','tabela',$table_form);
	}
	$link_add = (isset($form2)) ? $form.'/'.$form2.'/'.$id : $form;
	if(($formulario['dados'][0]['mae'] != 0) && ($formulario['dados'][0]['menu'] == 1)){
		$menu_mae = CRUD::SelectOne('formularios','id',$formulario['dados'][0]['mae']);
		$select_menu = $menu_mae['dados'][0]['tabela'];
	}

	$cont = 1;
	// NOME DO ARQUIVO
	$arquivo = 'relatorio-estoque.xls';

	// TABELA QUE SERÁ GERADA
	$html = '';
	$html .= '<table>';
	$html .= '<tr>';
		$html .= '<td><b>'.utf8_decode('Relatório de Estoque').'</b></tr>';
	$html .= '</tr>';
	$html .= '<tr>';
	$html .= '<td><b>Produto</b></td>';
	$html .= '<td><b>'.utf8_decode('Referência').'</b></td>';
	$html .= '<td><b>'.utf8_decode('Coleção').'</b></td>';
	$html .= '<td><b>Atributo</b></td>';
	$html .= '<td><b>Estoque</b></td>';
	$html .= '</tr>';

	$list = CRUD::SelectTwoMore('produtos','atributos IS NULL OR atributos = ""','ordem ASC');
	foreach ($list['dados'] as $lista_dados) {
		$id_colecao = explode(',',$lista_dados['colecao']);
		$colecao = CRUD::SelectOne('colecoes','id',$id_colecao[0]);
		$html .= '<tr>';
		$html .= '<td>'.utf8_decode($lista_dados['nome']).'</td>';
		$html .= '<td>'.utf8_decode($lista_dados['referencia']).'</td>';
		$html .= '<td>'.utf8_decode($colecao['dados'][0]['nome']).'</td>';
		$html .= '<td> - </td>';
		$html .= '<td>'.utf8_decode($lista_dados['estoque']).'</td>';
		$html .= '</tr>';
	}

	$list = CRUD::SelectTwoMore('produtos','atributos != ""','ordem ASC');
	foreach ($list['dados'] as $lista_dados) {
		$id_colecao = explode(',',$lista_dados['colecao']);
		$colecao = CRUD::SelectOne('colecoes','id',$id_colecao[0]);
		$atributos = explode(',',$lista_dados['atributos']);
		foreach ($atributos as $lista_atributos) {
			$estoque_att = CRUD::SelectTwoMore('produtos_acabamentos','id_produto = '.$lista_dados['id'].' AND id_acabamento = '.$lista_atributos,'id_produto ASC');
			$att = CRUD::SelectOne('acabamentos','id',$lista_atributos);
			$grupo = CRUD::SelectOne('acabamentos_grupo','id',$att['dados'][0]['grupo']);
			$atts = $grupo['dados'][0]['nome'].': '.$att['dados'][0]['nome'].'<br/>';
			$html .= '<tr>';
			$html .= '<td>'.utf8_decode($lista_dados['nome']).'</td>';
			$html .= '<td>'.utf8_decode($lista_dados['referencia']).'</td>';
			$html .= '<td>'.utf8_decode($colecao['dados'][0]['nome']).'</td>';
			$html .= '<td>'.utf8_decode($atts).'</td>';
			$html .= '<td>'.utf8_decode($estoque_att['dados'][0]['estoque']).'</td>';
			$html .= '</tr>';
		}
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