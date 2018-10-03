	<!-- End Content -->
	<footer id="footer">
		<div class="footer2">
			<div class="container">
				
				<div class="main-footer2">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="block-footer2">
								<h2 class="title30 dark"><strong><?php echo $dados_gerais['dados'][0]['titulo_newsletter'] ?></strong></h2>
								<p class="desc dark opaci"><?php echo $dados_gerais['dados'][0]['texto_newsletter'] ?></p>
								<form class="form-newsletter2" method="post">
									<input type="text" name="email" placeholder="DIGITE SEU E-MAIL">
									<input type="submit" value="ASSINAR" name="salva_news">
									<?php
										if( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['salva_news'])){
											$request = md5(implode($_POST));
											if(isset($_SESSION['last_request']) && $_SESSION['last_request'] == $request){
												header('Location: '.URLBASE);
											}
											else {
												$_SESSION['last_request']  = $request;
												extract($_POST);
												$add = CRUD::Insert('newsletter');
												if($add > 0) 
													echo '<p>Email cadastrado com sucesso!</p>';
												else
													echo '<p>Algo deu errado, tente novamente mais tarde!</p>';
											}
										}
									?>
								</form>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="block-footer2">
								<div class="logo logo-footer2 text-center">
									<a href="<?php echo URLBASE ?>">
										<img src="<?php echo URLBASE ?>images/logo-bottom.png" alt="Nova JR Compressores">
									</a>
								</div>
								<h2 class="title16 dark text-center "><?php echo $dados_gerais['dados'][0]['titulo_social'] ?></h2>
								<div class="social-network-footer text-center">
									<a href="<?php echo $dados_gerais['dados'][0]['facebook'] ?>" class="inline-block round"><i class="fa fa-facebook"></i></a>
									<a href="<?php echo $dados_gerais['dados'][0]['instagram'] ?>" class="inline-block round"><i class="fa fa-instagram"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="block-footer2">
								<h2 class="title30 dark"><strong><?php echo $dados_gerais['dados'][0]['titulo_duvidas'] ?></strong></h2>
								<p class="desc dark opaci"><?php echo $dados_gerais['dados'][0]['texto_duvidas'] ?></p>
								<ul class="list-none contact-foter2">
									<li>
										<i class="fa fa-volume-control-phone dark"></i>
										<span class="text-uppercase dark opaci"><?php echo $dados_gerais['dados'][0]['telefone'] ?></span>
									</li>
									<li>
										<i class="fa fa-envelope dark"></i>
										<a class="dark opaci" href="mailto:<?php echo $dados_gerais['dados'][0]['email'] ?>"><?php echo $dados_gerais['dados'][0]['email'] ?></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- End Main Footer -->
			</div>
		</div>
	</footer>
	<div id="rodape">
		<div class="container-fluid">
			<div class="footer-bottom2">
				<p class="white copyright-footer text-center"><?php echo $dados_gerais['dados'][0]['endereco1'] ?> - <?php echo $dados_gerais['dados'][0]['endereco2'] ?> - <?php echo $dados_gerais['dados'][0]['endereco3'] ?> - Fone: <?php echo $dados_gerais['dados'][0]['telefone'] ?> - <?php echo $dados_gerais['dados'][0]['email'] ?></p>
				<p class="white copyright-footer text-center"><?php echo $dados_gerais['dados'][0]['copyright'] ?></p>
			</div>
		</div>
	</div>
	<!-- End Footer -->
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">
				<div class="object" id="object_four"></div>
				<div class="object" id="object_three"></div>
				<div class="object" id="object_two"></div>
				<div class="object" id="object_one"></div>
			</div>
		</div>
	</div>
	<!-- End Preload -->
	<a href="#" class="scroll-top dark"><i class="fa fa-angle-up"></i></a>
</div>
<script src="<?php echo URLBASE ?>js/libs/jquery-3.2.1.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/bootstrap.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/jquery.fancybox.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/jquery-ui.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/owl.carousel.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/jquery.jcarousellite.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/jquery.elevatezoom.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/popup.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/timecircles.min.js"></script>
<script src="<?php echo URLBASE ?>js/libs/wow.min.js"></script>
<script src="<?php echo URLBASE ?>js/config.js"></script>
<script src="<?php echo URLBASE ?>js/theme.js"></script>
</body>
</html>