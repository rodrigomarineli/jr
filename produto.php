<?php
	include('templates/includes.php');
	extract($_GET);
	$produto = CRUD::SelectOne('produtos','url',$url);
	$getCategoria = CRUD::SelectOne('produtos_categorias','url',$categoria);
	// $paginaExtra = CRUD::SelectOne('paginas_extra','id_paginas',$pagina['dados'][0]['id']);
	// if($paginaExtra['num'] > 0)
	// 	$paginaExtraAccordion = CRUD::SelectOne('paginas_extra_accordion','id_paginas_extra',$paginaExtra['dados'][0]['id'],'ordem ASC');

	$title = ($produto['dados'][0]['title'] != '') ? $produto['dados'][0]['title'] : $title;
	$meta = ($produto['dados'][0]['meta'] != '') ? $produto['dados'][0]['meta'] : $meta;
	$outras = ($produto['dados'][0]['outras'] != '') ? $produto['dados'][0]['outras'] : $outras;
?>
<?php
	include('templates/header.php');
?>
	<!-- End Header -->
	<section id="content">
		<div class="wrap-bread-crumb">
			<div class="container">
				<div class="bread-crumb">
					<a href="<?php echo URLBASE ?>">Home</a>
					<a href="<?php echo URLBASE.'produtos' ?>">Produtos</a>
					<strong><?php echo $getCategoria['dados'][0]['nome'] ?></strong>
				</div>
			</div>
		</div>
		<!-- End Bread Crumb -->
		<div class="content-page">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="sidebar sidebar-left">
							<div class="widget widget-category">
								<h2 class="widget-title title18 font-bold text-uppercase dark">Categorias</h2>
								<div class="widget-content">
									<ul class="list-category-toggle toggle-tab list-none">
										<h4 class="margin title14 font-bold text-uppercase dark">Produtos</h4>
										<?php
											$menuProdutos = CRUD::SelectOne('produtos_categorias','pai',0,'ordem ASC');
											foreach ($menuProdutos['dados'] as $listaMenuProdutos) {
												echo '<li class="item-toggle-tab">';
												$subMenuProdutos = CRUD::SelectOne('produtos_categorias','pai',$listaMenuProdutos['id'],'ordem ASC');
												if($subMenuProdutos['num'] > 0) {
													echo '<a href="#" class="toggle-tab-title">'.$listaMenuProdutos['nome'].'</a>';
													echo '<ul class="toggle-tab-content list-none">';
													foreach ($subMenuProdutos['dados'] as $listaSubMenuProdutos) {
														echo '<li><a href="'.URLBASE.'produtos/'.$listaSubMenuProdutos['url'].'">'.$listaSubMenuProdutos['nome'].'</a></li>';
													}
													echo '</ul>';
												} else {
													echo '<a href="'.URLBASE.'produtos/'.$listaMenuProdutos['url'].'">'.$listaMenuProdutos['nome'].'</a>';
												}
												echo '</li>';
											}
										?>
										<h4 class="margin title14 font-bold text-uppercase dark">Peças e Acessórios</h4>
										<?php
											$menuPecas = CRUD::SelectOne('pecas_categorias','pai',0,'ordem ASC');
											foreach ($menuPecas['dados'] as $listaMenuPecas) {
												echo '<li class="item-toggle-tab">';
												$subMenuPecas = CRUD::SelectOne('pecas_categorias','pai',$listaMenuPecas['id'],'ordem ASC');
												if($subMenuPecas['num'] > 0) {
													echo '<a href="#" class="toggle-tab-title">'.$listaMenuPecas['nome'].'</a>';
													echo '<ul class="toggle-tab-content list-none">';
													foreach ($subMenuPecas['dados'] as $listaSubMenuPecas) {
														echo '<li><a href="'.URLBASE.'pecas-e-acessorios/'.$listaSubMenuPecas['url'].'">'.$listaSubMenuPecas['nome'].'</a></li>';
													}
													echo '</ul>';
												}
												else {
													echo '<a href="'.URLBASE.'pecas-e-acessorios/'.$listaMenuPecas['url'].'">'.$listaMenuPecas['nome'].'</a>';
												}
												echo '</li>';
											}
										?>
									</ul>
								</div>
							</div>
							<!-- End Widget -->
							<div class="widget widget-search">
								<h2 class="widget-title title14 font-bold text-uppercase">PESQUISA</h2>
								<form class="wg-search-form" method="get">
									<input type="text" name="s" placeholder="Buscar..." />
									<input type="submit" value=""/>
								</form>
							</div>
							<!-- End Widget -->
						</div>
					</div>
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="content-page-detail">
							<div class="product-detail">
								<div class="row">
									<div class="col-md-5 col-sm-12 col-xs-12">
										<div class="detail-gallery">
											<div class="mid">
												<?php
													$fotos = CRUD::SelectOne('produtos_fotos','id_produtos',$produto['dados'][0]['id'],'ordem ASC');
												?>
												<img src="<?php echo URLBASE.'images/produtos/fotos/'.$fotos['dados'][0]['imagem'] ?>" alt=""/>
											</div>
											<div class="gallery-control">
												<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
												<div class="carousel" data-visible="5">
													<ul class="list-none">
														<?php
															$x = 0;
															foreach ($fotos['dados'] as $listaFotos) {
																$x++;
														?>
														<li><a href="#" <?php if($x == 0) { 'class="active"'; } ?>><img src="<?php echo URLBASE.'images/produtos/fotos/'.$listaFotos['imagem'] ?>" alt=""/></a></li>
														<?php
															}
														?>
													</ul>
												</div>
												<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
											</div>
										</div>
										<!-- End Gallery -->
										<div class="detail-share-social text-center">
											<span>Compartilhe</span>
											<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URLBASE.'produtos'.$categoria.'/'.$url ?>" class="float-shadow"><img src="<?php echo URLBASE ?>images/icon/icon-facebook.png" alt="" /></a>
											<a href="https://twitter.com/home?status=<?php echo URLBASE.'produtos'.$categoria.'/'.$url ?>" class="float-shadow"><img src="<?php echo URLBASE ?>images/icon/icon-twitter.png" alt="" /></a>
											<a href="https://pinterest.com/pin/create/button/?url=<?php echo URLBASE.'produtos'.$categoria.'/'.$url ?>&media=<?php echo URLBASE.'images/produtos/fotos/'.$fotos['dados'][0]['imagem'] ?>&description=<?php echo $produto['dados'][0]['nome'] ?>" class="float-shadow"><img src="<?php echo URLBASE ?>images/icon/icon-pinterest.png" alt="" /></a>
										</div>
									</div>
									<div class="col-md-7 col-sm-12 col-xs-12">
										<div class="detail-info">
											<form action="<?php echo URLBASE.'carrinho' ?>" method="post">
												<input type="hidden" name="acao" value="add">
												<input type="hidden" name="tipo" value="1">
												<input type="hidden" name="produto" value="<?php echo $produto['dados'][0]['id'] ?>">
												<h2 class="product-title title24 text-uppercase dark font-bold"><?php echo $produto['dados'][0]['nome'] ?></h2>
												<p class="desc product-desc"><?php echo $produto['dados'][0]['descricao'] ?></p>
												<div class="detail-attr qty-cart">
													<label class="title-attr">Quantidade:</label>
													<div class="detail-qty border">
														<a href="#" class="qty-up"><i class="fa fa-angle-up"></i></a>
														<input type="hidden" class="qty-val-input" name="qtd" value="1">
														<span class="qty-val">1</span>
														<a href="#" class="qty-down"><i class="fa fa-angle-down"></i></a>
													</div>
												</div>
												<button type="submit" class="shop-button bg-black addcart-link font-bold text-uppercase">SOLICITAR ORÇAMENTO</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- End Product Detail -->
							<div class="detail-tabs">
								<div class="detail-tab-title">
									<ul class="list-tag-detail list-none text-uppercase font-bold">
										<li class="active"><a href="#tab1" data-toggle="tab">Especificações</a></li>
										<li><a href="#tab2" data-toggle="tab">Vídeo</a></li>
										<li><a href="#tab3" data-toggle="tab">Download</a></li>
									</ul>
								</div>
								<div class="detail-tab-content">
									<div class="tab-content">
										<div id="tab1" class="tab-pane active">
											<div class="detail-addition">
												<?php echo $produto['dados'][0]['especificacoes'] ?>
											</div>
										</div>
										<div id="tab2" class="tab-pane">
											<div class="detail-tab-video">
												<?php echo $produto['dados'][0]['video'] ?>
											</div>
										</div>
										<div id="tab3" class="tab-pane">
											<div class="row">
												<div class="col-md-12">
													<h4>Arquivos disponíveis para Download:</h4>
												</div>
												<?php
													$arquivos = CRUD::SelectOne('produtos_arquivos','id_produtos',$produto['dados'][0]['id']);
													foreach ($arquivos['dados'] as $listaArquivos) {
												?>
												<div class="col-md-4">
													<h5 class="font-bold"><?php echo $listaArquivos['titulo'] ?></h5>
													<img src="<?php echo URLBASE.'images/produtos/arquivos/'.$listaArquivos['thumb'] ?>" alt="">
													<a href="<?php echo URLBASE.'images/produtos/arquivos/'.$listaArquivos['arquivos'] ?>" class="title14 orcamento download float-left"><i class="fa fa-download"></i> DOWNLOAD</a>
												</div>
												<?php
													}
												?>
											</div>
										</div>
									</div>
								</div>
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
	<!-- End Content -->
<?php include('templates/footer.php') ?>