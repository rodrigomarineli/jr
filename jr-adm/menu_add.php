<?php include("templates/header.php"); ?>
<?php
extract($_GET);
$menu = "sidebar";
?>
<?php include("templates/menu.php"); ?>
<?php 
	if(isset($_GET['id'])) {
		$slide = Menu::SelectMenu($tabela,$_GET['id']); 
	}
?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Adicionar/Editar Sidebar</h1>
						<h4>Preencha os campos abaixo</h4>
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
						<li class="active">Adicionar/Editar Banner de Sidebar</li>
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

									<div class="control-group">
										<label class="control-label">Título</label>
										<div class="controls">
											<input type="text" name="titulo" class="span6 show-tooltip" data-trigger="hover" data-original-title="Digite o titulo" value="<?php echo $slide[0]['titulo'] ?>" />                       
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Link</label>
										<div class="controls">
											<input type="text" name="link" class="span6 show-tooltip" data-trigger="hover" data-original-title="Digite o link" value="<?php echo $slide[0]['link'] ?>" />                       
										</div>
									</div>

									<!-- <div class="control-group">
										<label class="control-label">Imagem</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if($slide[0]['imagem'] != '') { ?>
													<img src="<?php echo URLBASE.'img/menu/'.$slide[0]['imagem'] ?>" alt="" />
													<?php } else { ?>
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=580x280" alt="">
													<?php } ?>
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-file"><span class="fileupload-new">Selecione a imagem</span>
													<span class="fileupload-exists">Alterar</span>
													<input type="file" class="default" name="imagem" data-rule-required="true" /></span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
												</div>
											</div>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Ícone</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
													<?php if($slide[0]['icone'] != '') { ?>
													<img src="<?php echo URLBASE.'img/menu/'.$slide[0]['icone'] ?>" alt="" />
													<?php } else { ?>
													<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=30x30" alt="">
													<?php } ?>
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-file"><span class="fileupload-new">Selecione a imagem</span>
													<span class="fileupload-exists">Alterar</span>
													<input type="file" class="default" name="icone" data-rule-required="true" /></span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
												</div>
											</div>
										</div>
									</div> -->

									<div class="form-actions">
										<button type="submit" name="salvar1" class="btn btn-primary">Atualizar</button>
										<a href="<?php echo $url_site_admin.'list/menu/'.$niveis.'/'.$tabela ?>" class="btn">Cancelar</a>
									</div>
									<?php
										if(isset($_POST['salvar1'])){
											extract($_POST);
											$salvar = Menu::AddMenu($tabela,$titulo,$link,$_GET['id']);
											header("location: ".$url_site_admin."list/menu/".$niveis."/".$tabela);
										}
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
<?php include('templates/footer.php'); ?>