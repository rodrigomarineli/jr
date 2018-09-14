<?php
	
	class Login extends DB{
		static private function crip($senha){
			$senhacrip = sha1($senha);
			return $senhacrip;
		}

		static private function validar($usuario,$senha){
			$senha = self::crip($senha);


			try{
			$validar = self::getConn()->prepare('SELECT id, nome FROM `user` WHERE `login`=? AND `senha`=? LIMIT 1');
			$validar->execute(array($usuario,$senha));

			
			if($validar->rowCount()==1){
				$asValidar = $validar->fetch(PDO::FETCH_NUM);
				$_SESSION[SESSION_ADMIN.'_uid'] = $asValidar[0];
				$_SESSION[SESSION_ADMIN.'_nome'] = $asValidar[1];
				return true;
			}else{
				return false;
			}
			
			
			}catch(PDOException $e){
				$erro = 'Sistema indisponível';
				logErros($e);
				return false;
			}
		}

		static function logar($usuario,$senha){
			if(self::validar($usuario,$senha)){
				
				if(!isset($_SESSION)){
					session_start();
				}
				
				return true;
			}else{
				$erro=  'Usuario invalido';
				return false;
			}
		}

		static function sair($cookie=true){
			if(!isset($_SESSION)){
				session_start();
			}
			
			unset($_SESSION[SESSION_ADMIN.'_uid']);
			unset($_SESSION[SESSION_ADMIN.'_nome']);
			
			return false;
		}

		/* LOGIN DO SITE */
		static private function validarSite($usuario,$senha){
			$senha = self::crip($senha);

			try{
			$validar = self::getConn()->prepare('SELECT id, nome FROM `cliente` WHERE `email`=? AND `senha`=? LIMIT 1');
			$validar->execute(array($usuario,$senha));

			if($validar->rowCount()==1){
				$asValidar = $validar->fetch(PDO::FETCH_NUM);
				$_SESSION[SESSION_CART]['cliente']['id'] = $asValidar[0];
				$_SESSION[SESSION_CART]['cliente']['nome'] = $asValidar[1];
				return true;
			}else{
				return false;
			}
			
			
			}catch(PDOException $e){
				$erro = 'Sistema indisponível';
				logErros($e);
				return false;
			}
		}

		static function logarSite($usuario,$senha){
			if(self::validarSite($usuario,$senha)){
				
				if(!isset($_SESSION)){
					session_start();
				}
				
				return true;
			}else{
				$erro=  'Usuario invalido';
				return false;
			}
		}

		static function sairSite($cookie=true){
			if(!isset($_SESSION)){
				session_start();
			}
			
			unset($_SESSION[SESSION_CART]['cliente']);
			
			return false;
		}

		static function ConfirmaUser($email){
			$validar = self::getConn()->prepare('UPDATE `usuarios` SET  `valida` = 1, `cripemail` = "" WHERE `cripemail`=?');
			$validar->execute(array($email));
		}

		static function CripEmail($email,$id){
			$validar = self::getConn()->prepare('UPDATE `usuarios` SET  `cripemail` = ? WHERE `id`=?');
			$validar->execute(array($email,$id));
		}

		static function CripSenha($cripemail,$email){
			$validar = self::getConn()->prepare('UPDATE `usuarios` SET  `cripemail` = ? WHERE `email`=?');
			$validar->execute(array($cripemail,$email));
		}

		static function UpSenha($senha,$email){
			$senha = self::crip($senha);
			$validar = self::getConn()->prepare('UPDATE `usuarios` SET  `senha` = ?, `cripemail` = "" WHERE `cripemail`=?');
			$validar->execute(array($senha,$email));
		}

	}