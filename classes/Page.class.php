<?php
	class Page extends DB{

		static function SelectMenu($id=0){
			if($id == 0) {
				$select = self::getConn()->prepare('SELECT * FROM `menu` order by `ordem`');
				$select->execute(array());
			}
			else {
				$select = self::getConn()->prepare('SELECT * FROM `menu` WHERE `id`=?');
				$select->execute(array($id));
			}
			$dados = $select->fetchAll();
			return $dados;
		}

		static function SelectParentMenu($id=0){
			$select = self::getConn()->prepare('SELECT * FROM `menu` WHERE `mae`=? order by `ordem`');
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		static function AddMenu($titulo,$link,$id=0){
			if($id==0){
				$insert = self::getConn()->prepare('INSERT INTO `menu` SET `titulo`=?,`link`=?');
				$insert->execute(array($titulo,$link));
			}
			else{
				$insert = self::getConn()->prepare('UPDATE `menu` SET `titulo`=?,`link`=? WHERE `id`=?');
				$insert->execute(array($titulo,$link,$id));
			}
		}

		static function SalvaMenu(){
			$limpa = self::limpaMenu();
			$subnivel = self::PegaSubnivel();
			foreach ($subnivel as $lista) {
				$upnivelmae = self::UpNivelMae($lista['ordem']-1);
				$nivelmae = ($upnivelmae[0]['id'] == '') ? $nivelmae : $upnivelmae[0]['id'];
				$upsubnivel = self::UpSubnivel($lista['id'],$nivelmae);
			}
		}

		private static function PegaSubnivel(){
			$select = self::getConn()->prepare('SELECT * FROM menu WHERE nivel = 2 ORDER BY ordem ASC');
			$select->execute(array());
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpNivelMae($id){
			$update = self::getConn()->prepare('UPDATE menu SET sub = 1 WHERE ordem = ? AND nivel = 1');
			$update->execute(array($id));
			$select = self::getConn()->prepare('SELECT * FROM menu WHERE ordem = ? AND nivel = 1');
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpSubnivel($id,$mae){
			$update = self::getConn()->prepare('UPDATE menu SET mae = ? WHERE id = ?');
			$update->execute(array($mae,$id));
		}

		private static function limpaMenu(){
			$update = self::getConn()->prepare('UPDATE menu SET mae = 0, sub = 0');
			$update->execute(array());
		}

		static function SelectSidebar($id=0){
			if($id == 0) {
				$select = self::getConn()->prepare('SELECT * FROM `sidebar` order by `ordem`');
				$select->execute(array());
			}
			else {
				$select = self::getConn()->prepare('SELECT * FROM `sidebar` WHERE `id`=?');
				$select->execute(array($id));
			}
			$dados = $select->fetchAll();
			return $dados;
		}

		static function SelectParentSidebar($id=0){
			$select = self::getConn()->prepare('SELECT * FROM `sidebar` WHERE `mae`=? order by `ordem`');
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		static function AddSidebar($titulo,$link,$id=0){
			if($id==0){
				$insert = self::getConn()->prepare('INSERT INTO `sidebar` SET `titulo`=?,`link`=?');
				$insert->execute(array($titulo,$link));
			}
			else{
				$insert = self::getConn()->prepare('UPDATE `sidebar` SET `titulo`=?,`link`=? WHERE `id`=?');
				$insert->execute(array($titulo,$link,$id));
			}
		}

		static function SalvaSidebar(){
			$limpa = self::limpaMenuSidebar();
			$subnivel = self::PegaSubnivelSidebar();
			foreach ($subnivel as $lista) {
				$upnivelmae = self::UpNivelMaeSidebar($lista['ordem']-1);
				$nivelmae = ($upnivelmae[0]['id'] == '') ? $nivelmae : $upnivelmae[0]['id'];
				$upsubnivel = self::UpSubnivelSidebar($lista['id'],$nivelmae);
			}
		}

		private static function PegaSubnivelSidebar(){
			$select = self::getConn()->prepare('SELECT * FROM sidebar WHERE nivel = 2 ORDER BY ordem ASC');
			$select->execute(array());
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpNivelMaeSidebar($id){
			$update = self::getConn()->prepare('UPDATE sidebar SET sub = 1 WHERE ordem = ? AND nivel = 1');
			$update->execute(array($id));
			$select = self::getConn()->prepare('SELECT * FROM sidebar WHERE ordem = ? AND nivel = 1');
			$select->execute(array($id));
			$dados = $select->fetchAll();
			return $dados;
		}

		private static function UpSubnivelSidebar($id,$mae){
			$update = self::getConn()->prepare('UPDATE sidebar SET mae = ? WHERE id = ?');
			$update->execute(array($mae,$id));
		}

		private static function limpaMenuSidebar(){
			$update = self::getConn()->prepare('UPDATE sidebar SET mae = 0, sub = 0');
			$update->execute(array());
		}
	}
