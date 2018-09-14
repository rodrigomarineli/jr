<?php
	include('templates/header.php');
?>
	<!-- End Header -->
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about content-contact-page">
					<h2 class="title30 dark font-bold text-uppercase">Contato</h2>
					<div class="contact-google-map bg-white border">
						<div id="map" class="map-custom"></div>
						<script>
						  function initMap() {
							var myLatLng = {lat: -21.147596, lng: -47.800351};

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
									<p class="desc">Av. MArechal Costa e Silva, 2.584</p>
									<p class="desc">Campos Elíseos - Ribeirão Preto-SP</p>
									<p class="desc">CEP 14080-120</p>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="contact-box">
									<span class="dark"><i class="fa fa-phone"></i></span>
									<label class="title16 dark">TELEFONE:</label>
									<p class="desc">16 3615 8077</p>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="contact-box contact-email-box">
									<span class="dark"><i class="fa fa-envelope"></i></span>
									<label class="title16 dark">e-mail:</label>
									<p class="desc"><a href="#" class="dark">contato@novajrcompressores.com.br</a></p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Contact Info -->
					<div class="contact-form-faq">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="contact-form-page">
									<h2 class="title18 dark font-bold text-uppercase">FORMULÁRIO DE CONTATO</h2>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis beatae consequatur ipsa voluptatem qui ex numquam, fugiat esse aperiam cumque exercitationem sunt. Iure, sed? Facilis consequuntur suscipit repellendus et commodi?</p>
									<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis beatae consequatur ipsa voluptatem qui ex numquam, fugiat esse aperiam cumque exercitationem sunt. Iure, sed? Facilis consequuntur suscipit repellendus et commodi?</p>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<form class="contact-form">
									<p class="contact-name">
										<input class="dark border" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="Nome*" type="text">
									</p>
									<p class="contact-email">
										<input class="dark border" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="E-mail*" type="text">
									</p>
									<p class="contact-message">
										<textarea class="dark border" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" cols="30" rows="10">Comentário*</textarea>
									</p>
									<p class="contact-submit">
										<input  class="shop-button white bg-black" type="submit" value="ENVIAR">
									</p>
								</form>
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