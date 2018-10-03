<?php include("templates/header.php"); ?>
<?php 
	$select_menu = 'pedido';
	$select_submenu = "pedido_todos"; 
?>
<?php include("templates/menu.php"); ?>
<?php
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$pedido = CRUD::SelectOne('pedidos','id',$id);
		$cliente = CRUD::SelectOne('cliente','id',$pedido['dados'][0]['id_cliente']);
		$complemento = ($cliente['dados'][0]['complemento'] == '') ? '' : ' - '.$cliente['dados'][0]['complemento'];
		$botao = 'Atualizar';
	}
?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Orçamento #<?php echo $id ?></h1>
					</div>
				</div><!-- END Page Title -->

				<!-- BEGIN Breadcrumb -->
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<span class="divider"><i class="icon-angle-right"></i></span>
						</li>
						<li class="active">Orçamentos</li>
					</ul>
				</div>
				<!-- END Breadcrumb -->

				<div class="row-fluid">
					<div class="span12">
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
								</address>

								<address>
									<strong>E-mail</strong><br>
									<a href="mailto:<?php echo $cliente['dados'][0]['email'] ?>"><?php echo $cliente['dados'][0]['email'] ?></a>
								</address>

								<address>
									<?php echo $cliente['dados'][0]['endereco'].$complemento ?><br>
									<?php echo $cliente['dados'][0]['cidade_estado'] ?><br>
									CEP: <?php echo $cliente['dados'][0]['cep'] ?><br>
								</address>

								<address>
									<strong>OBS.:</strong><br>
									<?php echo $cliente['dados'][0]['obs'] ?>
								</address>
							</div>
						</div>
					</div>

				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-shopping-cart"></i> Produtos Orçados</h3>
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
											<th>Tipo</th>
											<th>Nome</th>
											<th>Quantidade</th>
											<th>Finalidade</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$itens = CRUD::SelectOne('pedidos_produtos','id_pedidos',$id);
											foreach ($itens['dados'] as $lista_produtos) {
												if($lista_produtos['tipo'] == 1) {
													$produto = CRUD::SelectOne('produtos','id',$lista_produtos['id_produto']);
													$tipo = "Produtos";
												}
												else if($lista_produtos['tipo'] == 2) {
													$produto = CRUD::SelectOne('pecas','id',$lista_produtos['id_produto']);
													$tipo = "Peças e Acessórios";
												}
										?>
										<tr>
											<td><?php echo $produto['dados'][0]['id'] ?></td>
											<td><?php echo $tipo ?></td>
											<td><?php echo $produto['dados'][0]['nome'] ?></td>
											<td><?php echo $lista_produtos['qtd'] ?></td>
											<?php
												if($lista_produtos['modo'] == 1) {
											?>
											<td>Compra</td>
											<?php } else if($lista_produtos['modo'] == 2) { ?>
											<td>Aluguel - De <?php echo date('d/m/Y', strtotime($lista_produtos['de'])) ?> até <?php echo date('d/m/Y', strtotime($lista_produtos['ate'])) ?></td>
											<?php } ?>
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

				<?php include('templates/footer.php'); ?>
