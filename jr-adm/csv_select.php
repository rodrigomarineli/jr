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

<?php
	extract($_POST);
	if ($_FILES[csv][size] > 0) { 

		//get the csv file 
		$file = $_FILES[csv][tmp_name]; 
		$handle = fopen($file,"r"); 
		$data = fgetcsv($handle,1000,";","'");
		 
		$uploaddir = 'arquivos/';
		$uploadfile = $uploaddir . $_FILES['csv']['name'];
		move_uploaded_file($_FILES['csv']['tmp_name'], $uploaddir . $_FILES['csv']['name']);
	} 
?>

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
								<h3><i class="icon-reorder"></i> Importar <?php echo $formulario['dados'][0]['nome'] ?></h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">

								<form action="<?php echo $url_site_admin.'csv/'.$form.'/csv_select'; ?>" class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">   
									<input type="hidden" name="arquivo" value="<?php echo $uploadfile ?>">

									<?php 
										$campos = CRUD::SelectOne('formularios_campos','id_formulario',$formulario['dados'][0]['id'],'ordem ASC');
										foreach ($campos['dados'] as $lista) {
									?>
									<div class="control-group">
										<label class="control-label"><?php echo $lista['label'] ?>:</label>
										<div class="controls">
											<select class="span6" data-placeholder="Choose a Category" tabindex="1" name="<?php echo $lista['nome'] ?>">
												<option value="">Select...</option>
												<?php 
													$cont = 0;
													foreach ($data as $colunas) { 
												?>
												<option value="<?php echo $cont ?>" ><?php echo $colunas ?></option>
												<?php
														$cont++;
													} 
												?>
											</select>
										</div>
									</div>
									<?php
										}
									?>

									<div class="form-actions">
										<input type="submit" class="btn btn-primary" name="salvar" value="salvar">
										<a href="<?php echo $url_site_admin.'list/'.$form ?>"><button type="button" class="btn">Cancelar</button></a>
									</div>
								</form>
								<?php
									if(isset($_POST['salvar'])){
										$truncate = CRUD::Truncate($formulario['dados'][0]['tabela']);
										$file = $arquivo; 
										$handle = fopen($file,"r"); 
										do { 
											if (($data[0]) && ($data[$nome] != 'Nome')) { 
												foreach ($_POST as $key => $value) {
													if($key != 'arquivo' && $key != 'salvar')
														$dados = $key.' = '.addslashes($data[$$key]);
												}
												$add = CRUD::InsertAjax($formulario['dados'][0]['tabela'],$dados);
											} 
										} while ($data = fgetcsv($handle,1000,";","'")); 
										header('Location: '.$url_site_admin.'list/'.$link_add);
									}
									function utf8Fix($msg){
										$accents = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç");
										$utf8 = array("Ã¡","Ã ","Ã¢","Ã£","Ã¤","Ã©","Ã¨","Ãª","Ã«","Ã­","Ã¬","Ã®","Ã¯","Ã³","Ã²","Ã´","Ãµ","Ã¶","Ãº","Ã¹","Ã»","Ã¼","Ã§","Ã","Ã€","Ã‚","Ãƒ","Ã„","Ã‰","Ãˆ","ÃŠ","Ã‹","Ã","ÃŒ","ÃŽ","Ã","Ã“","Ã’","Ã”","Ã•","Ã–","Ãš","Ã™","Ã›","Ãœ","Ã‡");
										$fix = str_replace($utf8, $accents, $msg);
										return $fix;
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- END Main Content -->
<?php require("templates/footer.php");?>