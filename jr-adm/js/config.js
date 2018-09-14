var server = document.domain;
if (server == 'localhost') {
	var url_site = 'http://localhost/script/jr/jr-adm/';
} else if (server == 'agenciafinalite.com.br' || server == 'www.agenciafinalite.com.br') {
	var url_site = 'http://agenciafinalite.com.br/giord-3/gsj-adm/';
}
else if (server == 'giord.com.br' || server == 'www.giord.com.br') {
	var url_site = 'https://giord.com.br/gsj-adm/';
}