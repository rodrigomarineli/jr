<?php include("templates/header.php"); ?>
<?php 
$menu = "clientes";
$submenu = "todos"; 
?>
<?php include("templates/menu.php"); ?>
<?php
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$cliente = CRUD::SelectOne('cliente','id',$id);
		$botao = 'Atualizar';
	}
?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Pedidos</h1>
					</div>
				</div><!-- END Page Title -->

				<!-- BEGIN Breadcrumb -->
				<div id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<span class="divider"><i class="icon-angle-right"></i></span>
						</li>
						<li class="active">Pedidos</li>
					</ul>
				</div>
				<!-- END Breadcrumb -->

				<div class="row-fluid">
					<div class="span12">
						<div class="box box-black">
							<div class="box-title">
								<h3><i class="icon-building"></i>Dados do Cliente</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
								<address>
									<strong>Nome: </strong><?php echo $cliente['dados'][0]['nome'] ?><br>
									<strong>CPF: </strong><?php echo $cliente['dados'][0]['cpf'] ?><br/>
									<strong>Telefone 1: </strong><?php echo '('.$cliente['dados'][0]['ddd_telefone'].') '.$cliente['dados'][0]['telefone'] ?><br/>
									<strong>Telefone 2: </strong><?php echo '('.$cliente['dados'][0]['ddd_celular'].' )'.$cliente['dados'][0]['celular'] ?><br/>
									<strong>Data de Nascimento: </strong><?php echo date('d/m/Y', strtotime($cliente['dados'][0]['data_nascimento'])) ?><br/>
								</address>

								<address>
									<strong>E-mail</strong><br>
									<a href="mailto:<?php echo $cliente['dados'][0]['email'] ?>"><?php echo $cliente['dados'][0]['email'] ?></a>
								</address>

							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="box box-blue">
							<div class="box-title">
								<h3><i class="icon-building"></i>Endereço</h3>
								<div class="box-tool">
									<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
									<a data-action="close" href="#"><i class="icon-remove"></i></a>
								</div>
							</div>
							<div class="box-content">
							<?php
								$cliente_cobranca = CRUD::SelectOne('cliente_endereco','id_cliente',$id,'id DESC');
								foreach ($cliente_cobranca['dados'] as $lista_cliente_cobranca) {
								$complemento = ($lista_cliente_cobranca['complemento'] == '') ? '' : ' - '.$lista_cliente_cobranca['complemento'];
							?>
								<address>
									<strong><?php echo $lista_cliente_cobranca['informacoes'] ?></strong><br>
									Identificação: <?php echo $lista_cliente_cobranca['identificacao'] ?><br>
									<?php echo $lista_cliente_cobranca['rua'].', '.$lista_cliente_cobranca['numero'].$complemento ?><br>
									Bairro: <?php echo $lista_cliente_cobranca['bairro'] ?><br>
									<?php echo $lista_cliente_cobranca['cidade'].'/'.$lista_cliente_cobranca['estado'] ?><br>
									CEP: <?php echo $lista_cliente_cobranca['cep'] ?><br>
								</address>
							<?php
								}
							?>
							</div>
						</div>
					</div>
				</div>

				<div id="ordem"></div>
                <!-- END Main Content -->

				<?php include('templates/footer.php'); ?>
