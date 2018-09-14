<?php include("templates/header.php"); ?>
<?php
	$form = $_GET['form'];
	$form2 = $_GET['form2'];
	$id = $_GET['id'];
	$id2 = $_GET['id2'];
	$select_menu = $form;
	$select_submenu = $form."_novo"; 
?>
<?php 
	if(isset($form)) {
		$table_form = (isset($form2)) ? $form.'_'.$form2 : $form;
		$formulario = CRUD::SelectOne('formularios','tabela',$table_form);
	}
	if(isset($id)) {
		$item = CRUD::SelectOne($table_form,'id',$id); 
	}
	$link_add = (isset($form2)) ? $form.'/'.$form2.'/'.$id2 : $form;
	if(($formulario['dados'][0]['mae'] != 0) && ($formulario['dados'][0]['menu'] == 1)){
		$menu_mae = CRUD::SelectOne('formularios','id',$formulario['dados'][0]['mae']);
		$select_menu = $menu_mae['dados'][0]['tabela'];
		$select_submenu = $form."_todos"; 
	}
?>
<?php include("templates/menu.php"); ?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Adicionar/Editar <?php echo $formulario['dados'][0]['nome'] ?></h1>
						<h4>Preencha os campos abaixo</h4>
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
						<li class="active">Adicionar/Editar <?php echo $formulario['dados'][0]['nome'] ?></li>
					</ul>
				</div><!-- END Breadcrumb -->

				<!-- BEGIN Main Content -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-reorder"></i> Dados</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
									
									<?php 
										$campos = CRUD::SelectOne('formularios_campos','id_formulario',$formulario['dados'][0]['id'],'ordem ASC');
										foreach ($campos['dados'] as $lista) {
											$youtube = ($lista['nome'] == 'youtube' && isset($id)) ? 'https://www.youtube.com/watch?v=' : '';
											if($lista['tipo'] == 'file'){
												$img_arquivo = ($lista['nome'] != 'thumb') ? $url_site.$formulario['dados'][0]['pasta'].'/'.$item['dados'][0][$lista['nome']] : $url_site.$formulario['dados'][0]['pasta'].'/thumb/'.$item['dados'][0][$lista['nome']];
												$txt_img = ($formulario['dados'][0]['size'] != '') ? $formulario['dados'][0]['size'] : 'no+image';
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
																<?php if($item['dados'][0][$lista['nome']] != '') { ?>
																<img src="<?php echo $img_arquivo ?>" alt="" />
																<?php } else { ?>
																<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=<?php echo $txt_img ?>" alt="">
																<?php } ?>
															</div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
															<div>
																<span class="btn btn-file"><span class="fileupload-new">Selecione a imagem</span>
																<span class="fileupload-exists">Alterar</span>
																<input type="file" class="default" name="<?php echo $lista['nome'] ?>" data-rule-required="true" /></span>
																<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
															</div>
														</div>
													</div>
												</div>
									<?php
											}
											if($lista['tipo'] == 'archive'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="input-append">
																<div class="uneditable-input">
																	<i class="icon-file fileupload-exists"></i> 
																	<span class="fileupload-preview"></span>
																</div>
																<span class="btn btn-file">
																	<span class="fileupload-new">Selecionar arquivo</span>
																	<span class="fileupload-exists">Alterar</span>
																	<input type="file" class="default" name="<?php echo $lista['nome'] ?>" id="imagem1" data-rule-required="true"/>
																</span>
																<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
															</div>
														</div>
													</div>
												</div>
									<?php
											}
											if($lista['tipo'] == 'archive-multiple'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="input-append">
																<div class="uneditable-input">
																	<i class="icon-file fileupload-exists"></i> 
																	<span class="fileupload-preview"></span>
																</div>
																<span class="btn btn-file">
																	<span class="fileupload-new">Selecionar arquivo</span>
																	<span class="fileupload-exists">Alterar</span>
																	<input type="file" class="default" name="<?php echo $lista['nome'] ?>" id="imagem1" data-rule-required="true" multiple/>
																</span>
																<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
															</div>
														</div>
													</div>
												</div>
												<?php if(isset($id)) { ?>
												<div class="control-group">
													<label class="control-label">Arquivos já inseridos</label>
													<div class="controls">
														<table class="hidden table table-advance js-table-sortable" data-table="<?php echo $form.'_arquivos' ?>"></table>
														<?php
															$anexo = CRUD::SelectAnexo($form.'_arquivos','id_'.$form,$id);
															foreach ($anexo['dados'] as $lista) {
														?>
																<a class="btn btn-small btn-danger show-tooltip deleteitem" title="excluir" href="#" data-nome="<?php echo $lista['anexo'] ?>" data-item="<?php echo $lista['id'] ?>"><i class="icon-trash"></i></a> <?php echo $lista['nome'] ?><br/><br/>
														<?php
															}
														?>
													</div>
												</div>
												<?php } ?>
									<?php
											}
											else if($lista['tipo'] == 'ckeditor'){
									?>
												<div class="control-group">
													<label class="control-label" for="texto"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<div class="span12">
															<textarea class="span6 ckeditor" rows="3" name="<?php echo $lista['nome'] ?>" ><?php echo $item['dados'][0][$lista['nome']] ?></textarea>
														</div>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'textarea'){
									?>
												<div class="control-group">
													<label class="control-label" for="texto"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<div class="span12">
															<textarea class="span6" rows="10" cols="10" name="<?php echo $lista['nome'] ?>" ><?php echo $item['dados'][0][$lista['nome']] ?></textarea>
														</div>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'tags'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<input id="tag-input-1" type="text" name="<?php echo $lista['nome'] ?>" class="tags medium" value="<?php echo $item['dados'][0][$lista['nome']] ?>" />
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'time'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<div class="input-append">
															<input type="text" id="clockface_2" name="<?php echo $lista['nome'] ?>" value="<?php echo $item['dados'][0][$lista['nome']] ?>" class="small" readonly="" />
															<button class="btn" type="button" id="clockface_2_toggle-btn">
																<i class="icon-time"></i>
															</button>
														</div>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'text' || $lista['tipo'] == 'youtube'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<?php if((strpos($lista['nome'], 'valor')) !== false) { ?>
														<input type="text" name="<?php echo $lista['nome'] ?>" class="span6" value="<?php echo number_format($item['dados'][0][$lista['nome']],2,',','.')?>" />
														<?php } else { ?>
														<input type="text" name="<?php echo $lista['nome'] ?>" class="span6" value="<?php echo $youtube.$item['dados'][0][$lista['nome']] ?>" />
														<?php } ?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'oculto'){
												$oculto = ($item['dados'][0][$lista['nome']] == '') ? 0 : $item['dados'][0][$lista['nome']];
									?>
														<input type="hidden" name="<?php echo $lista['nome'] ?>" class="span6" value="<?php echo $oculto ?>" />
									<?php
											}
											else if($lista['tipo'] == 'select-block'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<?php 
															$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
															if($select['num'] == 0){
																$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE id = ".$item['dados'][0][$lista['nome']]);
															}
														?>
														<span class="help-inline"><?php echo $select['dados'][0]['label'] ?></span>
														<?php
														?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'select-multiple'){
												$lista_nome = str_replace('[]', '', $lista['nome']);
												$dados_lista_nome = explode(',', $item['dados'][0][$lista_nome]);
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<select class="chosen span6" tabindex="1" name="<?php echo $lista['nome'] ?>" multiple="multiple" data-placeholder="<?php echo $lista['label'] ?>">
															<?php 
																$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
																if($select['num'] == 0){
																	$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela`, `item` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																	if($tabela_vinculada['dados'][0]['item'] == '') {
																		$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
																	}
																	else {
																		$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE `id_item` = ".$tabela_vinculada['dados'][0]['item']);
																	}
																}
																foreach ($select['dados'] as $options) {
															?>
															<option value="<?php echo $options['nome'] ?>" <?php if(in_array($options['nome'], $dados_lista_nome)){ echo 'selected';} ?>><?php echo $options['label'] ?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'select2-block'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<?php 
															$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
															if($select['num'] == 0){
																$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																$select = CRUD::SelectExtra("SELECT titulo AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE id = ".$item['dados'][0][$lista['nome']]);
															}
														?>
														<span class="help-inline"><?php echo $select['dados'][0]['label'] ?></span>
														<!-- <input type="text" name="<?php echo $lista['nome'] ?>" class="span6" value="<?php echo $select['dados'][0]['label'] ?>" readonly /> -->
														<?php
														?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'text-block'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<span class="help-inline"><?php echo $item['dados'][0][$lista['nome']] ?></span>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'hidden'){
									?>
												<div class="control-group">
													<div class="controls">
														<input type="hidden" name="<?php echo $lista['nome'] ?>" class="span6" value="<?php echo $id2 ?>" />
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'password'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<input type="password" name="<?php echo $lista['nome'] ?>" class="span6" />
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'select'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<select class="span6" tabindex="1" name="<?php echo $lista['nome'] ?>">
															<?php 
																$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
																if($select['num'] == 0){
																	$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela`, `item` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																	if($tabela_vinculada['dados'][0]['item'] == '') {
																		if($lista['id'] == '62' || $lista['id'] == '91')
																			$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome, modelo FROM ".$tabela_vinculada['dados'][0]['tabela']);
																		else
																			$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
																	}
																	else {
																		$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE `id_item` = ".$tabela_vinculada['dados'][0]['item']);
																	}
																}
																foreach ($select['dados'] as $options) {
															?>
															<option value="<?php echo $options['nome'] ?>" <?php if($options['nome'] == $item['dados'][0][$lista['nome']]) { echo 'selected="selected"'; } ?>><?php echo $options['label'].' ('.$options['modelo'].')' ?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'select2'){
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<select class="span6" tabindex="1" name="<?php echo $lista['nome'] ?>">
															<option value="0"></option>
															<?php 
																$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
																if($select['num'] == 0){
																	$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																		$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
																}
																foreach ($select['dados'] as $options) {
															?>
															<option value="<?php echo $options['nome'] ?>" <?php if($options['nome'] == $item['dados'][0][$lista['nome']]) { echo 'selected="selected"'; } ?>><?php echo $options['label'] ?></option>
															<?php
																}
															?>
														</select>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'checkbox'){
												$lista_nome = str_replace('[]', '', $lista['nome']);
												$dados_lista_nome = explode(',', $item['dados'][0][$lista_nome]);
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<?php 
															$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
															if($select['num'] == 0){
																$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
															}
															foreach ($select['dados'] as $options) {
														?>
														<label class="checkbox">
															<input type="checkbox" value="<?php echo $options['nome'] ?>" name="<?php echo $lista['nome'] ?>" <?php if(in_array($options['nome'], $dados_lista_nome)){ echo 'checked';} ?> /> <?php echo $options['label'] ?>
														</label>
														<?php
															}
														?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'checkbox-group'){
												$lista_nome = str_replace('[]', '', $lista['nome']);
												$dados_lista_nome = explode(',', $item['dados'][0][$lista_nome]);
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<label class="checkbox">
															<input type="checkbox" class="select_none" value="0" name="<?php echo $lista['nome'] ?>" <?php if($item['dados'][0][$lista_nome] == '0'){ echo 'checked';} ?> /> <strong>Nenhum atributo</strong>
														</label>
														<br/>
														<?php 
															$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
															if($select['num'] == 0){
																$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela`, `item` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																if($tabela_vinculada['dados'][0]['item'] != '') {
																	$tabela_vinculada2 = CRUD::SelectExtra("SELECT `tabela` FROM formularios WHERE `id` = ".$tabela_vinculada['dados'][0]['item']);
																	$select2 = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada2['dados'][0]['tabela']);
																}
															}
															foreach ($select2['dados'] as $options2) {
																$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome, grupo FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE grupo = ".$options2['nome']);
														?>
														<label class="checkbox">
															<input type="checkbox" class="select_all" data-select="<?php echo $options2['nome'] ?>" value="<?php echo $options2['nome'] ?>" name="<?php echo 'no_post_'.$options2['nome'] ?>" /> <strong>Selecionar Todos (<?php echo $options2['label'] ?>)</strong>
														</label>
														<?php
																foreach ($select['dados'] as $options) {
														?>
														<label class="checkbox">
															<input type="checkbox" class="none all_<?php echo $options2['nome'] ?>" value="<?php echo $options['nome'] ?>" name="<?php echo $lista['nome'] ?>" <?php if(in_array($options['nome'], $dados_lista_nome)){ echo 'checked';} ?> /> <?php echo $options['label'] ?>
														</label>
														<?php
																}
																echo '<br/>';
															}
														?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'checkbox-group-input'){
												$cont = -1;
												$lista_nome = str_replace('[]', '', $lista['nome']);
												$dados_lista_nome = explode(',', $item['dados'][0][$lista_nome]);
												$dados_lista_nome_estoque = explode(',', $item['dados'][0]['estoque_'.$lista_nome]);
									?>
												<div class="control-group">
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls">
														<label class="checkbox">
															<input type="checkbox" class="select_none" value="0" name="<?php echo $lista['nome'] ?>" <?php if($item['dados'][0][$lista_nome] == '0'){ echo 'checked';} ?> /> <strong>Nenhum atributo</strong>
														</label>
														<br/>
														<?php 
															$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
															if($select['num'] == 0){
																$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela`, `item` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																if($tabela_vinculada['dados'][0]['item'] != '') {
																	$tabela_vinculada2 = CRUD::SelectExtra("SELECT `tabela` FROM formularios WHERE `id` = ".$tabela_vinculada['dados'][0]['item']);
																	$select2 = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada2['dados'][0]['tabela']);
																}
															}
															foreach ($select2['dados'] as $options2) {
																$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome, grupo FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE grupo = ".$options2['nome']);
														?>
														<label class="checkbox">
															<input type="checkbox" class="select_all" data-select="<?php echo $options2['nome'] ?>" value="<?php echo $options2['nome'] ?>" name="<?php echo 'no_post_'.$options2['nome'] ?>" /> <strong>Selecionar Todos (<?php echo $options2['label'] ?>)</strong>
														</label>
														<?php
																foreach ($select['dados'] as $options) {
																	if(in_array($options['nome'], $dados_lista_nome))
																		$cont++;
																		if(isset($id))
																			$estoque = CRUD::SelectTwoMore($form.'_'.$tabela_vinculada['dados'][0]['tabela'],'id_produto = '.$id.' AND id_acabamento = '.$options['nome'],'estoque ASC');
														?>
														<label class="checkbox">
															<input type="checkbox" class="none all_<?php echo $options2['nome'] ?>" value="<?php echo $options['nome'] ?>" name="<?php echo $lista['nome'] ?>" <?php if(in_array($options['nome'], $dados_lista_nome)){ echo 'checked';} ?> /> <?php echo $options['label'] ?> <input type="text" placeholder="estoque" name="<?php echo 'estoque_'.$lista['nome'] ?>" value="<?php if(in_array($options['nome'], $dados_lista_nome)){ echo $estoque['dados'][0]['estoque'];} ?>">
														</label>
														<?php
																}
																echo '<br/>';
															}
														?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'radio'){
									?>
												<div class="control-group" <?php if($lista['nome'] == 'icone') { echo 'id="font_extra"'; } ?>>
													<label class="control-label"><?php echo $lista['label'] ?>:</label>
													<div class="controls" >
														<?php 
															$select = CRUD::SelectOne('formularios_campos_extras','id_campo',$lista['id'],'ordem ASC');
															if($select['num'] == 0){
																$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela`, `item` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
																if($tabela_vinculada['dados'][0]['item'] == '') {
																	$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']);
																}
																else {
																	$select = CRUD::SelectExtra("SELECT nome AS label, id AS nome FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE `id_item` = ".$tabela_vinculada['dados'][0]['item']);
																}
															}
															foreach ($select['dados'] as $options) {
																$label = ($lista['nome'] == 'icone') ? '<i class="'.$options['label'].'"></i>' : $options['label'];
																$value = ($lista['nome'] == 'icone') ? $options['label'] : $options['nome'];
														?>
														<label class="radio">
															<input type="radio" name="<?php echo $lista['nome'] ?>" value="<?php echo $value ?>" <?php if($value == $item['dados'][0][$lista['nome']]){ echo 'checked';} ?> /> <?php echo $label ?>
														</label>
														<?php
															}
														?>
													</div>
												</div>
									<?php
											}
											else if($lista['tipo'] == 'galeria'){
									?>
												<ul class="gallery">
												<?php 
													$tabela_vinculada = CRUD::SelectExtra("SELECT `tabela`, `pasta` FROM formularios_campos_vinculado AS A INNER JOIN formularios AS B ON B.`id` = A.`id_formulario_vinculado` WHERE A.`id_campo_principal` = ".$lista['id']);
													$select = CRUD::SelectExtra("SELECT * FROM ".$tabela_vinculada['dados'][0]['tabela']." WHERE id_".$form." = ".$item['dados'][0]['id']);
													foreach ($select['dados'] as $options) {
														$img = (pathinfo($url_site.$tabela_vinculada['dados'][0]['pasta'].'/'.$options['arquivo']));
														$ext = array('jpg','png','jpeg');
														$nome_arquivo = (in_array($img['extension'], $ext)) ? $options['arquivo'] : 'no-img.jpg';
												?>
													<li>
														<a href="<?php echo $url_site.$tabela_vinculada['dados'][0]['pasta'] ?>/<?php echo $nome_arquivo ?>" rel="prettyPhoto">
															<div>
																<img src="<?php echo $url_site.$tabela_vinculada['dados'][0]['pasta'] ?>/<?php echo $nome_arquivo ?>" alt="" width="200" />
																<i></i>
															</div>
														</a>
														<div class="gallery-tools">
															<a href="<?php echo $url_site.$tabela_vinculada['dados'][0]['pasta'] ?>/<?php echo $options['arquivo'] ?>" download="<?php echo $options['arquivo'] ?>"><i class="icon-cloud-download"></i></a>
															<a href="#" class="del_file" data-table="<?php echo $form.'_arquivos' ?>" data-item="<?php echo $options['id'] ?>" data-foto="<?php echo $options['arquivo'] ?>" data-pasta="../../../<?php echo $tabela_vinculada['dados'][0]['pasta'] ?>/"><i class="icon-trash"></i></a>
														</div>
													</li>
												<?php
													}
												?>
												</ul>
									<?php
											}
										}
									?>


									<div class="form-actions">
										<button type="submit" name="salvar" class="btn btn-primary">Atualizar</button>
										<a href="<?php echo $url_site_admin ?>list/<?php echo $link_add ?>" class="btn">Cancelar</a>
									</div>
									<?php
										if(isset($_POST['salvar'])){
											$salvar = CRUD::Insert($formulario['dados'][0]['tabela'],$_GET['id'],'../'.$formulario['dados'][0]['pasta'],'no',$formulario['dados'][0]['thumb']);
											header('Location: '.$url_site_admin.'list/'.$link_add);
										}
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div id="ordem"></div>
<?php include('templates/footer.php'); ?>
