<?php
	include('templates/header.php');
?>
	<!-- End Header -->
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about content-cart-page woocommerce">
					<h2 class="title30 text-uppercase font-bold dark">Carrinho</h2>
					<form method="post">
						<div class="table-responsive">
							<table class="shop_table cart table">
								<thead>
									<tr>
										<th class="product-remove">&nbsp;</th>
										<th class="product-thumbnail">&nbsp;</th>
										<th class="product-name">Produto</th>
										<th class="product-price">FINALIDADE</th>
										<th class="product-quantity">QUANTIDADE</th>
										<th class="product-subtotal">PERÍODO</th>
									</tr>
								</thead>
								<tbody>
									<tr class="cart_item">
										<td class="product-remove">
											<a class="remove" href="#"><i class="fa fa-trash"></i></a>
										</td>
										<td class="product-thumbnail">
											<a href="#"><img  src="images/photos/glasses/dl-store-glasse-03.jpg" alt=""/></a>					
										</td>
										<td class="product-name" data-title="Product">
											<a href="#">Compressor de PArafuso Série EG 11 - 75 KW</a>					
										</td>
										<td class="product-price" data-title="Price">
											<ul class="list-none" id="shipping_method">
												<li>
													<input type="radio" class="shipping_method" checked="checked" value="free_shipping" id="shipping_method_0_free_shipping" data-index="0" name="shipping_method[0]">
													<label for="shipping_method_0_free_shipping">Compra</label>
												</li>
												<li>
													<input type="radio" class="shipping_method" value="local_delivery" id="shipping_method_0_local_delivery" data-index="0" name="shipping_method[0]">
													<label for="shipping_method_0_local_delivery">Locação</label>
												</li>
											</ul>
										</td>
										<td class="product-quantity" data-title="Quantity">
											<div class="detail-qty border">
												<a href="#" class="qty-up"><i class="fa fa-angle-up"></i></a>
												<span class="qty-val">1</span>
												<a href="#" class="qty-down"><i class="fa fa-angle-down"></i></a>
											</div>
										</td>
										<td class="product-subtotal" data-title="Total">
											<div class="row">
												<div class="col-md-2">
													<label for="">De:</label>
												</div>
												<div class="col-md-10">
													<input type="date" name="de" value="__/__/____">
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label for="">Até:</label>
												</div>
												<div class="col-md-10">
													<input type="date" name="ate" value="__/__/____">
												</div>
											</div>
										</td>
									</tr>
									<tr class="cart_item">
										<td class="product-remove">
											<a class="remove" href="#"><i class="fa fa-trash"></i></a>
										</td>
										<td class="product-thumbnail">
											<a href="#"><img  src="images/photos/glasses/dl-store-glasse-03.jpg" alt=""/></a>					
										</td>
										<td class="product-name" data-title="Product">
											<a href="#">Compressor de PArafuso Série EG 11 - 75 KW</a>					
										</td>
										<td class="product-price" data-title="Price">
											<ul class="list-none" id="shipping_method">
												<li>
													<input type="radio" class="shipping_method" checked="checked" value="free_shipping" id="shipping_method_0_free_shipping" data-index="0" name="shipping_method[0]">
													<label for="shipping_method_0_free_shipping">Compra</label>
												</li>
												<li>
													<input type="radio" class="shipping_method" value="local_delivery" id="shipping_method_0_local_delivery" data-index="0" name="shipping_method[0]">
													<label for="shipping_method_0_local_delivery">Locação</label>
												</li>
											</ul>
										</td>
										<td class="product-quantity" data-title="Quantity">
											<div class="detail-qty border">
												<a href="#" class="qty-up"><i class="fa fa-angle-up"></i></a>
												<span class="qty-val">1</span>
												<a href="#" class="qty-down"><i class="fa fa-angle-down"></i></a>
											</div>
										</td>
										<td class="product-subtotal" data-title="Total">
											<div class="row">
												<div class="col-md-2">
													<label for="">De:</label>
												</div>
												<div class="col-md-10">
													<input type="date" name="de" value="__/__/____">
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label for="">Até:</label>
												</div>
												<div class="col-md-10">
													<input type="date" name="ate" value="__/__/____">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="actions" colspan="6">
											<input type="submit" value="Avançar" name="update_cart" class="button bg-color">			
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>	
			</div>
		</div>
		<div class="container">
			<hr>
		</div>
	</section>
	<!-- End Content -->
<?php include('templates/footer.php') ?>