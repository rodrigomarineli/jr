<?php include("templates/header.php"); ?>
<?php 
extract($_GET);
$select_menu = "menu";
$select_submenu = $tabela."_todos";
$formulario = CRUD::SelectOne('formularios','tabela',$tabela);
?>
<?php include("templates/menu.php"); ?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Menu - <?php echo $formulario['dados'][0]['nome'] ?></h1>
					</div>
				</div><!-- END Page Title -->

				<!-- BEGIN Breadcrumb -->
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<!-- <a href="#">Home</a> -->
							<span class="divider"><i class="icon-angle-right"></i></span>
						</li>
						<li class="active">Menu - <?php echo $formulario['dados'][0]['nome'] ?></li>
					</ul>
				</div>
				<!-- END Breadcrumb -->

				<!-- BEGIN Main Content -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-table"></i> Menu - <?php echo $formulario['dados'][0]['nome'] ?></h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<div class="btn-toolbar pull-right clearfix">
									<div class="btn-group">
										<a class="btn btn-circle show-tooltip" href="<?php echo $url_site_admin.'add/menu/'.$niveis.'/'.$tabela ?>"><i class="icon-plus"></i></a>
									</div>
								</div>
								<div class="clearfix"></div>
								<table class="table table-advance js-table-sortable" data-table="<?php echo $tabela ?>">
									<thead>
										<tr>
											<th>Nome</th>
											<?php if($niveis == 2 || $niveis == 3) { ?>
											<th>Submenu</th>
											<?php } ?>
											<?php if($niveis == 3) { ?>
											<th>Submenu Nivel 2</th>
											<?php } ?>
											<th>Ordem</th>
											<th style="width:100px">Ação</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$page = Menu::SelectMenu($tabela);
											foreach ($page as $lista) {
												$status_destaque = ($lista['nivel'] == 2) ? 'icon-check' : 'icon-check-empty';
												$status_destaque2 = ($lista['nivel'] == 3) ? 'icon-check' : 'icon-check-empty';
										?>
										<tr class="selectable" id="listItem_<?php echo $lista['id'] ?>">
											<td <?php if($lista['nivel'] == 2) { echo 'style="padding-left: 50px;"';} else if($lista['nivel'] == 3) { echo 'style="padding-left: 100px;"';}?>><?php echo $lista['titulo'].' '.$lista['subtitulo'] ?></td>
											<?php if($niveis == 2 || $niveis == 3) { ?>
											<td><a href="" class="addsubmenu destaque-item-<?php echo $lista['id'] ?>" data-item=<?php echo $lista['id'] ?> data-status=<?php echo $lista['nivel'] ?> data-campo='nivel'><i class="<?php echo $status_destaque ?>"></i></a></td>
											<?php } ?>
											<?php if( $niveis == 3) { ?>
											<td><a href="" class="addsubmenunivel2 destaque-item-<?php echo $lista['id'] ?>" data-item=<?php echo $lista['id'] ?> data-status=<?php echo $lista['nivel'] ?> data-campo='nivel'><i class="<?php echo $status_destaque2 ?>"></i></a></td>
											<?php } ?>
											<td class="js-sortable-handle"><a href=""><i class="icon-move"></i></a></td>
											<td>
												<div class="btn-group">
													<a class="btn btn-small btn-danger show-tooltip deleteitem"  href="#" data-item="<?php echo $lista['id'] ?>"><i class="icon-trash"></i></a>
													<a class="btn btn-small show-tooltip"  href="<?php echo $url_site_admin.'add/menu/'.$niveis.'/'.$tabela.'/'.$lista['id'] ?>"><i class="icon-edit"></i></a>
												</div>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
								<div class="form-actions">
									<a href="<?php echo $url_site_admin.'salva/menu/'.$niveis.'/'.$tabela ?>" class="btn btn-primary">Salvar</a>
								</div>
							</div>
						</div>
					</div>
				</div>
                <!-- END Main Content -->
				<div id="ordem"></div>
<?php include('templates/footer.php'); ?>