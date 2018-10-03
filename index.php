<?php
	include('templates/includes.php');
	include('templates/header.php');
?>
	<section id="content">
		<div class="banner-slider banner-jewelry2 bg-slider parallax-slider">
			<div class="wrap-item" data-navigation="true" data-transition="fade" data-itemscustom="[[0,1]]">
				<?php
					$slider = CRUD::Select('slider','ordem ASC');
					foreach ($slider['dados'] as $listaSlider) {
				?>
				<div class="item-slider item-slider2">
					<div class="banner-thumb">
						<a href="<?php echo $listaSlider['link'] ?>"><img src="<?php echo URLBASE.'images/slider/'.$listaSlider['imagem'] ?>" alt="<?php echo $listaSlider['titulo'] ?>" /></a>
					</div>
					<div class="banner-info animated text-center" data-animated="zoomIn">
						<?php if($listaSlider['titulo']) { ?>
						<h2 class="title48 play-font font-normal text-uppercase white"><?php echo $listaSlider['titulo'] ?></h2>
						<?php } ?>
						<?php if($listaSlider['texto']) { ?>
						<h3 class="title18 play-font font-italic white"><?php echo $listaSlider['texto'] ?></h3>
						<?php } ?>
						<?php if($listaSlider['botao']) { ?>
						<a href="<?php echo $listaSlider['link'] ?>" class="border-button white title18"><?php echo $listaSlider['botao'] ?></a>
						<?php } ?>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
		<!-- End Banner Slider -->
		<div class="container">
			<div class="block-cate2">
				<div class="title-box2 text-center">
					<h2 class="title24 dark"><strong>PRODUTOS EM DESTAQUE</strong></h2>
					<hr class="hr-title">
					<?php
						$produtoTexto = CRUD::Select('produtos_texto');
					?>
					<?php echo $produtoTexto['dados'][0]['texto'] ?>
				</div>
				<div class="list-cat2">
					<div class="row">
						<?php
							$produto = CRUD::SelectLimitOne('produtos','destaque',1,6,0,'ordem ASC');
							foreach ($produto['dados'] as $listaProdutos) {
								$foto = CRUD::SelectOne('produtos_fotos','id_produtos',$listaProdutos['id']);
								$categoriaProduto = CRUD::SelectOne('produtos_categorias','id',$listaProdutos['categoria']);
						?>
						<div class="col-md-4 col-sm-6 col-xs-6 lista">
							<div class="item-cat2 text-center">
								<div class="cat-thumb"><a href="<?php echo URLBASE.'produtos/'.$categoriaProduto['dados'][0]['url'].'/'.$listaProdutos['url'] ?>"><img src="<?php echo URLBASE.'images/produtos/fotos/'.$foto['dados'][0]['imagem'] ?>" alt="<?php echo $listaProdutos['nome'] ?>" /></a></div>
								<div class="cat-info">
									<h3 class="title18 dark text-left"><strong><?php echo $listaProdutos['nome'] ?></strong></h3>
									<p class="dark opacity text-left"><?php echo $listaProdutos['descricao'] ?></p>
									<a href="<?php echo URLBASE.'produtos/'.$categoriaProduto['dados'][0]['url'].'/'.$listaProdutos['url'] ?>" class="title14 saiba-mais"><i class="fa fa-plus-circle"></i> SAIBA MAIS</a>
									<a href="<?php echo URLBASE.'produtos/'.$categoriaProduto['dados'][0]['url'].'/'.$listaProdutos['url'] ?>" class="title14 orcamento"><i class="fa fa-shopping-basket"></i> ORÇAMENTO</a>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<div class="block-cate2">
				<div class="title-box2 text-center">
					<h2 class="title24 dark"><strong>PEÇAS E ACESSÓRIOS EM DESTAQUE</strong></h2>
					<hr class="hr-title">
					<?php
						$pecasTexto = CRUD::Select('pecas_texto');
					?>
					<?php echo $pecasTexto['dados'][0]['texto'] ?>
				</div>
				<div class="list-cat2">
					<div class="row">
						<?php
							$pecas = CRUD::SelectLimitOne('pecas','destaque',1,6,0,'ordem ASC');
							foreach ($pecas['dados'] as $listaPecas) {
								$foto = CRUD::SelectOne('pecas_fotos','id_pecas',$listaPecas['id']);
								$categoriaPecas = CRUD::SelectOne('pecas_categorias','id',$listaPecas['categoria']);
						?>
						<div class="col-md-4 col-sm-6 col-xs-6 lista">
							<div class="item-cat2 text-center">
								<div class="cat-thumb"><a href="<?php echo URLBASE.'pecas-e-acessorios/'.$categoriaPecas['dados'][0]['url'].'/'.$listaPecas['url'] ?>"><img src="<?php echo URLBASE.'images/produtos/fotos/'.$foto['dados'][0]['imagem'] ?>" alt="<?php echo $listaPecas['nome'] ?>" /></a></div>
								<div class="cat-info">
									<h3 class="title18 dark text-left"><strong><?php echo $listaPecas['nome'] ?></strong></h3>
									<p class="dark opacity text-left"><?php echo $listaPecas['descricao'] ?></p>
									<a href="<?php echo URLBASE.'pecas-e-acessorios/'.$categoriaPecas['dados'][0]['url'].'/'.$listaPecas['url'] ?>" class="title14 saiba-mais"><i class="fa fa-plus-circle"></i> SAIBA MAIS</a>
									<a href="<?php echo URLBASE.'pecas-e-acessorios/'.$categoriaPecas['dados'][0]['url'].'/'.$listaPecas['url'] ?>" class="title14 orcamento"><i class="fa fa-shopping-basket"></i> ORÇAMENTO</a>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<!-- End Block Cate -->
			<div class="list-adv2">
				<div class="row">
					<?php
						$banner = CRUD::Select('banner','ordem ASC');
						foreach ($banner['dados'] as $listaBanner) {
					?>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="item-adv2 zoom-image fade-out-in">
							<a href="#" class="adv-thumb-link"><img src="<?php echo URLBASE.'images/banner/'.$listaBanner['imagem'] ?>" alt="" /></a>
							<div class="banner-info text-center">
								<?php if($listaBanner['titulo']) { ?>
								<h2 class="white title30 color-red font-bold"><?php echo $listaBanner['titulo'] ?></h2>
								<?php } ?>
								<?php if($listaBanner['texto']) { ?>
								<p class="desc white opaci color-black"><?php echo $listaBanner['texto'] ?></p>
								<?php } ?>
								<?php if($listaBanner['botao']) { ?>
								<a href="<?php echo $listaBanner['link'] ?>" class="border-button title14 color-black font-bold"><?php echo $listaBanner['botao'] ?></a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
			<!-- End Adv -->
		</div>
		<div class="container">
			<div class="list-service-footer">
				<h5 class="title22 dark no-padding padding-right padding-left"><strong><?php echo $dados_gerais['dados'][0]['titulo_home'] ?></strong></h5>
				<p class="title16 dark no-padding padding-right padding-left"><?php echo $dados_gerais['dados'][0]['texto_home'] ?></p>
				<a href="<?php echo $dados_gerais['dados'][0]['link_home'] ?>" class="title14 saiba-mais box"><i class="fa fa-plus-circle"></i> SAIBA MAIS</a>
			</div>
		</div>
	</section>
<?php include('templates/footer.php') ?>