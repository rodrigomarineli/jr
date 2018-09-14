		<!-- BEGIN Container -->
		<div class="container-fluid" id="main-container">
		<!-- BEGIN Sidebar -->
		<div id="sidebar" class="nav-collapse" style="height: auto;">
			<!-- BEGIN Navlist -->
			<ul class="nav nav-list">
				<!-- BEGIN Search Form -->
				<li>
					<br/>
				</li><!-- END Search Form -->


				<?php
					$menu = CRUD::SelectOne('formularios','mae',0,'ordem ASC');
					// var_dump($select_menu);
					foreach ($menu['dados'] as $lista_menu) {
						// var_dump($lista_menu['tabela']);
						if($lista_menu['add'] == 1) {
				?>
				<li <?php if($select_menu == $lista_menu['tabela']) { echo 'class="active"'; } ?>>
					<a href="#" class="dropdown-toggle">
						<i class="<?php echo $lista_menu['icon'] ?>"></i>
						<span><?php echo $lista_menu['nome'] ?></span>
						<b class="arrow icon-angle-right"></b>
					</a>

					<!-- BEGIN Submenu -->
					<ul class="submenu">
						<?php if($lista_menu['list'] == 1) { ?>
						<li <?php if($select_submenu == $lista_menu['tabela'].'_todos') { echo 'class="active"'; } ?>><a href="<?php echo $url_site_admin.'list/'.$lista_menu['tabela'] ?>">Todos</a></li>
						<?php } ?>
						<?php if($lista_menu['add'] == 1) { ?>
						<li <?php if($select_submenu == $lista_menu['tabela'].'_novo') { echo 'class="active"'; } ?>><a href="<?php echo $url_site_admin.'add/'.$lista_menu['tabela'] ?>">Adicionar Novo</a></li>
						<?php } ?>
						<?php
							$extra = CRUD::SelectTwoMore('formularios','mae = '.$lista_menu['id'].' AND menu = 1','ordem ASC');
							foreach ($extra['dados'] as $lista_extra) {
								$link = ($lista_extra['link'] == '') ? $url_site_admin.'list/'.$lista_extra['tabela'] : $url_site_admin.$lista_extra['link'];
						?>
						<li <?php if($select_submenu == $lista_extra['tabela'].'_todos') { echo 'class="active"'; } ?>><a href="<?php echo $link ?>"><?php echo $lista_extra['nome'] ?></a></li>
						<?php
							}
						?>
					</ul><!-- END Submenu -->
				</li>
				<?php
						}
						else if($lista_menu['add'] == 0) {
							$single = CRUD::Select($lista_menu['tabela']);
							$link = ($lista_menu['link'] == '') ? $url_site_admin.'add/'.$lista_menu['tabela'].'/'.$single['dados'][0]['id'] : $url_site_admin.$lista_menu['link'];
				?>
				<li <?php if($select_menu == $lista_menu['tabela']) { echo 'class="active"'; } ?>>
					<a href="<?php echo $link ?>" class="dropdown-toggle">
						<i class="<?php echo $lista_menu['icon'] ?>"></i>
						<span><?php echo $lista_menu['nome'] ?></span>
					</a>
				</li>
				<?php
						}
						else if($lista_menu['add'] == 2) {
				?>
				<li <?php if($select_menu == $lista_menu['tabela']) { echo 'class="active"'; } ?>>
					<a href="#" class="dropdown-toggle">
						<i class="<?php echo $lista_menu['icon'] ?>"></i>
						<span><?php echo $lista_menu['nome'] ?></span>
						<b class="arrow icon-angle-right"></b>
					</a>

					<!-- BEGIN Submenu -->
					<ul class="submenu">
						<?php if($lista_menu['list'] == 1) { ?>
						<li <?php if($select_submenu == $lista_menu['tabela'].'_todos') { echo 'class="active"'; } ?>><a href="<?php echo $url_site_admin.'add/'.$lista_menu['tabela'] ?>/1"><?php echo $lista_menu['nome'] ?></a></li>
						<?php } ?>
						<?php
							$extra = CRUD::SelectTwoMore('formularios','mae = '.$lista_menu['id'].' AND menu = 1','ordem ASC');
							foreach ($extra['dados'] as $lista_extra) {
								$link = ($lista_extra['link'] == '') ? $url_site_admin.'list/'.$lista_extra['tabela'] : $url_site_admin.$lista_extra['link'];
								$link = ($lista_extra['add'] == 0) ? $url_site_admin.'add/'.$lista_extra['tabela'].'/1' : $link;
						?>
						<li <?php if($select_submenu == $lista_extra['tabela'].'_todos') { echo 'class="active"'; } ?>><a href="<?php echo $link ?>"><?php echo $lista_extra['nome'] ?></a></li>
						<?php
							}
						?>
					</ul><!-- END Submenu -->
				</li>
				<?php
						}
						else if($lista_menu['add'] == 3 || $lista_menu['add'] == 4) {
							$link = ($lista_menu['link'] == '') ? $url_site_admin.'list/'.$lista_menu['tabela'] : $url_site_admin.$lista_menu['link'];
				?>
				<li <?php if($select_menu == $lista_menu['tabela']) { echo 'class="active"'; } ?>>
					<a href="#" class="dropdown-toggle">
						<i class="<?php echo $lista_menu['icon'] ?>"></i>
						<span><?php echo $lista_menu['nome'] ?></span>
						<b class="arrow icon-angle-right"></b>
					</a>

					<!-- BEGIN Submenu -->
					<ul class="submenu">
						<?php if($lista_menu['list'] == 1) { ?>
						<li <?php if($select_submenu == $lista_menu['tabela'].'_todos') { echo 'class="active"'; } ?>><a href="<?php echo $link ?>"><?php echo ucwords($lista_menu['tabela']) ?></a></li>
						<?php } ?>
						<?php
							$extra = CRUD::SelectTwoMore('formularios','mae = '.$lista_menu['id'].' AND menu = 1','ordem ASC');
							foreach ($extra['dados'] as $lista_extra) {
								$link = ($lista_extra['link'] == '') ? $url_site_admin.'list/'.$lista_extra['tabela'] : $url_site_admin.$lista_extra['link'];
								$link = ($lista_extra['add'] == 0) ? $url_site_admin.'add/'.$lista_extra['tabela'].'/1' : $link;
						?>
						<li <?php if($select_submenu == $lista_extra['tabela'].'_todos') { echo 'class="active"'; } ?>><a href="<?php echo $link ?>"><?php echo $lista_extra['nome'] ?></a></li>
						<?php
							}
						?>
					</ul><!-- END Submenu -->
				</li>
				<?php
						}
					}
				?>

			</ul><!-- END Navlist -->

			<!-- BEGIN Sidebar Collapse Button -->
			<div id="sidebar-collapse" class="visible-desktop">
				<i class="icon-double-angle-left"></i>
			</div><!-- END Sidebar Collapse Button -->
		</div><!-- END Sidebar -->