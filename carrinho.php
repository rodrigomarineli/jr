<?php
	include('templates/includes.php');
	include('templates/header.php');
	extract($_POST);
	if(isset($_SESSION[SESSION_CART]['cliente']['id'])) {
		if( $_SERVER['REQUEST_METHOD']=='POST' ){
			$request = md5( implode( $_POST ) );
			if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request ){
			}
			else{
				$_SESSION['last_request'] = $request;
				if(isset($acao) && $acao == 'add') {
					$ver = CRUD::SelectOne('carrinho','id_cliente',$_SESSION[SESSION_CART]['cliente']['id']);
					if($ver['num'] == 0) {
						$add_pedido = CRUD::InsertAjax('carrinho','id_cliente = '.$_SESSION[SESSION_CART]['cliente']['id']);
						$add_produto = CRUD::InsertAjax('carrinho_produtos','id_produto = '.$produto.', qtd = '.$qtd.', tipo = '.$tipo.', id_carrinho = '.$add_pedido);
					}
					else {
						$ver_produto = CRUD::SelectTwoMore('carrinho_produtos','id_produto = '.$produto.' AND tipo = '.$tipo.' AND id_carrinho = '.$ver['dados'][0]['id']);
						if($ver_produto['num'] == 0)
							$add_produto = CRUD::InsertAjax('carrinho_produtos','id_produto = '.$produto.', qtd = '.$qtd.', tipo = '.$tipo.', id_carrinho = '.$ver['dados'][0]['id']);
						else {
							$up_produto = CRUD::UpdateAjax('carrinho_produtos','qtd = qtd + '.$qtd.' WHERE id_produto = '.$produto.' AND tipo = '.$tipo);
						}
					}
				}
			}
		}
	}
	else {
		if (!isset($_SESSION[SESSION_CART]['cart'])) {
			$_SESSION[SESSION_CART]['cart'] = md5(uniqid(""));
		}
		if( $_SERVER['REQUEST_METHOD']=='POST' ){
			$request = md5( implode( $_POST ) );
			if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request ){
			}
			else{
				$_SESSION['last_request'] = $request;
				if(isset($acao) && $acao == 'add') {
					$ver = CRUD::SelectOne('carrinho','id_cliente',$_SESSION[SESSION_CART]['cart']);
					if($ver['num'] == 0) {
						$add_pedido = CRUD::InsertAjax('carrinho','id_cliente = "'.$_SESSION[SESSION_CART]['cart'].'"');
						$add_produto = CRUD::InsertAjax('carrinho_produtos','id_produto = '.$produto.', qtd = '.$qtd.', tipo = '.$tipo.', id_carrinho = '.$add_pedido);
					}
					else {
						$ver_produto = CRUD::SelectTwoMore('carrinho_produtos','id_produto = '.$produto.' AND tipo = '.$tipo.' AND id_carrinho = '.$ver['dados'][0]['id']);
						if($ver_produto['num'] == 0)
							$add_produto = CRUD::InsertAjax('carrinho_produtos','id_produto = '.$produto.', qtd = '.$qtd.', tipo = '.$tipo.', id_carrinho = '.$ver['dados'][0]['id']);
						else 
							$up_produto = CRUD::UpdateAjax('carrinho_produtos','qtd = qtd + '.$qtd.' WHERE id_produto = '.$produto.' AND tipo = '.$tipo);
					}
				}
			}
		}
	}
