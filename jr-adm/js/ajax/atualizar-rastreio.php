<?php session_start(); ?>
<?php include("../../../classes/config.php"); ?>
<?php include("../../../classes/DB.class.php"); ?>
<?php include("../../../classes/class.upload.php"); ?>
<?php include("../../../classes/PHPMailerAutoload.php"); ?>
<?php include("../../../classes/Geral.class.php"); ?>
<?php include("../../../classes/CRUD.class.php"); ?>
<?php 
extract($_POST);
$dados = 'rastreio = "'.$rastreio.'", data_entrega = "'.date('d/m/Y').'" WHERE id = '.$pedido;
$rastreio = CRUD::UpdateAjax('pedido',$dados);
$dados_pedido = CRUD::SelectOne('pedido','id',$pedido);
$cliente = CRUD::SelectOne('cliente','id',$dados_pedido['dados'][0]['id_cliente']);

$msg = file_get_contents(URLBASE.'tmp_email_retorno.php?pedido='.$pedido.'&status='.$dados_pedido['dados'][0]['status']);
$envia = Geral::SendMail(SITE_NAME.' - Pedido Atualizado', $msg,$cliente['dados'][0]['email'],$cliente['dados'][0]['nome']);
?>