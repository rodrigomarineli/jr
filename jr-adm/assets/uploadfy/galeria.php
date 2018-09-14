<?php include("../../../classes/DB.class.php");?>
<?php include("../../../classes/class.upload.php");?>
<?php include("../../../classes/Geral.class.php");?>
<?php
$id = $_GET['oferta'];
// $imagens = Ofertas::listGaleria($id);
// foreach ($imagens as $galeria):
?>
<img src="../images/produtos/<?php echo $galeria['imagem'] ?>" width="50" height="auto">
<?php
// endforeach;
?>