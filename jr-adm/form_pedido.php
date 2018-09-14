<?php include("templates/header.php"); ?>
<?php 
	$select_menu = 'pedido';
	$select_submenu = "pedido_todos"; 
?>
<?php include("templates/menu.php"); ?>
<?php
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$pedido = CRUD::SelectOne('pedido','id',$id);
		$cliente = CRUD::SelectOne('cliente','id',$pedido['dados'][0]['id_cliente']);
		$cliente_entrega = CRUD::SelectOne('cliente_endereco','id',$pedido['dados'][0]['id_endereco']);
		$complemento = ($cliente_entrega['dados'][0]['complemento'] == '') ? '' : ' - '.$cliente_entrega['dados'][0]['complemento'];
		$botao = 'Atualizar';
		switch ($pedido['dados'][0]['pagamento']) {
			case '1':
				$pagamento = 'Pagseguro';
				break;
			case '2':
				$pagamento = 'Cartão de Crédito';
				break;
			case '3':
				$pagamento = 'Boleto Bancário';
				break;
			default:
				$pagamento = 'Boleto Bancário';
				break;
		}
	}
?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Pedido #<?php echo $id ?></h1>
					</div>
				</div><!-- END Page Title -->

				<!-- BEGIN Breadcrumb -->
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<span class="divider"><i class="icon-angle-right"></i></span>
						</li>
						<li class="active">Pedidos</li>
					</ul>
				</div>
				<!-- END Breadcrumb -->

				<div class="row-fluid">
					<div class="span6">
						<div class="box box-black">
							<div class="box-title">
								<h3><i class="icon-building"></i>Dados do Cliente</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<address>
									<strong><?php echo $cliente['dados'][0]['nome'] ?></strong><br>
									Telefone: <?php echo $cliente['dados'][0]['telefone'] ?><br/>
									Telefone 2: <?php echo $cliente['dados'][0]['celular'] ?><br/>
									RG: <?php echo $cliente['dados'][0]['rg'] ?><br/>
									CPF: <?php echo $cliente['dados'][0]['cpf'] ?><br/>
								</address>

								<address>
									<strong>E-mail</strong><br>
									<a href="mailto:<?php echo $cliente['dados'][0]['email'] ?>"><?php echo $cliente['dados'][0]['email'] ?></a>
								</address>
							</div>
						</div>
					</div>

					<div class="span6">
						<div class="box box-black">
							<div class="box-title">
								<h3><i class="icon-home"></i>Endereço de Entrega</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<address>
									<strong><?php echo $cliente_entrega['dados'][0]['identificacao'] ?></strong><br>
									<?php echo $cliente_entrega['dados'][0]['rua'].', '.$cliente_entrega['dados'][0]['numero'].$complemento ?><br>
									Bairro: <?php echo $cliente_entrega['dados'][0]['bairro'] ?><br>
									<?php echo $cliente_entrega['dados'][0]['cidade'].'/'.$cliente_entrega['dados'][0]['estado'] ?><br>
									CEP: <?php echo $cliente_entrega['dados'][0]['cep'] ?><br>
								</address>

							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-shopping-cart"></i> Produtos Comprados</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Produto</th>
											<th>Referência</th>
											<th>Quantidade</th>
											<th>Valor</th>
											<th>Atributos</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$itens = CRUD::SelectOne('pedido_item','id_pedido',$id);
											foreach ($itens['dados'] as $lista_produtos) {
												$atributos = '';
												if($lista_produtos['tipo'] == 0) {
													$produto = CRUD::SelectOne('produtos','id',$lista_produtos['id_produto']);
													$preco = $lista_produtos['valor'];
													$valor_produto = $lista_produtos['qtd'] * $preco;
													if($lista_produtos['atributos'] != '') {
														$atts = explode(',', $lista_produtos['atributos']);
														foreach ($atts as $lista_atributos) {
															$att = CRUD::SelectOne('acabamentos','id',$lista_atributos);
															$grupo = CRUD::SelectOne('acabamentos_grupo','id',$att['dados'][0]['grupo']);
															$atributos .= $grupo['dados'][0]['nome'].': '.$att['dados'][0]['nome'].'<br/>';
														}
													}
												}
												else if($lista_produtos['tipo'] == 1) {
													$produto = CRUD::SelectOne('produtos','id',$lista_produtos['id_produto']);
													$preco = $lista_produtos['valor'];
													$valor_produto = $lista_produtos['qtd'] * $preco;
													$atributos = $lista_produtos['atributos'];
												}
										?>
										<tr>
											<td><?php echo $produto['dados'][0]['id'] ?></td>
											<td><?php echo $produto['dados'][0]['nome'] ?></td>
											<td><?php echo $produto['dados'][0]['referencia'] ?></td>
											<td><?php echo $lista_produtos['qtd'] ?></td>
											<td>R$ <?php echo number_format($lista_produtos['valor'],2,',','.') ?></td>
											<td><?php echo $atributos; ?></td>
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

				<div class="row-fluid">
					<div class="span12">
						<div class="box box-red">
							<div class="box-title">
								<h3><i class="icon-truck"></i> Dados da Entrega</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<table class="table">
									<thead>
										<tr>
											<th>Data de Entrega</th>
											<th>Tipo de Frete</th>
											<th>Prazo</th>
											<th>Valor Frete</th>
											<th>Número de Rastreio</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $pedido['dados'][0]['data_entrega'] ?></td>
											<td><?php echo $pedido['dados'][0]['tipo_frete'] ?></td>
											<td><?php echo $pedido['dados'][0]['prazo_frete'] ?> dia(s)</td>
											<td>R$ <?php echo number_format($pedido['dados'][0]['frete'], 2, ',', '.') ?></td>
											<td><input type="text" value="<?php echo $pedido['dados'][0]['rastreio'] ?>" name="rastreio" id="rastreio" data-pedido="<?php echo $id; ?>"><button id="salvar_rastreio">salvar</button></td>
											<td id="rastreioa"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="box box-green">
							<div class="box-title">
								<h3><i class="icon-money"></i> Dados do Pagamento</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<table class="table">
									<thead>
										<tr>
											<th>Forma de Pagamento</th>
											<th>Status</th>
											<th>Desconto</th>
											<th>Valor Final do Pedido</th>
											<th>Valor Pedido Sem Frete</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $pagamento ?><br/><a target="_blank" href="<?php echo URLBASE.'gsj-adm/pagar_boleto.php?id='.$_GET['id'].'&cliente='.$cliente['dados'][0]['id'] ?>">Gerar Boleto</a></td>
											<td>
												<select name="pg_status" id="pg_status" data-pedido="<?php echo $id; ?>">
													<?php 
														$status = CRUD::Select('status');
														foreach ($status['dados'] as $lista_status) {
													?>
													<option value="<?php echo $lista_status['id'] ?>" <?php if($lista_status['id'] == $pedido['dados'][0]['status']) { echo 'selected="selected"'; } ?>><?php echo $lista_status['status'] ?></option>
													<?php
														}
													?>
												</select>
												<button id="salvar_pg_status">salvar</button>
											</td>
											<td>R$ <?php echo number_format($pedido['dados'][0]['desconto'], 2, ',', '.') ?></td>
											<td>R$ <?php echo number_format($pedido['dados'][0]['valor'], 2, ',', '.') ?></td>
											<td>R$ <?php echo number_format($pedido['dados'][0]['valor']-$pedido['dados'][0]['frete'], 2, ',', '.') ?></td>
											<td id="pg_statusa"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div id="ordem"></div>
                <!-- END Main Content -->

				<?php include('templates/footer.php'); ?>
