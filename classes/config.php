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
	define('MP_PUBLIC_KEY','');
	define('MP_ACESS_TOKEN','');

	define('TO', 'romarineli@gmail.com');
	define('TO_NAME', 'Rodrigo Marineli');

} else if ($server == 'novajrcompressores.com.br' || $server == 'www.novajrcompressores.com.br') {
	$url_site = 'http://novajrcompressores.com.br/novo/';
	$url_site_admin = 'http://novajrcompressores.com.br/novo/jr-adm/';

	define('DB_HOST', 'mysql.novajrcompressores.com.br');
	define('DB_NAME', 'novajrcomp');
	define('DB_USER', 'web_novajr');
	define('DB_PASS', 'N0v4JRc0mpR3550R35');

	// MERCADO PAGO
	define('MP_PUBLIC_KEY','');
	define('MP_ACESS_TOKEN','');

	define('TO', 'pedidos@novajrcompressores.com.br');
	define('TO_NAME', 'Nova JR Compressores');
}
	// URL's
	define('URLBASE', $url_site);
	// SITE INFO
	define('SITE_NAME', 'JR Compressores');
	define('SESSION', 'JR');
	define('SESSION_ADMIN', 'JR_ADMIN');
	define('SESSION_CART', 'LJR');

	// EMAIL
	define('MAIL_HOST', 'mail.novajrcompressores.com.br');
	define('MAIL_USER', 'online@novajrcompressores.com.br');
	define('MAIL_SEND', 'online@novajrcompressores.com.br');
	define('MAIL_PASS', 'N0v4JRc0mpR3550R35');
	define('MAIL_PORT', '587');

	define('DADOS_EMPRESA','Nova JR Compressores');