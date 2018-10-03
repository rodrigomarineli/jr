<?php
	include('templates/includes.php');
	include('templates/header.php');
?>
	<!-- End Header -->
	<section id="content">
		<div class="content-page">
			<div class="container">
				<div class="content-about content-checkout-page woocommerce">
					<h2 class="title30 font-bold text-uppercase text-left dark">Checkout</h2>
					<form method="post">
						<?php
							$dadosCliente = CRUD::SelectOne('cliente','id',$_SESSION[SESSION_CART]['cliente']['id']);
						?>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-ms-12">
										<div class="check-billing">
											<div class="form-my-account">
												<p>
													<input type="text" value="<?php echo $dadosCliente['dados'][0]['nome'] ?>" placeholder="Nome *" name="nome" />
												</p>
												<p><input type="text" value="<?php echo $dadosCliente['dados'][0]['empresa'] ?>" placeholder="Empresa" name="empresa"/></p>
												<p class="clearfix box-col2">
													<input type="text" value="<?php echo $dadosCliente['dados'][0]['email'] ?>" placeholder="E-mail *" name="email" />
													<input type="text" value="<?php echo $dadosCliente['dados'][0]['telefone'] ?>" placeholder="Telefone *" name="telefone" />
												</p>
												<p><input type="text" value="<?php echo $dadosCliente['dados'][0]['endereco'] ?>" placeholder="Endereço *" name="endereco" /></p>
												<p><input type="text" value="<?php echo $dadosCliente['dados'][0]['complemento'] ?>" placeholder="Complemento *" name="complemento" /></p>
												<p class="clearfix box-col2">
													<input type="text"value="<?php echo $dadosCliente['dados'][0]['cep'] ?>" placeholder="CEP *" name="cep" />
													<input type="text" value="<?php echo $dadosCliente['dados'][0]['cidade_estado'] ?>" placeholder="Cidade / UF *" name="cidade_estado" />
												</p>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-ms-12">
										<div class="check-address">
											<div class="form-my-account">
												<p>
													<textarea cols="30" rows="10" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" name="obs">Observações</textarea>
												</p>
											</div>
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
														}
														else if($listaCar['tipo'] == 2) {
															$produto = CRUD::SelectOne('pecas','id',$listaCar['id_produto']);
														}
												?>
												<tr class="cart_item">
													<td class="product-name">
														<span class="product-quantity">01</span> <?php echo $produto['dados'][0]['nome'] ?>
													</td>
													<td class="product-total">
														<?php
															if($listaCar['tipo'] == 1) {
														?>
														<span class="amount">Compra</span>
														<?php } else { ?>
														<span class="amount">Locação - de <strong><?php echo date('d/m/Y', strtotime($listaCar['de'])) ?></strong> até <strong><?php echo date('d/m/Y', strtotime($listaCar['ate'])) ?></strong></span>
														<?php } ?>
													</td>
												</tr>
												<?php
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="woocommerce-checkout-payment" id="payment">
										<div class="form-row no-border place-order">
											<input type="submit" data-value="Place order" value="Solicitar Orçamento" id="place_order" name="salvar" class="button alt bg-color">
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							if(isset($_POST['salvar'])) {
								extract($_POST);
								if(isset($_SESSION[SESSION_CART]['cliente']['id'])) {
									$idCar = $_SESSION[SESSION_CART]['cliente']['id'];
									$add = CRUD::Insert('cliente',$idCar);
									$pedido = CRUD::InsertAjax('pedidos','id_cliente = '.$idCar);
									
								} else {
									$idCar = $_SESSION[SESSION_CART]['cart'];
									$add = CRUD::Insert('cliente');
									$pedido = CRUD::InsertAjax('pedidos','id_cliente = '.$add);
									unset($_SESSION[SESSION_CART]['cart']);
								}
								$car = CRUD::SelectOne('carrinho','id_cliente',$idCar);
								$produtos = CRUD::CopyItens($car['dados'][0]['id'],$pedido);
								$del = CRUD::Delete('carrinho','id_cliente',$idCar);

								$hoje = date('d/m/Y');

								$msg = file_get_contents('template-email.html');

								$msg = str_replace('NOME_DO_CLIENTE', $nome, $msg);
								$msg = str_replace('NUMERO_DO_PEDIDO', $pedido, $msg);
								$msg = str_replace('DATA_DO_PEDIDO', $hoje, $msg);

								$sql_produtos = CRUD::SelectOne('pedidos_produtos','id_pedidos',$pedido);
								foreach ($sql_produtos['dados'] as $linha_produtos) {
									$idProduto = $linha_produtos['id_produto'];
									var_dump($idProduto);
									if($linha_produtos['tipo'] == 1)
										$pega_produto = CRUD::SelectOne('produtos','id',$idProduto);
									else if($linha_produtos['tipo'] == 2)
										$pega_produto = CRUD::SelectOne('pecas','id',$idProduto);
									
									$nome_produto = $pega_produto['dados'][0]['nome'];
									$monta_produtos .= '<p class="x_MsoNormal" style="margin:0px 0cm 12pt; font-size:12pt; font-family:&quot;Times New Roman&quot;,serif">
													<span style="font-size: 10pt; font-family: Tahoma, sans-serif, serif, EmojiFont;">'.$linha_produtos['qtd'].' '.$nome_produto;
														if($linha_produtos['modo'] == 1)
									$monta_produtos .= '<font> - Finalidade - Compra</font>';
														else if($linha_produtos['modo'] == 2)
									$monta_produtos .= '<font> - Finalidade - Locação De '.date('d/m/Y', strtotime($linha_produtos['de'])).' ate '.date('d/m/Y', strtotime($linha_produtos['ate'])).'</font>';
														
									$monta_produtos .= '<u></u>
														<u></u>
													</span>
													</p>';
								}

								$msg = str_replace('LISTA_PRODUTOS', $monta_produtos, $msg);
								$envia = Geral::SendMail(SITE_NAME.' - Novo Orçamento',$msg,$email,$nome);
								$envia = Geral::SendMail(SITE_NAME.' - Novo Orçamento',$msg,TO,TO_NAME);
								header('Location: '.URLBASE.'finalizado');
							}
						?>
					</form>
				</div>	
			</div>
		</div>
		<div class="container">
			<hr>
		</div>
	</section>
<?php include('templates/footer.php') ?>