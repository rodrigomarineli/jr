<?php 
ob_start();
session_start(); 
?>
<?php include("../classes/config.php"); ?>
<?php
if(!isset($_SESSION[SESSION_ADMIN.'_uid'])){
	header('Location: '.$url_site_admin);
}
?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php include("../classes/Menu.class.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo SITE_NAME ?> Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!--base css styles-->
        <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/normalize/normalize.css">

        <!--page specific css styles-->
        <link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen.min.css" />
        <link rel="stylesheet" type="text/css" href="assets/jquery-tags-input/jquery.tagsinput.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/clockface/css/clockface.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

        <!--flaty css styles-->
        <link rel="stylesheet" href="css/flaty.css">
        <link rel="stylesheet" href="css/flaty-responsive.css">

        <link rel="shortcut icon" href="img/favicon.html">

        <script src="assets/modernizr/modernizr-2.6.2.min.js"></script>
        <style>
        	.box { margin-top: 0; }
        	address, table { margin-bottom: 0 !important;}
        	h3 { font-size: 17px !important; }
        	.box .box-title { padding: 5px; }
        </style>
    </head>
    <body>
<?php
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$pedido = CRUD::SelectOne('pedidos','id',$id);
		$cliente = CRUD::SelectOne('cliente','id',$pedido['dados'][0]['id_cliente']);
		$botao = 'Atualizar';
	}

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$pedido = CRUD::SelectOne('pedidos','id',$id);
		$cliente = CRUD::SelectOne('cliente','id',$pedido['dados'][0]['id_cliente']);
		$complemento = ($cliente['dados'][0]['complemento'] == '') ? '' : ' - '.$cliente['dados'][0]['complemento'];
		$botao = 'Atualizar';
	}
?>

			<!-- BEGIN Content -->
			<div id="main-content">
				<!-- BEGIN Page Title -->
				<div class="page-title">
					<div>
						<h1><i class="icon-file-alt"></i> Orçamento #<?php echo $id ?></h1>
					</div>
				</div><!-- END Page Title -->

				<div class="row-fluid">
					<div class="span12">
						<div class="box box-black">
							<div class="box-title">
								<h3><i class="icon-building"></i>Dados do Cliente</h3>
							</div>
							<div class="box-content">
								<address>
									<strong><?php echo $cliente['dados'][0]['nome'] ?></strong><br>
									Telefone: <?php echo $cliente['dados'][0]['telefone'] ?><br/>
								</address>

								<address>
									<strong>E-mail</strong><br>
									<a href="mailto:<?php echo $cliente['dados'][0]['email'] ?>"><?php echo $cliente['dados'][0]['email'] ?></a>
								</address>

								<address>
									<?php echo $cliente['dados'][0]['endereco'].$complemento ?><br>
									<?php echo $cliente['dados'][0]['cidade_estado'] ?><br>
									CEP: <?php echo $cliente['dados'][0]['cep'] ?><br>
								</address>

								<address>
									<strong>OBS.:</strong><br>
									<?php echo $cliente['dados'][0]['obs'] ?>
								</address>
							</div>
						</div>
					</div>

				</div>

				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-shopping-cart"></i> Produtos Orçados</h3>
							</div>
							<div class="box-content">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Tipo</th>
											<th>Nome</th>
											<th>Quantidade</th>
											<th>Finalidade</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$itens = CRUD::SelectOne('pedidos_produtos','id_pedidos',$id);
											foreach ($itens['dados'] as $lista_produtos) {
												if($lista_produtos['tipo'] == 1) {
													$produto = CRUD::SelectOne('produtos','id',$lista_produtos['id_produto']);
													$tipo = "Produtos";
												}
												else if($lista_produtos['tipo'] == 2) {
													$produto = CRUD::SelectOne('pecas','id',$lista_produtos['id_produto']);
													$tipo = "Peças e Acessórios";
												}
										?>
										<tr>
											<td><?php echo $produto['dados'][0]['id'] ?></td>
											<td><?php echo $tipo ?></td>
											<td><?php echo $produto['dados'][0]['nome'] ?></td>
											<td><?php echo $lista_produtos['qtd'] ?></td>
											<?php
												if($lista_produtos['modo'] == 1) {
											?>
											<td>Compra</td>
											<?php } else if($lista_produtos['modo'] == 2) { ?>
											<td>Aluguel - De <?php echo date('d/m/Y', strtotime($lista_produtos['de'])) ?> até <?php echo date('d/m/Y', strtotime($lista_produtos['ate'])) ?></td>
											<?php } ?>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div><!-- END Content -->
		</div><!-- END Container -->

        <!--basic scripts-->
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="assets/jquery/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>
        <script src="assets/nicescroll/jquery.nicescroll.min.js"></script>

        <!--page specific plugin scripts-->
        <script type="text/javascript" src="assets/chosen-bootstrap/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
        <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
        <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
        <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
        <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
        <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script type="text/javascript" src="assets/uploadfy/jquery.uploadify.min.js"></script>
        <script src="//cdn.ckeditor.com/4.4.7/standard-all/ckeditor.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!--flaty scripts-->
        <script src="js/flaty.js"></script>
        <script src="js/main.js"></script>

	</body>
</html>

<script>
	window.print();
</script>