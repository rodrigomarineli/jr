<?php include("../../../classes/config.php"); ?>
<?php include("../../../classes/DB.class.php"); ?>
<?php include("../../../classes/class.upload.php"); ?>
<?php include("../../../classes/Geral.class.php"); ?>
<?php
$item = $_GET['item'];
$table = $_GET['table'];
$del = Geral::DelDado($item,$table);
?>
<script>
	location.reload();
</script>