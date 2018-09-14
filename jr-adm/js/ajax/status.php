<?php include("../../../classes/config.php"); ?>
<?php include("../../../classes/DB.class.php"); ?>
<?php include("../../../classes/class.upload.php"); ?>
<?php include("../../../classes/Geral.class.php"); ?>

<?php

extract($_GET);

$up = Geral::StatusTable($table,$item,$status,$campo);