<?php ob_start(); ?>
<?php session_start(); ?>
<?php
	require( dirname( __FILE__ ) . '/../classes/config.php' );
	require( dirname( __FILE__ ) . '/../classes/DB.class.php' );
	require( dirname( __FILE__ ) . '/../classes/class.upload.php' );
	require( dirname( __FILE__ ) . '/../classes/PHPMailerAutoload.php' );
	require( dirname( __FILE__ ) . '/../classes/Geral.class.php' );
	require( dirname( __FILE__ ) . '/../classes/CRUD.class.php' );
	// require( dirname( __FILE__ ) . '/../classes/Menu.class.php' );
	require( dirname( __FILE__ ) . '/../classes/Login.class.php' );

	// if($_SERVER['HTTPS'] == '')
	// 	header('Location: https://giord.com.br/');
	// if($_SERVER['SERVER_NAME'] == 'www.giord.com.br')
    //     header('Location: https://giord.com.br/');
    
	$dados_gerais = CRUD::Select('dados');
	$title = $dados_gerais['dados'][0]['title'];
	$meta = $dados_gerais['dados'][0]['meta'];
	$outras = $dados_gerais['dados'][0]['outras'];
?>