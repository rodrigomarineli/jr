<?php
	include('templates/header.php');
?>
	<!-- End Header -->
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about content-checkout-page woocommerce">
					<h2 class="title30 font-bold text-uppercase text-left dark">Checkout</h2>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-ms-12">
									<div class="check-billing">
										<form class="form-my-account">
											<p class="clearfix box-col2">
												<input type="text" value="Nome *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" />
												<input type="text" value="Sobrenome *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" />
											</p>
											<p><input type="text" value="Empresa" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" /></p>
											<p class="clearfix box-col2">
												<input type="text" value="E-mail *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" />
												<input type="text" value="Telefone *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" />
											</p>
											<p><input type="text" value="Endereço *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" /></p>
											<p><input type="text" value="Complemento *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" /></p>
											<p class="clearfix box-col2">
												<input type="text" value="CEP" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" />
												<input type="text" value="Cidade / UF *" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" />
											</p>
										</form>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-ms-12">
									<div class="check-address">
										<form class="form-my-account">
											<p>
												<textarea cols="30" rows="10" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">Observações</textarea>
											</p>
										</form>
									</div>		
								</div>
							</div>
							<h3 class="order_review_heading bg-black">Resumo do Pedido</h3>
							<div class="woocommerce-checkout-review-order" id="order_review">
								<div class="table-responsive">
									<table class="shop_table woocommerce-checkout-review-order-table">
										<thead>
											<tr>
												<th class="product-name">Produto</th>
												<th class="product-total">Finalidade</th>
											</tr>
										</thead>
										<tbody>
											<tr class="cart_item">
												<td class="product-name">
													<span class="product-quantity">01</span> Compressor de PArafuso Série EG 11 - 75 KW
												</td>
												<td class="product-total">
													<span class="amount">Locação - de <strong>01/11/2018</strong> até <strong>01/02/2019</strong></span>						
												</td>
											</tr>
											<tr class="cart_item">
												<td class="product-name">
													<span class="product-quantity">01</span> Compressor de PArafuso Série EG 11 - 75 KW
												</td>
												<td class="product-total">
													<span class="amount">Compra</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="woocommerce-checkout-payment" id="payment">
									<div class="form-row no-border place-order">
										<input type="submit" data-value="Place order" value="Solicitar Orçamento" id="place_order" name="woocommerce_checkout_place_order" class="button alt bg-color">
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
<?php include('templates/footer.php') ?>