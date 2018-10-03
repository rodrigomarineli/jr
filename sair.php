<?php
	ob_start();
	session_start();
?>
<?php include("classes/config.php"); ?>
<?php include("classes/DB.class.php"); ?>
<?php include("classes/class.upload.php"); ?>
<?php include("classes/Login.class.php"); ?>

<?php
	$sair = Login::sairSite();
	header('Location: '.URLBASE);