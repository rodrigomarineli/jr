<?php include("../../../classes/config.php"); ?>
<?php include("../../../classes/DB.class.php"); ?>
<?php include("../../../classes/class.upload.php"); ?>
<?php include("../../../classes/Geral.class.php"); ?>
<?php include("../../../classes/Categoria.class.php"); ?>

<?php

extract($_POST);

$up = Categoria::SelectOutrosCategoria($categoria);

echo $up['dados'][0]['preco'];