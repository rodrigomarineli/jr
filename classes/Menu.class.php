<?php
	class Menu extends DB{

		private static function Upload($nome_img,$pasta,$renomear,$size=false){
			// var_dump($nome_img);
			$imagem = Geral::salva($pasta,$nome_img,$renomear,$size);
			return $imagem;
		}

		/* MENU VERSÃO 2 */
		static function SelectMenu($tabela,$id=0){
			if($id == 0) {
				$select = self::getConn()->prepare("SELECT * FROM {$tabela} order by `ordem`");
				$select->execute(array());
			}
			else {
				$select = self::getConn()->prepare("SELECT * FROM {$tabela} WHERE `id`=?");
				$select->execute(array($id));
			}
			$dados = $select->fetchAll();
			return $dados;
		}

		static function SelectParentMenu($tabela,$id=0){
			$select = self::getConn()->prepare("SELECT * FROM `{$tabela}` WHERE `mae`=? order by `ordem`");
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		static function AddMenu($tabela,$titulo,$link,$id=0){
			if($id==0){
				$count = self::getConn()->prepare("SELECT COUNT(*) AS total FROM {$tabela}");
				$count->execute();
				$dados = $count->fetchAll();

				// if($imagem['name'] != '')
				// 	$up_imagem = self::Upload('imagem','../img/menu','no');
				// if($icone['name'] != '')
				// 	$up_icone = self::Upload('icone','../img/menu','no');

				$insert = self::getConn()->prepare("INSERT INTO {$tabela}  SET `titulo`=?,`link`=?,`ordem`=?");
				$insert->execute(array($titulo,$link,$dados['0']['total']));
			}
			else{
				// if($imagem['name'] != '') {
				// 	$up_imagem = self::Upload('imagem','../img/menu','no');
				// 	$insert_img = self::getConn()->prepare("UPDATE {$tabela} SET `imagem`=? WHERE `id`=?");
				// 	$insert_img->execute(array($up_imagem,$id));
				// }
				// if($icone['name'] != '') {
				// 	$up_icone = self::Upload('icone','../img/menu','no');
				// 	$insert_icon = self::getConn()->prepare("UPDATE {$tabela} SET `icone`=? WHERE `id`=?");
				// 	$insert_icon->execute(array($up_icone,$id));
				// }

				$insert = self::getConn()->prepare("UPDATE {$tabela} SET `titulo`=?,`link`=? WHERE `id`=?");
				$insert->execute(array($titulo,$link,$id));
			}
		}

		static function SalvaMenu($tabela){
			$limpa = self::limpaMenuMenu($tabela);
			$subnivel = self::PegaSubnivelMenu($tabela);
			foreach ($subnivel as $lista) {
				$upnivelmae = self::UpNivelMaeMenu($tabela,$lista['ordem']-1);
				$nivelmae = ($upnivelmae[0]['id'] == '') ? $nivelmae : $upnivelmae[0]['id'];
				$upsubnivel = self::UpSubnivelMenu($tabela,$lista['id'],$nivelmae);
				
				$sub_subnivel = self::PegaSubSubnivelMenu($tabela);
				foreach ($sub_subnivel as $lista_sub) {
					$upnivelmae2 = self::UpNivelMaeSubMenu($tabela,$lista_sub['ordem']-1);
					$nivelmae2 = ($upnivelmae2[0]['id'] == '') ? $nivelmae2 : $upnivelmae2[0]['id'];
					$upsubnivel2 = self::UpSubSubnivelMenu($tabela,$lista_sub['id'],$nivelmae2);
				}
			}
		}

		private static function PegaSubnivelMenu($tabela){
			$select = self::getConn()->prepare("SELECT * FROM {$tabela} WHERE nivel = 2 ORDER BY ordem ASC");
			$select->execute(array());
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpNivelMaeMenu($tabela,$id){
			$update = self::getConn()->prepare("UPDATE {$tabela} SET sub = 1 WHERE ordem = ? AND nivel = 1");
			$update->execute(array($id));
			$select = self::getConn()->prepare("SELECT * FROM {$tabela} WHERE ordem = ? AND nivel = 1");
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpSubnivelMenu($tabela,$id,$mae){
			$update = self::getConn()->prepare("UPDATE {$tabela} SET mae = ? WHERE id = ?");
			$update->execute(array($mae,$id));
		}

		private static function PegaSubSubnivelMenu($tabela){
			$select = self::getConn()->prepare("SELECT * FROM {$tabela} WHERE nivel = 3 ORDER BY ordem ASC");
			$select->execute(array());
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpNivelMaeSubMenu($tabela,$id){
			$update = self::getConn()->prepare("UPDATE {$tabela} SET sub = 2 WHERE ordem = ? AND nivel = 2");
			$update->execute(array($id));
			$select = self::getConn()->prepare("SELECT * FROM {$tabela} WHERE ordem = ? AND nivel = 2");
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpSubSubnivelMenu($tabela,$id,$mae){
			$update = self::getConn()->prepare("UPDATE {$tabela} SET mae = ? WHERE id = ?");
			$update->execute(array($mae,$id));
		}

		private static function limpaMenuMenu($tabela){
			$update = self::getConn()->prepare("UPDATE {$tabela} SET mae = 0, sub = 0");
			$update->execute(array());
		}
	}
