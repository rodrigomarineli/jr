<?php
$server = $_SERVER['SERVER_NAME'];
if ($server == 'localhost') {
	$url_site = 'http://localhost/script/jr/';
	$url_site_admin = 'http://localhost/script/jr/jr-adm/';

	define('DB_HOST', 'localhost');
	define('DB_NAME', 'jr');
	define('DB_USER', 'root');
	define('DB_PASS', '');

	// MERCADO PAGO
	define('MP_PUBLIC_KEY','TEST-97a660bc-0cf7-4f22-b76a-93b39281fdaf');
	define('MP_ACESS_TOKEN','TEST-6858607877807734-102617-3f133d16e27098bb414611dfeba42199__LC_LA__-255738175');

	define('TO', 'rodrigommoreira@hotmail.com');
	define('TO_NAME', 'Rodrigo Marineli');

} else if ($server == 'agenciafinalite.com.br' || $server == 'www.agenciafinalite.com.br') {
	$url_site = 'http://agenciafinalite.com.br/giord-3/';
	$url_site_admin = 'http://agenciafinalite.com.br/giord-3/gsj-adm/';

	define('DB_HOST', 'localhost');
	define('DB_NAME', 'finalite_giord');
	define('DB_USER', 'finalite_giord');
	define('DB_PASS', '}p4(Bkv3*64n');

	// MERCADO PAGO
	define('MP_PUBLIC_KEY','TEST-97a660bc-0cf7-4f22-b76a-93b39281fdaf');
	define('MP_ACESS_TOKEN','TEST-6858607877807734-102617-3f133d16e27098bb414611dfeba42199__LC_LA__-255738175');

	define('TO', 'pedidos@anabarbara.com.br');
	define('TO_NAME', 'Loja Ana Barbara');
}
else if ($server == 'giord.com.br' || $server == 'www.giord.com.br') {
	$url_site = 'https://giord.com.br/';
	$url_site_admin = 'https://giord.com.br/gsj-adm/';

	define('DB_HOST', 'localhost');
	define('DB_NAME', 'lojagior_lojagiord');
	define('DB_USER', 'lojagior_uslojag');
	define('DB_PASS', '?d!e%m_x$14w');

	// MERCADO PAGO
	define('MP_PUBLIC_KEY','APP_USR-527ca08f-e8d7-4fd1-87df-b0ab4b8433eb');
	define('MP_ACESS_TOKEN','APP_USR-6858607877807734-102617-6060d9b1e0a080ae587f23f7f212e4bd__LB_LC__-255738175');

	define('TO', 'pedidos@giord.com.br');
	define('TO_NAME', 'Loja Giord - Semi Jóias');
}
	// URL's
	define('URLBASE', $url_site);
	// SITE INFO
	define('SITE_NAME', 'JR Compressores');
	define('SESSION', 'JR');
	define('SESSION_ADMIN', 'JR_ADMIN');
	define('SESSION_CART', 'LJR');

	// EMAIL
	define('MAIL_HOST', 'mail.giord.com.br');
	define('MAIL_USER', 'noreply@giord.com.br');
	define('MAIL_SEND', 'noreply@giord.com.br');
	define('MAIL_PASS', 'CAW7XNgAy&k-');
	define('MAIL_PORT', '587');

	//CEP
	define('CEP_ORIGEM','09890370');

	define('DADOS_EMPRESA','Giord - Semi Jóias');