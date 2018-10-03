<?php include("templates/header.php"); ?>
<?php 
$menu = "pedidos";
?>
<?php include("templates/menu.php"); ?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Orçamentos</h1>
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

				<!-- BEGIN Main Content -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-table"></i> Orçamentos</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<div class="btn-toolbar pull-right clearfix">
									<div class="btn-group">
										<a class="btn btn-circle" title="Exportar Orçamentos com Produtos" href="<?php echo $url_site_admin ?>xls_pedidos.php"><i class="icon-table"></i></a>
										<a class="btn btn-circle" title="Exportar Orçamentos" href="<?php echo $url_site_admin ?>xls_pedidos2.php"><i class="icon-shopping-cart"></i></a>
									</div>
								</div>
								<div class="clearfix"></div>
								<table class="table table-advance" id="table2" data-table="pedidos">
									<thead>
										<tr>
											<th>Orçamento #</th>
											<th>Cliente</th>
											<th>Data do Pedido</th>
											<th style="width:100px">Ação</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$lista = CRUD::Select('pedidos','id DESC');
											foreach ($lista['dados'] as $pedido) {
												$cliente = CRUD::SelectOne('cliente','id',$pedido['id_cliente']);
										?>
										<tr class="table-flag-blue">
											<td><?php echo $pedido['id'] ?></td>
											<td><?php echo $cliente['dados'][0]['nome'] ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($pedido['data'])) ?></td>
											<td>
												<div class="btn-group">
													<a class="btn btn-small" title="Visualizar" href="<?php echo $url_site_admin ?>form_pedido.php?id=<?php echo $pedido['id'] ?>"><i class="icon-zoom-in"></i></a>
													<a class="btn btn-small" title="Imprimir" href="<?php echo $url_site_admin ?>exportar_pedido_pdf.php?id=<?php echo $pedido['id'] ?>" target="_blank"><i class="icon-print"></i></a>
													<a class="btn btn-small btn-danger deleteitem" title="excluir" href="#" data-item="<?php echo $pedido['id'] ?>"><i class="icon-trash"></i></a>
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
				<div id="ordem"></div>
                <!-- END Main Content -->

				<?php include('templates/footer.php'); ?>
