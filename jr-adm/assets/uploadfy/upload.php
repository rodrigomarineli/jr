<?php include("../../../classes/DB.class.php");?>
<?php include("../../../classes/class.upload.php");?>
<?php include("../../../classes/Geral.class.php");?>
<?php
$oferta = (int)$_GET['oferta'];
$handle = new Upload($_FILES['Filedata']);
var_dump($handle);
if ($handle->uploaded) 
{
	// $img = 0;
	//$handle->image_resize = true;
	//$handle->image_ratio_y = false;
	//$handle->image_x = 640;
	//$handle->image_y = 350;
	//$handle->image_watermark = 'watermark.png';
	//$handle->image_watermark_x = -1;
	//$handle->image_watermark_y = -1;
	$handle->file_overwrite = false;
	$handle->file_auto_rename = true;
	$handle->file_new_name_body = md5(rand()*10000000);
	$handle->jpeg_quality = 60;
	$handle->mime_check = true;
	$handle->allowed = array('image/*');
	//$handle->file_max_size = '1048576';
	
	$handle->Process('../../../images/produtos');
	
	if ($handle->processed)
	{
		$novaimagem = $handle->file_dst_name;
		// $insere = Ofertas::inserebanco($oferta,$novaimagem);
	}
	else
	{
		echo '<fieldset>';
		echo ' <legend>Erro encontrado!</legend>';
		echo ' Erro: ' . $handle->error . '';
		echo '</fieldset>';
	}
	$handle-> Clean();
}
?>