<?php include('header.php'); ?>
<?php
foreach ($_GET['listItem'] as $position => $item) {
	$up = Geral::AlteraOrdem($_GET['table'],$_GET['page'],$item,$position);
}