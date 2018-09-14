<?php include("templates/header.php"); ?>
<?php 
	$select_menu = 'carrinho';
	$select_submenu = "carrinho_todos"; 
?>
<?php include("templates/menu.php"); ?>
<?php
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$pedido = CRUD::SelectOne('pre_pedido','id',$id);
		$cliente = CRUD::SelectOne('cliente','id',$pedido['dados'][0]['id_cliente']);
		$cliente_entrega = CRUD::SelectOne('cliente_endereco','id',$pedido['dados'][0]['id_endereco']);
		$complemento = ($cliente_entrega['dados'][0]['complemento'] == '') ? '' : ' - '.$cliente_entrega['dados'][0]['complemento'];
		$botao = 'Atualizar';
		switch ($pedido['dados'][0]['pagamento']) {
			case '1':
				$pagamento = 'Boleto Bancário';
				break;
			case '2':
				$pagamento = 'Cartão de Crédito';
				break;
			case '3':
				$pagamento = 'Pagseguro';
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
									Telefone: (<?php echo $cliente['dados'][0]['ddd_telefone'] ?>) <?php echo $cliente['dados'][0]['telefone'] ?><br/>
									Telefone 2: (<?php echo $cliente['dados'][0]['ddd_celular'] ?>) <?php echo $cliente['dados'][0]['celular'] ?><br/>
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
									<strong>Destinatário: </strong><?php echo $cliente_entrega['dados'][0]['informacoes'] ?><br><br>
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
											<th>Modelo</th>
											<th>Código</th>
											<th>Quantidade</th>
											<th>Valor</th>
											<th>Atributo 1</th>
											<th>Atributo 2</th>
											<th>Atributo 3</th>
											<th>Atributo 4</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$itens = CRUD::SelectOne('pre_pedido_item','id_pedido',$id);
											foreach ($itens['dados'] as $lista_itens) {
												$produtos = CRUD::SelectOne('produtos','id',$lista_itens['id_produto']);
												if($lista_itens['atributo_1'] != '') {
													$array = explode(',',$lista_itens['atributo_1']);
													$grupo = CRUD::SelectOne('acabamentos_grupo','id',$array[0]);
													$att = CRUD::SelectOne('acabamentos','id',$array[1]);
													$att1 = '<strong>'.$grupo['dados'][0]['nome'].'</strong> '.$att['dados'][0]['nome'];
												}
												if($lista_itens['atributo_2'] != '') {
													$array = explode(',',$lista_itens['atributo_2']);
													$grupo = CRUD::SelectOne('acabamentos_grupo','id',$array[0]);
													$att = CRUD::SelectOne('acabamentos','id',$array[1]);
													$att2 = '<strong>'.$grupo['dados'][0]['nome'].'</strong> '.$att['dados'][0]['nome'];
												}
												if($lista_itens['atributo_3'] != '') {
													$array = explode(',',$lista_itens['atributo_3']);
													$grupo = CRUD::SelectOne('acabamentos_grupo','id',$array[0]);
													$att = CRUD::SelectOne('acabamentos','id',$array[1]);
													$att3 = '<strong>'.$grupo['dados'][0]['nome'].'</strong> '.$att['dados'][0]['nome'];
												}
												if($lista_itens['atributo_4'] != '') {
													$array = explode(',',$lista_itens['atributo_4']);
													$grupo = CRUD::SelectOne('acabamentos_grupo','id',$array[0]);
													$att = CRUD::SelectOne('acabamentos','id',$array[1]);
													$att4 = '<strong>'.$grupo['dados'][0]['nome'].'</strong> '.$att['dados'][0]['nome'];
												}
										?>
										<tr>
											<td><?php echo $produtos['dados'][0]['id'] ?></td>
											<td><?php echo $produtos['dados'][0]['nome'] ?></td>
											<td><?php echo $produtos['dados'][0]['modelo'] ?></td>
											<td><?php echo $produtos['dados'][0]['codigo'] ?></td>
											<td><?php echo $lista_itens['qtd'] ?></td>
											<td>R$ <?php echo number_format($lista_itens['valor'],2,',','.') ?></td>
											<td><?php echo $att1; ?></td>
											<td><?php echo $att2; ?></td>
											<td><?php echo $att3; ?></td>
											<td><?php echo $att4; ?></td>
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
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $pedido['dados'][0]['data_entrega'] ?></td>
											<td><?php echo $pedido['dados'][0]['tipo_frete'] ?></td>
											<td><?php echo $pedido['dados'][0]['prazo_frete'] ?> dia(s)</td>
											<td>R$ <?php echo number_format($pedido['dados'][0]['frete'], 2, ',', '.') ?></td>
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
											<th>Desconto</th>
											<th>Valor Final do Pedido</th>
											<th>Valor Pedido Sem Frete</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $pagamento ?><br/><a target="_blank" href="<?php echo URLBASE.'miettie/pagar_boleto.php?id='.$_GET['id'].'&cliente='.$cliente['dados'][0]['id'] ?>">Gerar Boleto</a></td>
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
