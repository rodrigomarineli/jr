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
								<h3><i class="icon-reorder"></i> Importar</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">

							<form action="<?php echo $url_site_admin.'csv/'.$form.'/csv_select'; ?>" class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">   
								<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />

								<div class="control-group">
									<label class="control-label">Selecionar arquivo</label>
									<div class="controls">
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<span class="btn btn-file">
												<span class="fileupload-new">Selecionar</span>
												<span class="fileupload-exists">Alterar</span>
												<input type="file" class="default" accept=".csv, application/vnd.ms-excel" name="csv">
											</span>
											<span class="fileupload-preview"></span>
											<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
										</div>
									</div>
								</div>

								<div class="form-actions">
									<input type="submit" class="btn btn-primary" name="bt_alt_df" value="Avançar">
									<a href="<?php echo $url_site_admin.'list/'.$form ?>"><button type="button" class="btn">Cancelar</button></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END Main Content -->
			<div id="ordem"></div>

<?php require("templates/footer.php");?>