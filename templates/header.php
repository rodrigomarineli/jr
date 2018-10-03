<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="<?php echo $meta ?>" />
	<meta name="keywords" content="BW Store,7uptheme" />
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />
	<title><?php echo $title ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7cPlayfair+Display:400,700,400i,700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/ionicons.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/bootstrap-theme.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/jquery.fancybox.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/jquery-ui.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/owl.carousel.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/owl.transitions.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/jquery.mCustomScrollbar.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/owl.theme.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/animate.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/libs/hover.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/theme.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/responsive.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?php echo URLBASE ?>css/browser.css" media="all"/>
	<!-- <link rel="stylesheet" type="text/css" href="css/rtl.css" media="all"/> -->
	<?php echo $outras ?>
</head>
<body class="preload">
<div class="wrap">
	<header id="header">
		<div class="top-header bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="hot-news pull-left">
							<ul>
								<?php
									$menuTopo = CRUD::Select('menu_topo','ordem ASC');
									foreach ($menuTopo['dados'] as $listaMenuTopo) {
								?>
								<li><a href="<?php echo $listaMenuTopo['link'] ?>"><?php echo $listaMenuTopo['titulo'] ?></a></li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<ul class="top-total-info list-inline-block pull-right">
							<li>
								<p class="desc black call-phone title12"><i class="fa fa-volume-control-phone"></i><span class="title18"><strong><?php echo $dados_gerais['dados'][0]['telefone'] ?></strong></span></p>
							</li>
							<li>
								<div class="top-social-network">
									<a href="<?php echo $dados_gerais['dados'][0]['facebook'] ?>" class="title12 black inline-block round"><i class="fa fa-facebook"></i></a>
									<a href="<?php echo $dados_gerais['dados'][0]['instragram'] ?>" class="title12 black inline-block round"><i class="fa fa-instagram"></i></a>
								</div>
							</li>
							<li>
								<?php
									if(isset($_SESSION[SESSION_CART]['cliente']['id'])) {
								?>
								<a href="#" class="title12 black link-account logado"><i class="fa fa-user"></i><span class="title14"><?php echo $_SESSION[SESSION_CART]['cliente']['nome'] ?></span></a>
								<a href="<?php echo URLBASE.'sair' ?>" class="title12 black link-account logado margin-left"><span class="title14">Sair</span></a>
								<?php
									} else {
								?>
								<a href="<?php echo URLBASE.'login' ?>" class="title12 black link-account"><i class="fa fa-user"></i><span class="title14">Logar</span></a>
								<?php
									}
								?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Top Header -->
		<div class="header2 bg-white">
			<div class="main-header2">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-12 col-xs-12">
							<div class="logo logo1 pull-left">
								<a href="<?php echo URLBASE ?>">
									<img src="<?php echo URLBASE ?>images/logo-header.png" alt="Nova JR Compressores">
								</a>
							</div>
							<!-- End logo -->
						</div>
						<div class="col-md-6 col-sm-8 col-xs-12">
							<form method="get" action="<?php echo URLBASE.'busca' ?>" class="search-form form-round">
								<!-- <div class="dropdown-box">
									<a href="javascript:void(0)" class="dropdown-link">Todos</a>
									<ul class="list-none dropdown-list">
										<?php
											$categoriaProds = CRUD::Select('produtos_categorias');
											foreach ($categoriaProds['dados'] as $listaCategoriaProds) {
										?>
										<li><a href="<?php echo URLBASE.'produtos/'.$listaCategoriaProds['url'] ?>"><?php echo $listaCategoriaProds['nome'] ?></a></li>
										<?php
											}
										?>
									</ul>
								</div> -->
								<input type="text" name="s" placeholder="Procurar pelo produto...">
								<div class="submit-form">
									<input type="submit" value="">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- End Main Nav -->
			<div class="header-nav2">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-sm-8 col-xs-12">
							<nav class="main-nav main-nav1 pull-left">
								<ul>
									<?php
										$menu = CRUD::SelectOne('menu','nivel',1,'ordem ASC');
										foreach ($menu['dados'] as $lista_menu) {
											$submenu = CRUD::SelectOne('menu','mae',$lista_menu['id'],'ordem ASC');
											if($submenu['num'] == 0) {
									?>
									<li>
										<a href="<?php echo URLBASE.$lista_menu['link'] ?>"><?php echo $lista_menu['titulo'] ?></a>
									</li>
									<?php 
											} 
											else { 
									?>
									<li class="menu-item-has-children">
										<a href="<?php echo URLBASE.$lista_menu['link'] ?>"><?php echo $lista_menu['titulo'] ?></a>
										<ul class="sub-menu">
											<?php 
												foreach ($submenu['dados'] as $lista_submenu) {
													$subsubmenu = CRUD::SelectOne('menu','mae',$lista_submenu['id'],'ordem ASC');
													if($subsubmenu['num'] == 0) {
											?>
												<li>
													<a href="<?php echo URLBASE.$lista_submenu['link'] ?>"><?php echo $lista_submenu['titulo'] ?></a>
												</li>
											<?php
													} 
													else {
											?>
														<li class="menu-item-has-children">
															<a href="<?php echo URLBASE.$lista_submenu['link'] ?>"><?php echo $lista_submenu['titulo'] ?></a>
															<ul class="sub-menu">
																<?php
																	foreach ($subsubmenu['dados'] as $lista_subsubmenu) {
																?>
																<li><a href="<?php echo URLBASE.$lista_subsubmenu['link'] ?>"><?php echo $lista_subsubmenu['titulo'] ?></a></li>
																<?php
																	}
																?>
															</ul>
														</li>
											<?php
													}
												}
											?>
										</ul>
									</li>
									<?php
											}
										}
									?>
								</ul>
								<a href="#" class="toggle-mobile-menu"><span></span></a>
							</nav>
							<!-- End Main Nav -->
						</div>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<ul class="wrap-cart-top2 list-inline-block pull-right">
								<li>
									<div class="mini-cart-box mini-cart1 aside-box">
										<a class="mini-cart-link" href="carrinho.php" title="Cart">
											<span class="mini-cart-icon title14 dark">Cesta de orçamentos <i class="fa fa-shopping-basket"></i></span>
											<span class="mini-cart-text">
												<span class="mini-cart-number">4</span>
											</span>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- End Header Nav -->
		</div>
	</header>
	<!-- End Header -->