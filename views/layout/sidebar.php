<div id="col">
	<ul>
	
		<?php
			if($_SESSION['v_droits'] == 1) {
		?>
			<!-- Sidebar Secrétaire -->
			<li <?php if($v_menuActive == 'tableaudebord') echo 'class="active"'; ?>><a href="<?php echo WEBROOT; ?>" title="Tableau de bord"><span class="icon-home"></span>Tableau de bord</a></li>
			<li <?php if($v_menuActive == 'annuaire') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'annuaire/index'; ?>" title="Annuaire"><span class="icon-annuaire"></span>Annuaire</a></li>
		
		<?php
			} else if($_SESSION['v_droits'] == 2) {
		?>
			<!-- Sidebar Enseignant -->
			<li <?php if($v_menuActive == 'tableaudebord') echo 'class="active"'; ?>><a href="<?php echo WEBROOT; ?>" title="Tableau de bord"><span class="icon-home"></span>Tableau de bord</a></li>
			<li <?php if($v_menuActive == 'enseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="Enseignements"><span class="icon-book"></span>Enseignements</a></li>
			<li <?php if($v_menuActive == 'voeux') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'voeu/index'; ?>" title=""><span class="icon-heart"></span>Mes v&oelig;ux</a></li>
			<li <?php if($v_menuActive == 'annuaire') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'annuaire/index'; ?>" title="Annuaire"><span class="icon-annuaire"></span>Annuaire</a></li>
			<li <?php if($v_menuActive == 'delegations') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'utilisateur/delegations'; ?>" title="Gérer ses délégations"><span class="icon-delegations"></span>Délégations</a></li>

		<?php
			} else if($_SESSION['v_droits'] == 3) {
		?>
			<!-- Sidebar Responsable -->
			<li <?php if($v_menuActive == 'tableaudebord') echo 'class="active"'; ?>><a href="<?php echo WEBROOT; ?>" title="Tableau de bord"><span class="icon-home"></span>Tableau de bord</a></li>
			<li <?php if($v_menuActive == 'enseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="Enseignements"><span class="icon-book"></span>Enseignements</a></li>
			<li <?php if($v_menuActive == 'filieresEnseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'filiereEnseignement/index'; ?>" title=""><span class="icon-filieres-enseignement"></span>Filières - Enseignements</a></li>
			<li <?php if($v_menuActive == 'voeux') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'voeu/index'; ?>" title=""><span class="icon-heart"></span>Mes v&oelig;ux</a></li>
			<li <?php if($v_menuActive == 'annuaire') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'annuaire/index'; ?>" title="Annuaire"><span class="icon-annuaire"></span>Annuaire</a></li>
			<li <?php if($v_menuActive == 'delegations') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'utilisateur/delegations'; ?>" title="Gérer ses délégations"><span class="icon-delegations"></span>Délégations</a></li>

		<?php
			} else if($_SESSION['v_droits'] == 4) {
		?>
			<!-- Sidebar Administrateur -->
		
			<li <?php if($v_menuActive == 'tableaudebord') echo 'class="active"'; ?>><a href="<?php echo WEBROOT; ?>" title="Tableau de bord"><span class="icon-home"></span>Tableau de bord</a></li>
			<li <?php if($v_menuActive == 'enseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="Enseignements"><span class="icon-book"></span>Enseignements</a></li>
			<li <?php if($v_menuActive == 'filieres') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'filiere/index'; ?>" title=""><span class="icon-filieres"></span>Filières</a></li>
			<ul class="sub-menu">
				<li <?php if($v_menuActive == 'niveaux') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'niveau/index'; ?>" title="Niveaux"><span class="icon-podium"></span>Niveaux</a></li>
				<li <?php if($v_menuActive == 'diplomes') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'diplome/index'; ?>" title="Diplômes"><span class="icon-cup"></span>Diplômes</a></li>
				<li <?php if($v_menuActive == 'specialites') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'specialite/index'; ?>" title="Spécialités"><span class="icon-star"></span>Spécialités</a></li>
			</ul>
			<li <?php if($v_menuActive == 'filieresEnseignements') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'filiereEnseignement/index'; ?>" title=""><span class="icon-filieres-enseignement"></span>Filières - Enseignements</a></li>
			<li <?php if($v_menuActive == 'voeux') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'voeu/index'; ?>" title=""><span class="icon-heart"></span>Mes v&oelig;ux</a></li>
			<li <?php if($v_menuActive == 'annuaire') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'annuaire/index'; ?>" title="Annuaire"><span class="icon-annuaire"></span>Annuaire</a></li>
			<li <?php if($v_menuActive == 'utilisateurs') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'utilisateur/gestion'; ?>" title="Gérer les utilisateurs"><span class="icon-utilisateurs"></span>Utilisateurs</a></li>
			<ul class="sub-menu">
				<li <?php if($v_menuActive == 'utilisateursAdd') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'utilisateur/add'; ?>" title="Ajouter un utilisateur"><span class="icon-add-utilisateur"></span>Ajouter</a></li>
				<li <?php if($v_menuActive == 'utilisateursImporter') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'utilisateur/importer'; ?>" title="Importer des utilisateurs"><span class="icon-import-utilisateur"></span>Importer</a></li>
			</ul>
			<li <?php if($v_menuActive == 'roles') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'role/index'; ?>" title="Gérer les rôles"><span class="icon-roles"></span>Rôles</a></li>
			<li <?php if($v_menuActive == 'delegations') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'utilisateur/delegations'; ?>" title="Gérer ses délégations"><span class="icon-delegations"></span>Délégations</a></li>
			<li <?php if($v_menuActive == 'keywords') echo 'class="active"'; ?>><a href="<?php echo WEBROOT.'keyword/index'; ?>" title="Recherche"><span class="icon-keywords"></span>Recherche</a></li>
	
		<?php
			}
		?>

	</ul>
</div>