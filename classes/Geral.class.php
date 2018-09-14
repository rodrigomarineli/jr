<?php
	class Geral extends DB{

		static function TransformaData($data){
			$data = substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2);
			return $data;
		}

		static function MoedaBD($valor){
			$valor = str_replace(".", "", $valor);	
			$valor = str_replace(",", ".", $valor);	
			return $valor;
		}
		
		static function urlamigavel($url,$tag=false) {

			$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ'; 
			$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr'; 
			$url = utf8_decode($url);     
			$url = strtr($url, utf8_decode($a), $b); 
			$url = strtolower($url); 
			$url = utf8_encode($url);
			$url = strip_tags($url);
			if($tag)
				$url = preg_replace("/[^a-zA-Z0-9_,]/", " ", $url);
			else
				$url = preg_replace("/[^a-zA-Z0-9_]/", " ", $url);

			$url = str_replace(" ", "-", $url);
			return $url;
		}

		static function salva($pasta,$nome_img,$renomear,$size=false) {
			$handle = new Upload($_FILES[$nome_img]);
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
				if($size != false) {
					$handle->image_resize = true;
					// $handle->image_ratio_pixels = $size;
					$handle->image_x = $size;
					$handle->image_ratio_y = true;
					// $handle->image_watermark_x = -1;
					// $handle->image_watermark_y = -1;
				}
				if($renomear == 'yes') {
					$handle->file_overwrite = true;
					$handle->file_auto_rename = false;
					$handle->file_new_name_body = $nome_img;
				}
				if($renomear == 'no') {
					$handle->file_overwrite = false;
					$handle->file_auto_rename = true;
				}
				if($renomear == 'random') {
					$handle->file_overwrite = false;
					$handle->file_auto_rename = true;
					$handle->file_new_name_body = md5(rand()*10000000);
				}
				$handle->jpeg_quality = 100;
				$handle->mime_check = true;
				$handle->allowed = array('image/*','application/pdf');
				//$handle->file_max_size = '1048576';
				
				$handle->Process($pasta);
				
				if ($handle->processed)
				{
					$novaimagem = $handle->file_dst_name;
					return $novaimagem;
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
		}

		static function SalvaMultiplo($anexo,$pasta,$tabela,$campo,$id,$tipo,$campoextra='') {
			//INFO IMAGEM
			$file 		= $anexo;
			$numFile	= count(array_filter($file['name']));
			//PASTA
			$folder		= $pasta;
			//REQUISITOS
			$permite 	= array('image/jpeg', 'image/png', 'application/pdf', 'text/plain');
			$maxSize	= 1024 * 1024 * 10;
			//MENSAGENS
			$msg		= array();
			$errorMsg	= array(
				1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
				2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
				3 => 'o upload do arquivo foi feito parcialmente',
				4 => 'Não foi feito o upload do arquivo'
			);
			if($numFile > 0) {
				for($i = 0; $i < $numFile; $i++){
					$name 	= $file['name'][$i];
					$type	= $file['type'][$i];
					$size	= $file['size'][$i];
					$error	= $file['error'][$i];
					$tmp	= $file['tmp_name'][$i];
					if($tipo == 'arquivos') {
						$extensao = @end(explode('.', $name));
						$label = substr($name, 0, -4);
						$novoNome = rand().".$extensao";
					}
					else {
						$novoNome = $id.'_'.$name;
						$extra = $campoextra[$i];
					}
					if($error != 0)
						$msg[] = "<b>$name :</b> ".$errorMsg[$error];
					else if(!in_array($type, $permite))
						$msg[] = "<b>$name :</b> Erro imagem não suportada!";
					else if($size > $maxSize)
						$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 10MB";
					else{
						if(move_uploaded_file($tmp, $folder.'/'.$novoNome)) {
							// $msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
							// $addbd = self::UPIMG($tabela,$campo,$id[$i],$name);
							if($tipo == 'arquivos')
								$addbd = self::AddARQ($tabela,$id,$novoNome,$campo,$label);
							else
								$addbd = self::AddIMG($tabela,$id,$novoNome,$campo,$label,$extra);
						}
						else
							$msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
					}
					foreach($msg as $pop)
						echo $pop.'<br>';
				}
			}
		}

		static function AddARQ($tabela,$id,$anexo,$campo,$name){
			$insert = self::getConn()->prepare('INSERT INTO '.$tabela.' SET '.$campo.'=?, `arquivo`=?, `nome`=?');
			$insert->execute(array($id,$anexo,$name));
		}

		static function AddIMG($tabela,$id,$anexo,$campo,$name,$campoextra){
			$insert = self::getConn()->prepare('INSERT INTO '.$tabela.' SET '.$campo.'=?, `imagem`=?, `descricao`=?');
			$insert->execute(array($id,$anexo,$campoextra));
		}

		static function UPIMG($tabela,$campo,$id,$anexo){
			echo $tabela.'<br/>';
			echo $campo.'<br/>';
			echo $id.'<br/>';
			echo $anexo.'<br/>';
			$insert = self::getConn()->prepare('UPDATE '.$tabela.' SET '.$campo.'=? WHERE `id`=?');
			$insert->execute(array($anexo,$id));
		}

		static function SendMail($subject, $message, $to, $toName, $anexo=false, $from=null, $FromName=null){
			$mail = new PHPMailer();

			// Servidor
			$mail->isSMTP();
			$mail->SMTPDebug 	= false;
			$mail->Host 		= MAIL_HOST;
			$mail->SMTPAuth 	= true;
			$mail->Username 	= MAIL_USER;
			$mail->Password 	= MAIL_PASS;
			$mail->Port 		= MAIL_PORT;
			$mail->SMTPSecure 	= MAIL_SECURE;

			if($from == null) {
				// Remetente
				$mail->From 		= MAIL_SEND;
				$mail->FromName 	= SITE_NAME;
			}
			else{
				// Remetente
				$mail->From 		= $from;
				$mail->FromName 	= $FromName;
			}

			// Destino
			$mail->addAddress($to, $toName);

			// Dados da Mensagem
			$mail->isHTML(true);
			$mail->CharSet 	= 'utf-8';
			$mail->WordWrap = 70;

			// Mensagem
			$mail->Subject 	= $subject;
			$mail->Body 	= $message;
			$mail->AltBody 	= strip_tags($message);
			if($anexo != false) {
				$mail->AddAttachment($anexo);
			}

			if(!$mail->send()) {
				return $mail->ErrorInfo;
			} else {
				return '1';
			}
		}
		
		static function Paginacao($total_por_pagina,$total,$pag,$url){
			$total_pag = ceil($total/$total_por_pagina);
			$pag = ($pag >= $total_pag) ? $total_pag : $pag;
			$pag = ($pag <= 0) ? 1 : $pag;
			$limit = $total_por_pagina;
			$offset = ($pag - 1) * $total_por_pagina;
			$next = $pag + 1;
			$prev = $pag - 1;
			$dados['limit'] = $limit;
			$dados['offset'] = $offset;
			$dados['next'] = $next;
			$dados['prev'] = $prev;
			$dados['pag'] = $pag;
			if($total_pag != 1) {
				$html .= '<ul class="pagination">';
				if($prev != 0) {
					$html .= '<li><a href="'.$url.$prev.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
				}
				else {
					$html .= '<li><a aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
				}
				for ($i=1; $i <= $total_pag; $i++) { 
					$nav = ($i == $pag) ? '<li class="active"><a>'.$i.'</a></li>' : '<li><a href="'.$url.$i.'">'.$i.'</a></li>';
					$html .= $nav;
				}
				if ($pag != $total_pag) {
					$html .= '<li><a href="'.$url.$next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
				}
				else {
					$html .= '<li><a aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
				}
				$html .= '</ul>';
			}
			$dados['html'] = $html;
			return $dados;
		}

		static function StatusTable($table,$id,$status,$campo){
			$up = self::getConn()->prepare('UPDATE '.$table.' SET '.$campo.'=? WHERE `id`=?');
			$up->execute(array($status,$id));
		}

		static function PagamentoTable($table,$id,$status){
			$up = self::getConn()->prepare('UPDATE '.$table.' SET `pagamento`=? WHERE `id`=?');
			$up->execute(array($status,$id));
		}

		static function DelDado($id,$table){
			$up = self::getConn()->prepare('DELETE FROM '.$table.' WHERE `id`=?');
			$up->execute(array($id));
		}

		static function DelFoto($pasta,$foto){
			unlink($pasta.$foto);
		}

		static function AlteraOrdem($table,$page,$id,$ordem){
			$update = self::getConn()->prepare('UPDATE '.$table.' SET `ordem` = ? WHERE `id`=?');
			$update->execute(array($ordem,$id));
			// return $update;
		}

		static function FormataVideo($video){
			$video = explode('v=', $video);
			$video = substr($video[1], 0, 11);
			return $video;
		}

		static function FormataVideoVimeo($video){
			$video = explode('/', $video);
			// $video = substr($video[1], 0, 11);
			$vimeo = array_pop($video);
			return $vimeo;
		}

		static function MontarLink($texto)	{
			if (!is_string($texto))
				return $texto;
			$er = "/(http(s)?:\/\/(www|.*?\/)?((\.|\/)?[a-zA-Z0-9&%_?=-]+)+)/i";
			preg_match_all($er, $texto, $match);
			
			foreach ($match[0] as $link)
			{
				// $link = strtolower($link);
				$link_len = strlen($link);
				
				//troca "&" por "&amp;", tornando o link válido pela W3C
				$web_link = str_replace("&", "&amp;", $link);
				
				$texto = str_ireplace($link, "<a href=\"" . $web_link . "\" target=\"_blank\" title=\"". $web_link . "\" rel=\"nofollow\">". (($link_len > 60) ? substr($web_link, 0, 25) . "..." . substr($web_link, -15) : $web_link) . "</a>", $texto);
			}
			
			return $texto;
		}

		static function display_menus($parent_id = 0,$url_site){
			$menu = Page::SelectParentMenu($parent_id);
			if($parent_id == 0) {
				$ul = '';
			}
			else {
				$ul = '<ul>';
			}
			$html = $ul;
			foreach ($menu as $lista) {
				$submenu = Page::SelectParentMenu($lista['id']);
				if(isset($submenu[0]['id'])) {
					$html .= "<li class='has-sub'><a href=".$url_site.$lista['link'].">".$lista['titulo']."</a>";
				}
				else{
					$html .= "<li><a href=".$url_site.$lista['link'].">".$lista['titulo']."</a></li>";
				}
				$html .= self::display_menus($lista['id'],$url_site);
				$html .= "</li>";
			}
			$html .= "</ul>";

			return $html;
		}

		static function calcula_frete($servico,$CEPdestino,$peso,$valor,$CEPorigem=CEP_ORIGEM,$altura='4',$largura='12',$comprimento='16'){
			$valor = ($valor < 20) ? 20 : $valor;
			// echo 'origem: '.$CEPorigem;
			////////////////////////////////////////////////
			// Código dos Serviços dos Correios
			// 04510 PAC
			// 04014 SEDEX
			// 40045 SEDEX a Cobrar
			// 40215 SEDEX 10
			////////////////////////////////////////////////
			// URL do WebService
			$correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$CEPorigem."&sCepDestino=".$CEPdestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor."&sCdAvisoRecebimento=n&nCdServico=".$servico."&nVlDiametro=0&StrRetorno=xml";
			// Carrega o XML de Retorno
			$curl = curl_init($correios);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($curl);
			// print_r($data);

			$xml = simplexml_load_string($data);
			// Verifica se não há erros
			if($xml->cServico->Erro == '0'){
				return $xml->cServico;
			}else if($xml->cServico->Valor != '0,00'){
				return $xml->cServico;
			}else{
				return false;
			}

		}

		static function verificaFrete($cep,$peso,$valor){
			$desconto = CRUD::Select('frete_desconto');
			$dias = CRUD::Select('frete_dias');
			$pac = Geral::calcula_frete('04510',$cep,$peso,$valor);
			$sedex = Geral::calcula_frete('04014',$cep,$peso,$valor);
			$prazo_extra = 0;

			foreach ($_SESSION[SESSION_CART]['cart'] as $verPrazo) {
				$prazo_extra = ($prazo_extra <= $verPrazo['prazo_extra']) ? $verPrazo['prazo_extra'] : $prazo_extra;
			};

			$desconto_frete = floatval($desconto['dados'][0]['valor']);

			$float_pac = str_replace(',','.',$pac->Valor);
			$float_pac = floatval($float_pac);

			$float_sedex = str_replace(',','.',$sedex->Valor);
			$float_sedex = floatval($float_sedex);

			if($desconto_frete > 0) {
				$float_pac = $float_pac - ($float_pac * $desconto_frete / 100);
				$float_sedex = $float_sedex - ($float_sedex * $desconto_frete / 100);
			}

			$valor_pac = number_format($float_pac,2,',','.');
			$valor_sedex = number_format($float_sedex,2,',','.');

			$frete = array(
				'valor_pac' => $valor_pac,
				'prazo_pac' => $pac->PrazoEntrega+$dias['dados'][0]['dias']+$prazo_extra,
				'float_pac' => $float_pac,
				'valor_sedex' => $valor_sedex,
				'prazo_sedex' => $sedex->PrazoEntrega+$dias['dados'][0]['dias']+$prazo_extra,
				'float_sedex' => $float_sedex
			);

			return $frete;
		}

	}
?>	