?>
	<!-- End Header -->
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about content-cart-page woocommerce">
					<h2 class="title30 text-uppercase font-bold dark">Carrinho</h2>
					<form method="post" action="<?php echo URLBASE.'checkout' ?>">
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
									<?php
										if(isset($_SESSION[SESSION_CART]['cliente']['id'])) {
											$idCar = $_SESSION[SESSION_CART]['cliente']['id'];
										} else {
											$idCar = $_SESSION[SESSION_CART]['cart'];
										}
										$car = CRUD::SelectExtra("SELECT * FROM carrinho AS C INNER JOIN carrinho_produtos AS P ON C.`id` = P.`id_carrinho` WHERE C.`id_cliente` = '".$idCar."'");
										foreach ($car['dados'] as $listaCar) {
											if($listaCar['tipo'] == 1) {
												$produto = CRUD::SelectOne('produtos','id',$listaCar['id_produto']);
												$foto = CRUD::SelectOne('produtos_fotos','id_produtos',$produto['dados'][0]['id']);
											}
											else if($listaCar['tipo'] == 2) {
												$produto = CRUD::SelectOne('pecas','id',$listaCar['id_produto']);
												$foto = CRUD::SelectOne('pecas_fotos','id_pecas',$produto['dados'][0]['id']);
											}
									?>
									<tr class="cart_item">
										<td class="product-remove">
											<a class="remove deleteCart" data-produto="<?php echo $listaCar['id'] ?>" href=""><i class="fa fa-trash"></i></a>
										</td>
										<td class="product-thumbnail">
											<a href="#"><img  src="<?php echo URLBASE.'images/produtos/fotos/'.$foto['dados'][0]['imagem'] ?>" alt=""/></a>					
										</td>
										<td class="product-name" data-title="Product">
											<a href="#"><?php echo $produto['dados'][0]['nome'] ?></a>					
										</td>
										<td class="product-price" data-title="Price">
											<ul class="list-none modoRadio">
												<?php
													if($produto['dados'][0]['venda'] == 1) {
												?>
												<li>
													<input required type="radio" class="modoCart" data-produto="<?php echo $listaCar['id'] ?>" value="1" data-modo="1" name="modo_<?php echo $listaCar['id'] ?>" <?php if($listaCar['modo'] == 1) { echo 'checked'; } ?>>
													<label for="shipping_method_0_free_shipping">Compra</label>
												</li>
												<?php
													}
												?>
												<?php
													if($produto['dados'][0]['locacao'] == 1) {
												?>
												<li>
													<input required type="radio" class="modoCart" data-produto="<?php echo $listaCar['id'] ?>" value="2" data-modo="2" name="modo_<?php echo $listaCar['id'] ?>" <?php if($listaCar['modo'] == 2) { echo 'checked'; } ?>>
													<label for="shipping_method_0_local_delivery">Locação</label>
												</li>
												<?php
													}
												?>
											</ul>
										</td>
										<td class="product-quantity" data-title="Quantity">
											<div class="detail-qty carrinho border">
												<a href="#" class="qty-up"><i class="fa fa-angle-up"></i></a>
												<span class="qty-val" data-produto="<?php echo $listaCar['id'] ?>"><?php echo $listaCar['qtd'] ?></span>
												<a href="#" class="qty-down"><i class="fa fa-angle-down"></i></a>
											</div>
										</td>
										<td class="product-subtotal" data-title="Total">
											<?php
												if($produto['dados'][0]['locacao'] == 1 && $listaCar['modo'] == 2) {
											?>
											<div class="row">
												<div class="col-md-2">
													<label for="">De:</label>
												</div>
												<div class="col-md-10">
													<input required type="date" name="de" class="deCart" data-produto="<?php echo $listaCar['id'] ?>" value="<?php echo $listaCar['de'] ?>">
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label for="">Até:</label>
												</div>
												<div class="col-md-10">
													<input required type="date" name="ate" class="ateCart" data-produto="<?php echo $listaCar['id'] ?>" value="<?php echo $listaCar['ate'] ?>">
												</div>
											</div>
											<?php
												}
											?>
										</td>
									</tr>
									<?php
										}
									?>
									<tr>
										<td class="actions" colspan="6">
											<input type="submit" value="Avançar" name="update_cart" class="button bg-color">		
											<!-- <a href="<?php echo URLBASE.'checkout' ?>" class="button bg-color btn-avancar">Avançar</a> -->
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