<?php
session_start();
?>
<?php include("../../classes/config.php"); ?>
<?php include("../../classes/DB.class.php"); ?>
<?php include("../../classes/Geral.class.php"); ?>
<?php include("../../classes/CRUD.class.php"); ?>
<?php 
extract($_POST);
if(isset($qtd)){
	$up_produto = CRUD::UpdateAjax('carrinho_produtos','qtd = '.$qtd.' WHERE id = '.$produto);
}
if(isset($modo)){
	$up_produto = CRUD::UpdateAjax('carrinho_produtos','modo = '.$modo.' WHERE id = '.$produto);
}
if(isset($de)){
	$up_produto = CRUD::UpdateAjax('carrinho_produtos','de = "'.$de.'" WHERE id = '.$produto);
}
if(isset($ate)){
	$up_produto = CRUD::UpdateAjax('carrinho_produtos','ate = "'.$ate.'" WHERE id = '.$produto);
}
if(isset($remove)){
	$up_produto = CRUD::Delete('carrinho_produtos','id',$produto);
}
?>
