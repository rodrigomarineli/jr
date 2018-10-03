<?php
	include('templates/includes.php');
	extract($_GET);
	$pagina = CRUD::SelectOne('paginas','url',$url);
	$paginaExtra = CRUD::SelectOne('paginas_extra','id_paginas',$pagina['dados'][0]['id']);
	if($paginaExtra['num'] > 0)
		$paginaExtraAccordion = CRUD::SelectOne('paginas_extra_accordion','id_paginas_extra',$paginaExtra['dados'][0]['id'],'ordem ASC');

	$title = ($pagina['dados'][0]['title'] != '') ? $pagina['dados'][0]['title'] : $title;
	$meta = ($pagina['dados'][0]['meta'] != '') ? $pagina['dados'][0]['meta'] : $meta;
	$outras = ($pagina['dados'][0]['outras'] != '') ? $pagina['dados'][0]['outras'] : $outras;
?>
<?php
	include('templates/header.php');
?>
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about">
					<h2 class="title30 text-uppercase dark font-bold"><?php echo $pagina['dados'][0]['titulo'] ?></h2>
					<?php echo $pagina['dados'][0]['texto'] ?>
					<div class="about-why-choise">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<br/>
								<br/>
								<h2 class="title18 text-uppercase dark font-bold"><?php echo $paginaExtra['dados'][0]['titulo'] ?></h2>
								<?php echo $paginaExtra['dados'][0]['texto'] ?>
								<?php
									if($paginaExtraAccordion['num'] > 0) {
								?>
								<div class="about-accordion toggle-tab">
									<?php
										$x = 0;
										foreach ($paginaExtraAccordion['dados'] as $listaPaginaExtraAccordion) {
											$x++;
									?>
									<div class="item-toggle-tab <?php if($x == 1) { echo 'active'; } ?>">
										<div class="toggle-tab-title"><span class="bg-color"><i class="<?php echo $listaPaginaExtraAccordion['icone'] ?>"></i></span><h2 class="dark"><?php echo $listaPaginaExtraAccordion['titulo'] ?></h2></div>
										<p class="desc toggle-tab-content"><?php echo $listaPaginaExtraAccordion['texto'] ?></p>
									</div>
									<?php
										}
									?>
								</div>
								<?php
									}
								?>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<img src="<?php echo URLBASE.'images/pages/'.$pagina['dados'][0]['imagem'] ?>" alt="<?php echo $pagina['dados'][0]['titulo'] ?>" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<hr>
		</div>
	</section>
<?php include('templates/footer.php') ?>