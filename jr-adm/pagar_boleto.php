<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/PHPMailerAutoload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php
	$pedido = CRUD::SelectOne('pedido','id',$_GET['id']);
	$cliente = CRUD::SelectOne('cliente','id',$_GET['cliente']);
	$endereco = CRUD::SelectOne('cliente_endereco','id',$pedido['dados'][0]['id_endereco']);
	$nome = explode(' ',$cliente['dados'][0]['nome']);

	$total 		= floatval($pedido['dados'][0]['valor']);
	// $cliente	= $_SESSION['seujeito']['cliente']['nome'];
	$email		= $cliente['dados'][0]['email'];
	// $pedido 	= $_SESSION['seujeito']['pedido'];
	$compra 	= $total - $frete;
	// $cliente = CRUD::SelectOne('cliente','id',$_SESSION[SESSION_CART]['cliente']['id']);
?>
<?php
require_once ('../classes/transparent-checkout/mercadopago.php');

$mp = new MP(MP_ACESS_TOKEN);

$payment_data = array(
    "transaction_amount" => $total,
    "description" => "Compra realizada no site ".URLBASE,
    "payment_method_id" => "bolbradesco",
    "payer" => array (
        "email" => $cliente['dados'][0]['email'],
		"first_name"=> $nome[0],
		"last_name"=> $nome[1],
		"identification"=> array (
			"type"=> "CPF",
			"number"=> $cliente['dados'][0]['cpf']
		),
		"address"=> array (
			"zip_code"=> $endereco['dados'][0]['cep'],
			"street_name"=> $endereco['dados'][0]['rua'],
			"street_number"=> $endereco['dados'][0]['numero'],
			"neighborhood"=> $endereco['dados'][0]['bairro'],
			"city"=> $endereco['dados'][0]['cidade'],
			"federal_unit"=> $endereco['dados'][0]['estado']
		)
    )
);

$payment = $mp->post("/v1/payments", $payment_data);

$url = $payment['response']['transaction_details']['external_resource_url'];

header('Location: '.$url);

?>