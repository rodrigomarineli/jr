<?php
	include('templates/includes.php');
	include('templates/header.php');
?>
	<!-- End Header -->
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about content-contact-page">
					<h2 class="title30 dark font-bold text-uppercase">Contato</h2>
					<div class="contact-form-faq">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="contact-form-page">
									<h2 class="title18 dark font-bold text-uppercase"><?php echo $dados_gerais['dados'][0]['titulo_contato'] ?></h2>
									<?php echo $dados_gerais['dados'][0]['texto_contato'] ?>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<form class="contact-form" method="post">
									<p class="contact-name">
										<input class="dark border" name="nome" placeholder="Nome*" type="text">
									</p>
									<p class="contact-email">
										<input class="dark border" name="email" placeholder="E-mail*" type="text">
									</p>
									<p class="contact-message">
										<textarea class="dark border" placeholder="Comentário*" name="comentario" cols="30" rows="10"></textarea>
									</p>
									<p class="contact-submit">
										<input  class="shop-button white bg-black" type="submit" name="enviar" value="ENVIAR">
									</p>
									<?php
										if( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['enviar']) ){
											$request = md5(implode($_POST));
											if(isset($_SESSION['last_request']) && $_SESSION['last_request'] == $request){
												header('Location: '.URLBASE);
											}
											else {
												$_SESSION['last_request']  = $request;
												extract($_POST);
												$msg = '<p>Nome: '.$nome.'</p><p>E-mail: '.$email.'</p><p>Comentário: '.$comentario.'</p>';
												$envia = Geral::SendMail('Contato Site',$msg,$dados_gerais['dados'][0]['email'],SITE_NAME);
												if($envia == 1) 
													echo '<p class="text-center">Mensagem enviada com sucesso!</p>';
												else
													echo '<p class="text-center">Algo deu errado, tente novamente mais tarde!</p>';
											}
										}
									?>
								</form>
							</div>
						</div>
					</div>
					<div class="contact-google-map bg-white border">
						<div id="map" class="map-custom"></div>
						<script>
						  function initMap() {
							var myLatLng = {lat: <?php echo $dados_gerais['dados'][0]['lat'] ?>, lng: <?php echo $dados_gerais['dados'][0]['lng'] ?>};

							var map = new google.maps.Map(document.getElementById('map'), {
							  zoom: 16,
							  center: myLatLng
							});

							var marker = new google.maps.Marker({
							  position: myLatLng,
							  map: map,
							});
						  }
						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEkQ6AW_lnHAzPiXPdSNy1GKXiI1I9AGg&callback=initMap" async defer></script>
					</div>
					<!-- End Google Map -->
					<div class="contact-page-info blockquote">
						<div class="row">
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="contact-box contact-address-box">
									<span class="dark"><i class="fa fa-home"></i></span>
									<label class="title16 dark">ENDEREÇO:</label>
									<p class="desc"><?php echo $dados_gerais['dados'][0]['endereco1'] ?></p>
									<p class="desc"><?php echo $dados_gerais['dados'][0]['endereco2'] ?></p>
									<p class="desc"><?php echo $dados_gerais['dados'][0]['endereco3'] ?></p>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="contact-box">
									<span class="dark"><i class="fa fa-phone"></i></span>
									<label class="title16 dark">TELEFONE:</label>
									<p class="desc"><?php echo $dados_gerais['dados'][0]['telefone'] ?></p>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="contact-box contact-email-box">
									<span class="dark"><i class="fa fa-envelope"></i></span>
									<label class="title16 dark">e-mail:</label>
									<p class="desc"><a href="mailto:<?php echo $dados_gerais['dados'][0]['email'] ?>" class="dark"><?php echo $dados_gerais['dados'][0]['email'] ?></a></p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Contact Info -->
				</div>
			</div>
		</div>
		<div class="container">
			<hr>
		</div>
	</section>
<?php include('templates/footer.php') ?>