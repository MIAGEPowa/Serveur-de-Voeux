<div id="col">
	<ul>
		<li <?php if($v_menuActive == 'tableaudebord') echo 'class="active"'; ?>><a href="<?php echo WEBROOT; ?>" title="Tableau de bord"><span class="icon-home"></span>Tableau de bord</a></li>
		<li <?php if($v_menuActive == 'enseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="Enseignements"><span class="icon-book"></span>Enseignements</a></li>
		<li <?php if($v_menuActive == 'annuaire') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'annuaire/index'; ?>" title="Annuaire"><span class="icon-annuaire"></span>Annuaire</a></li>
		<li><a href="#" title=""><span class="icon-heart"></span>Filières</a></li>
		<ul class="sub-menu">
			<li <?php if($v_menuActive == 'niveaux') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'niveau/index'; ?>" title=""><span class="icon-podium"></span>Niveaux</a></li>
			<li <?php if($v_menuActive == 'diplomes') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'diplome/index'; ?>" title=""><span class="icon-cup"></span>Diplômes</a></li>
			<li <?php if($v_menuActive == 'specialites') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'specialite/index'; ?>" title=""><span class="icon-star"></span>Spécialités</a></li>
		</ul>
	</ul>
</div>