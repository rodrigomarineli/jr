<?php
	include('templates/includes.php');
	include('templates/header.php');
?>
	<div id="content">
		<div class="content-page woocommerce">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- <h2 class="title-shop-page dark font-bold ">Member</h2> -->
						<div class="register-content-box">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-ms-12">
									<div class="check-billing">
										<div class="form-my-account">
											<form class="block-login" method="post">
												<h2 class="title24 title-form-account ">Login</h2>
												<p>
													<label>E-mail <span class="required">*</span></label>
													<input type="text" name="username" />
												</p>
												<p>
													<label>Senha <span class="required">*</span></label>
													<input type="password" name="password" />
												</p>
												<p>
													<input type="submit" class="register-button" name="entrar" value="Login">
												</p>
												<div class="table-custom create-account">
													<div class="text-left">
														<a href="#" class="esqueci-minha-senha color">Esqueci minha senha</a>
													</div>
												</div>
												<?php
													if(isset($_POST['entrar'])){
														extract($_POST);
														$logar = Login::logarSite($username,$password);
														if(!$logar) {
															echo 'Usuário ou senha inválidos';
														}
														else{
															if(isset($_SESSION[SESSION_CART]['cart']))
																header('Location: '.URLBASE.'carrinho');
															else
																header('Location: '.URLBASE);
														}
													}
												?>
												<?php
													if(isset($_POST['rec_salvar'])) {
														extract($_POST);
														$ver = CRUD::SelectOne('cliente','email',$email_senha);
														if($ver['num'] > 0){

															$caracteres = 'abcdefghijklmnopqrstuvwxyz1234567890';
															$nova_senha = substr(str_shuffle($caracteres),0,6);
															$senha = CRUD::CripSenha($nova_senha);
														
															$up = CRUD::UpdateAjax('cliente','senha = "'.$senha.'" WHERE id = '.$ver['dados'][0]['id']);
															$msg = '<h1>Olá </h1>'.$ver['dados'][0]['nome'].'<p>sua nova senha de acesso é <strong>'.$nova_senha.'</strong></p>';
															$envia = Geral::SendMail('Alteração de Senha - '.SITE_NAME.'',$msg,$email_senha,$ver['dados'][0]['nome']);
															echo '<p class="alert warning">Sua nova senha for enviada para o seu email</p>';
														}
													}
												?>
											</form>
											<form class="block-register" method="post">
												<h2 class="title24 title-form-account ">CADASTRAR</h2>
												<p>
													<label>Nome Completo <span class="required">*</span></label>
													<input type="text" name="nome" />
												</p>
												<p>
													<label>E-mail <span class="required">*</span></label>
													<input type="text" name="email" />
												</p>
												<p>
													<label>Senha <span class="required">*</span></label>
													<input type="password" name="senha" />
												</p>
												<p>
													<input type="submit" class="register-button" name="salvar" value="Cadastrar">
												</p>
												<?php
													if(isset($_POST['salvar'])) {
														extract($_POST);
														$add = CRUD::Insert('cliente');
														$logar = Login::logarSite($email,$senha);
														if(!$logar) {
															echo 'Usuário ou senha inválidos';
														}
														else{
															if(isset($_SESSION[SESSION_CART]['cart']))
																header('Location: '.URLBASE.'carrinho');
															else
																header('Location: '.URLBASE);
														}
													}
												?>
											</form>
											<form class="block-senha" method="post">
												<h2 class="title24 title-form-account ">RECUPERAR SENHA</h2>
												<p>
													<label>E-mail <span class="required">*</span></label>
													<input type="text" name="email_senha" />
												</p>
												<p>
													<input type="submit" class="register-button" name="rec_salvar" value="Recuperar">
												</p>
											</form>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-ms-12">
									<div class="check-address">
										<div class="form-my-account check-register text-center">
											<h2 class="title24 title-form-account ">CADASTRE-SE</h2>
											<p class="desc">Ao realizar o cadastro no nosso site, você poderá solicitar orçamentos de nossos produtos, peças e acessórios, tanto para compra, quanto para locação. Preencha os campos do formulário e faça já seu orçamento.</p>
											<a href="#" class="shop-button bg-light login-to-register" data-login="Logar" data-register="Cadastrar">Cadastrar</a>
										</div>
									</div>		
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content Page -->
	</div>
	<!-- End Content -->
	<?php include('templates/footer.php') ?>