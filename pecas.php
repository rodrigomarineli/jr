<?php
	include('templates/includes.php');
	extract($_GET);
	$arrayCategorias = array();
	$getCategoria = CRUD::SelectOne('pecas_categorias','url',$url);
	array_push($arrayCategorias,$getCategoria['dados'][0]['id']);
	$getCategoriaFilho = CRUD::SelectOne('pecas_categorias','pai',$getCategoria['dados'][0]['id']);
	foreach ($getCategoriaFilho['dados'] as $listaGetCategoriaFilho) {
		array_push($arrayCategorias,$listaGetCategoriaFilho['id']);
	}
	$stringCategorias = implode(',',$arrayCategorias);
	// $paginaExtra = CRUD::SelectOne('paginas_extra','id_paginas',$pagina['dados'][0]['id']);
	// if($paginaExtra['num'] > 0)
	// 	$paginaExtraAccordion = CRUD::SelectOne('paginas_extra_accordion','id_paginas_extra',$paginaExtra['dados'][0]['id'],'ordem ASC');

	$title = ($produto['dados'][0]['title'] != '') ? $produto['dados'][0]['title'] : $title;
	$meta = ($produto['dados'][0]['meta'] != '') ? $produto['dados'][0]['meta'] : $meta;
	$outras = ($produto['dados'][0]['outras'] != '') ? $produto['dados'][0]['outras'] : $outras;

	if(isset($url))
		$urlFiltro = $url.'/';
	else
		$urlFiltro = '';
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
					<a href="<?php echo URLBASE.'pecas-e-acessorios' ?>">Peças e Acessórios</a>
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
											$menuProdutos = CRUD::SelectOne('pecas_categorias','pai',0,'ordem ASC');
											foreach ($menuProdutos['dados'] as $listaMenuProdutos) {
												echo '<li class="item-toggle-tab">';
												$subMenuProdutos = CRUD::SelectOne('pecas_categorias','pai',$listaMenuProdutos['id'],'ordem ASC');
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
								<form action="<?php echo URLBASE.'busca' ?>" class="wg-search-form" method="get">
									<input type="text" name="s" placeholder="Buscar..." />
									<input type="submit" value=""/>
								</form>
							</div>
							<!-- End Widget -->
						</div>
					</div>
					<div class="col-md-9 col-sm-8 col-xs-12">
						<div class="content-blog-page">
							<div class="title-page">
								<div class="row">
									<div class="col-md-12">
										<h2 class="title30 font-bold text-uppercase pull-left dark"><?php echo $getCategoria['dados'][0]['nome'] ?></h2>
										<ul class="sort-pagi-bar list-inline-block pull-right">
											<li>
												<div class="sort-by">
													<span class="gray">Itens por página:</span>
													<div class="select-box inline-block">
														<select class="qtdPag">
															<option <?php if($limit == 12) echo 'selected'; ?> value="<?php echo URLBASE.'pecas-e-acessorios/'.$urlFiltro.'limit/12' ?>">12</option>
															<option <?php if($limit == 16) echo 'selected'; ?> value="<?php echo URLBASE.'pecas-e-acessorios/'.$urlFiltro.'limit/16' ?>">16</option>
															<option <?php if($limit == 20) echo 'selected'; ?> value="<?php echo URLBASE.'pecas-e-acessorios/'.$urlFiltro.'limit/20' ?>">20</option>
															<option <?php if($limit == 24) echo 'selected'; ?> value="<?php echo URLBASE.'pecas-e-acessorios/'.$urlFiltro.'limit/24' ?>">24</option>
														</select>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- End Title Page -->
							<div class="product-list-view">
								<div class="row">
									<div class="col-md-12">
										<?php
											if(isset($limit)) {
												$urlPag = URLBASE.'pecas-e-acessorios/'.$urlFiltro.'limit/'.$limit.'/';
											} else {
												$urlPag = URLBASE.'pecas-e-acessorios/';
											}

											if(isset($url)) {
												$sql = 'SELECT * FROM pecas WHERE categoria IN ('.$stringCategorias.')';
												$produtos = CRUD::SelectExtra($sql);
												$urlPag = $urlPag.'/pag/';
											}
											else {
												$sql = 'SELECT * FROM pecas';
												$produtos = CRUD::SelectExtra($sql);
												$urlPag = $urlPag.'pag/';
											}

											$qtd_pag = (!isset($limit)) ? 12 : (int)$limit;
											$pag = (isset($_GET['pag'])) ? $_GET['pag'] : 1;
											$total = $produtos['num'];
											
											$ordem = 'id DESC';
											
											$paginacao = Geral::Paginacao($qtd_pag,$total,$pag,$urlPag);

											$listagem = CRUD::SelectExtraLimit($sql,$paginacao['limit'],$paginacao['offset'],$ordem);
											foreach ($listagem['dados'] as $listaProdutos) {
												$fotos = CRUD::SelectOne('pecas_fotos','id_pecas',$listaProdutos['id'],'ordem ASC');
										?>
										<div class="item-product item-product1 item-product-list">
											<div class="row">
												<div class="col-md-4 col-sm-4 col-xs-12">
													<div class="product-thumb">
														<a href="#" class="product-thumb-link zoom-thumb"><img src="<?php echo URLBASE.'images/produtos/fotos/'.$fotos['dados'][0]['imagem'] ?>" alt=""></a>
													</div>
												</div>
												<div class="col-md-8 col-sm-8 col-xs-12">
													<div class="product-info">
														<div class="table-custom title12">
															<div class="text-left">
																<a href="<?php echo URLBASE.'pecas-e-acessorios/'.$listaProdutos['url'] ?>" class="cat-parent title16 font-bold dark text-uppercase"><?php echo $listaProdutos['nome'] ?></a>
															</div>
														</div>
														<br/>
														<br/>
														<form method="post" action="<?php echo URLBASE.'carrinho' ?>">
															<ul class="wrap-qty-cart list-inline-block pull-left">
																<li><label class="title-attr">Qty:</label></li>
																<li>
																	<input type="hidden" name="acao" value="add">
																	<input type="hidden" name="tipo" value="2">
																	<input type="hidden" name="produto" value="<?php echo $listaProdutos['id'] ?>">
																	<div class="detail-qty border">
																		<a href="#" class="qty-up"><i class="fa fa-angle-up"></i></a>
																		<input type="hidden" class="qty-val-input" name="qtd" value="1">
																		<span class="qty-val">1</span>
																		<a href="#" class="qty-down"><i class="fa fa-angle-down"></i></a>
																	</div>
																</li>
																<li>
																	<button type="submit" class="addcart-link inline-block round title12 no-border">
																		<i class="fa fa-shopping-basket opacity"></i>
																	</button>
																</li>
															</ul>
														</form>
														<p class="product-desc desc dark opaci"><?php echo $listaProdutos['descricao'] ?></p>
														<a href="<?php echo URLBASE.'pecas-e-acessorios/'.$listaProdutos['url'] ?>" class="shop-button dark">SAIBA MAIS</a>
													</div>	
												</div>
											</div>
										</div>
										<?php
											}
										?>
									</div>
								</div>
								<?php echo $paginacao['html']; ?>
								<!-- <div class="pagi-nav text-right">
									<a href="#" class="current">1</a>
									<a href="#">2</a>
									<a href="#">3</a>
									<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
								</div> -->
								<!-- End Paginav -->
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