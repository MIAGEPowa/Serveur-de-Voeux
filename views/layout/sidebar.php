<div id="col">
	<ul>
		<li <?php if($v_menuActive == 'tableaudebord') echo 'class="active"'; ?>><a href="<?php echo WEBROOT; ?>" title="Tableau de bord"><span class="icon-home"></span>Tableau de bord</a></li>
		<li <?php if($v_menuActive == 'enseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="Enseignements"><span class="icon-book"></span>Enseignements</a></li>
		<li <?php if($v_menuActive == 'niveaux') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'niveau/index'; ?>" title=""><span class="icon-heart"></span>Niveaux</a></li>
		<li <?php if($v_menuActive == 'diplomes') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'diplome/index'; ?>" title=""><span class="icon-heart"></span>Diplômes</a></li>
		<li <?php if($v_menuActive == 'specialites') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'specialite/index'; ?>" title=""><span class="icon-heart"></span>Spécialités</a></li>
		<li><a href="#" title=""><span class="icon-heart"></span>Test</a></li>
		<ul class="sub-menu">
			<li><a href="#" title=""><span class="icon-heart"></span>Koi de neuf</a></li>
			<li><a href="#" title=""><span class="icon-heart"></span>Allo quoi</a></li>
			<li><a href="#" title=""><span class="icon-heart"></span>Pomme poire</a></li>
		</ul>
	</ul>
</div>