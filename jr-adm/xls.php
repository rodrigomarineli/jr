<?php ob_start(); ?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php 
	$form = $_GET['form'];
	$form2 = $_GET['form2'];
	$id = $_GET['id'];
	$select_menu = $form;
	$select_submenu = $form."_todos"; 
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
	$arquivo = 'relatorio-'.$form.'.xls';

	// TABELA QUE SERÁ GERADA
	$html = '';
	$html .= '<table>';
	$html .= '<tr>';
		$html .= '<td><b>'.utf8_decode('Relatório de '.$form.'').'</b></tr>';
	$html .= '</tr>';
	$html .= '<tr>';
		$list = CRUD::SelectTwoMore('formularios_campos','id_formulario = '.$formulario['dados'][0]['id'],'ordem ASC');
		foreach ($list['dados'] as $lista) {
			$html .= '<td><b>'.utf8_decode($lista['label']).'</b></td>';
		}
	$html .= '</tr>';
	if(isset($_GET['form2']))
		$dados = CRUD::Select2($form,$table_form,$id);
	else
		$dados = CRUD::Select($table_form);

	foreach ($dados['dados'] as $lista_dados) {
		$html .= '<tr>';
		foreach ($list['dados'] as $lista) {
			switch ($lista['tipo']) {
				case 'file':
					$dado = $url_site.$formulario['dados'][0]['pasta'].'/'.$lista_dados[$lista['nome']];
					break;
				case 'select':
				case 'select2':
				case 'select-block':
				case 'select2-block':
					$select = CRUD::SelectTwoMore('formularios_campos_extras','id_campo = '.$lista['id'].' AND nome = '.$lista_dados[$lista['nome']]);
					if($select['num'] == 0){
						$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
						$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE id= ".$lista_dados[$lista['nome']]);
					}
					$dado = $select['dados'][0]['label'];
					break;
				case 'radio':
					$select = CRUD::SelectTwoMore('formularios_campos_extras','id_campo = '.$lista['id'].' AND nome = '.$lista_dados[$lista['nome']]);
					if($select['num'] == 0){
						$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
						$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
					}
					$dado = $select['dados'][0]['label'];
					break;
				case 'select-multiple':
					$lista_nome = str_replace('[]', '', $lista['nome']);
					$dados_lista_nome = explode(',', $lista_dados[$lista_nome]);
					$select = CRUD::SelectTwoMore('formularios_campos_extras','id_campo = '.$lista['id']);
					if($select['num'] == 0){
						$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
						$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
						foreach ($select['dados'] as $options) {
							if(in_array($options['nome'], $dados_lista_nome)){ 
								$valores .= $options['label'].', ';
							}
						}
					}
					$dado = $valores;
					unset($valores);
					break;
				case 'archive':
					$dado = '<a href="'.$url_site.$formulario['dados'][0]['pasta'].'/'.$lista_dados[$lista['nome']].'" target="_blank">'.$lista_dados[$lista['nome']].'</a>';
					break;
				default:
					$dado = $lista_dados[$lista['nome']];
					break;
			}
			$html .= '<td>'.utf8_decode($dado).'</td>';
		}
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