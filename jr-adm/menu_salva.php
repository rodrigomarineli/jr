<?php 
	ob_start();
	session_start(); 
?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/Menu.class.php"); ?>
<?php 
	extract($_GET);
	$menu = Menu::SalvaMenu($tabela);
	header("location: ".$url_site_admin."list/menu/".$niveis."/".$tabela);
?>