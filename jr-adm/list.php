<?php include("templates/header.php"); ?>
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
?>
<?php include("templates/menu.php"); ?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> <?php echo $formulario['dados'][0]['nome'] ?></h1>
					</div>
				</div><!-- END Page Title -->

				<!-- BEGIN Breadcrumb -->
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Home</a>
							<span class="divider"><i class="icon-angle-right"></i></span>
						</li>
						<li class="active"><?php echo $formulario['dados'][0]['nome'] ?></li>
					</ul>
				</div>
				<!-- END Breadcrumb -->

				<!-- BEGIN Main Content -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-table"></i> <?php echo $formulario['dados'][0]['nome'] ?></h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<div class="btn-toolbar pull-right clearfix">
									<?php 
										if ($formulario['dados'][0]['add'] == 1 || $formulario['dados'][0]['add'] == 3) { 
									?>
									<div class="btn-group">
										<a class="btn btn-circle show-tooltip" title="Adicionar <?php echo $formulario['dados'][0]['nome'] ?>" href="<?php echo $url_site_admin ?>add/<?php echo $link_add ?>"><i class="icon-plus"></i></a>
									</div>
									<?php 
										}
									?> 
									<?php if ($formulario['dados'][0]['exportar'] == 1) { ?>
									<div class="btn-group">
										<a class="btn btn-circle show-tooltip" title="Exportar" href="<?php echo $url_site_admin ?>xls/<?php echo $link_add ?>"><i class="icon-table"></i></a>
									</div>
									<?php } ?>
									<?php if ($formulario['dados'][0]['importar'] == 1) { ?>
									<div class="btn-group">
										<a class="btn btn-circle show-tooltip" title="Importar" href="<?php echo $url_site_admin ?>csv/<?php echo $link_add ?>"><i class="icon-upload-alt"></i></a>
									</div>
									<?php } ?>
									<?php
										if ($formulario['dados'][0]['filtro'] == 1) 
											$id_table = 'id="table1"';
									?>
								</div>
								<div class="clearfix"></div>
								<table class="table table-advance js-table-sortable" data-table="<?php echo $formulario['dados'][0]['tabela'] ?>" data-page="<?php echo $pagina[0]['id'] ?>" <?php echo $id_table ?>>
									<thead>
										<tr>
											<?php 
												$list = CRUD::SelectTwoMore('formularios_campos','visivel = 1 and id_formulario = '.$formulario['dados'][0]['id'],'ordem ASC');
												foreach ($list['dados'] as $lista) {
											?>
											<th><?php echo $lista['label'] ?></th>
											<?php
												}
											?>
											<?php if ($formulario['dados'][0]['ordenar'] == 1) { ?>
											<th>Ordem</th>
											<?php } ?>
											<th style="width:100px">Ação</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											if(isset($_GET['form2'])) {
												if ($formulario['dados'][0]['ordenar'] == 1) {
													$dados = CRUD::Select2($form,$table_form,$id,'ordem ASC');
												}
												else {
													$dados = CRUD::Select2($form,$table_form,$id);
												}
											}
											else {
												if ($formulario['dados'][0]['ordenar'] == 1) {
													$dados = CRUD::Select($table_form,'ordem ASC');
												}
												else {
													$dados = CRUD::Select($table_form);
												}
											}
											foreach ($dados['dados'] as $lista_dados) {
										?>
										<tr class="selectable" id="listItem_<?php echo $lista_dados['id'] ?>">
											<?php 
												foreach ($list['dados'] as $lista) {
													switch ($lista['tipo']) {
														case 'file':
															$dado = '<img src="'.$url_site.$formulario['dados'][0]['pasta'].'/'.$lista_dados[$lista['nome']].'" style="height: 150px;">';
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
														case 'youtube':
															$dado = '<iframe width="200" height="150" src="https://www.youtube.com/embed/'.$lista_dados[$lista['nome']].'" frameborder="0" allowfullscreen></iframe>';
															break;
														default:
															$dado = $lista_dados[$lista['nome']];
															break;
													}
											?>
											<?php
													if($lista['label'] == 'Destaque') {
														$status_destaque = ($lista_dados['destaque'] == 0) ? 'icon-star-empty' : 'icon-star';
											?>
											<td><a href="" class="destaque destaque-item-<?php echo $lista_dados['id'] ?>" data-item="<?php echo $lista_dados['id'] ?>" data-status="<?php echo $lista_dados['destaque'] ?>" data-campo='destaque'><i class="<?php echo $status_destaque ?>"></i></a></td>
											<?php
													}
													else if($lista['label'] == 'Destaque2') {
														$status_destaque2 = ($lista_dados['destaque2'] == 0) ? 'icon-star-empty' : 'icon-star';
											?>
											<td><a href="" class="destaque2 destaque-item2-<?php echo $lista_dados['id'] ?>" data-item="<?php echo $lista_dados['id'] ?>" data-status="<?php echo $lista_dados['destaque2'] ?>" data-campo='destaque2'><i class="<?php echo $status_destaque2 ?>"></i></a></td>
											<?php
													}
													else if($lista['label'] == 'Promoção') {
														$status_promocao = ($lista_dados['promocao'] == 0) ? 'icon-heart-empty' : 'icon-heart';
											?>
											<td><a href="" class="promocao promocao-item-<?php echo $lista_dados['id'] ?>" data-item="<?php echo $lista_dados['id'] ?>" data-status="<?php echo $lista_dados['promocao'] ?>" data-campo='promocao'><i class="<?php echo $status_promocao ?>"></i></a></td>
											<?php
													}
													else {
											?>
											<td><?php echo $dado ?></td>
											<?php
													}
												}
											?>
											<?php if ($formulario['dados'][0]['ordenar'] == 1) { ?>
											<td class="js-sortable-handle"><a href=""><i class="icon-move"></i></a></td>
											<?php } ?>
											<td>
												<div class="btn-group">
													<a class="btn btn-small show-tooltip" href="<?php echo $url_site_admin ?>add/<?php echo $link_add.'/'.$lista_dados['id'] ?>" title="Editar"><i class="icon-edit"></i></a>
													<?php
														$extra = CRUD::SelectTwoMore('formularios','mae = '.$formulario['dados'][0]['id'].' AND menu = 0','ordem ASC');
														foreach ($extra['dados'] as $lista_extra) {
															$link = ($lista_extra['link'] == '') ? $url_site_admin.$lista_extra['tabela'].'.php?id='.$lista_dados['id'] : $url_site_admin.$lista_extra['link'].'/'.$lista_dados['id'];
													?>
														<a class="btn btn-small show-tooltip" href="<?php echo $link ?>" title="<?php echo $lista_extra['nome'] ?>"><i class="<?php echo $lista_extra['icon'] ?>"></i></a>
													<?php
														}
													?>
													<?php if ($formulario['dados'][0]['delete'] == 1) { ?>
													<a class="btn btn-small btn-danger show-tooltip deleteitem" href="#" data-item="<?php echo $lista_dados['id'] ?>" title="Apagar"><i class="icon-trash"></i></a>
													<?php } ?>
												</div>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
                <!-- END Main Content -->
				<div id="ordem"></div>
<?php include('templates/footer.php'); ?>