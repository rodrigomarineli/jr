<?php include("../../../classes/config.php"); ?>
<?php include("../../../classes/DB.class.php"); ?>
<?php include("../../../classes/class.upload.php"); ?>
<?php include("../../../classes/Geral.class.php"); ?>
<?php
$item = $_GET['item'];
$table = $_GET['table'];
$foto = $_GET['foto'];
$pasta = $_GET['pasta'];
$del = Geral::DelDado($item,$table);
if(isset($foto))
	$del = Geral::DelFoto($pasta,$foto);
?>
<script>
	location.reload();
</script>