<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières - Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiereEnseignement/index'; ?>" title="">Filières - Enseignements</a><span class="delimiter">></span>Visualisation d'une association filière-enseignement
		</div>
		
		<div class="text text-full">
			<form id="form-update-filiereEnseignement" action="#" method="post">
				<fieldset>
					<legend><span class="icon-book"></span>
						Visualiser l'association "<?php echo $filiereEnseignement['filiere']; ?>"-"<?php echo $filiereEnseignement['enseignement']; ?>"
					</legend>
					<div>
						<div class="form-item">
							<label for="filiere">Filière</label>
							<?php echo $filiereEnseignement['filiere']; ?>
						</div>
						
						<div class="form-item">
							<label for="enseignement">Enseignement</label>
							<?php echo $filiereEnseignement['enseignement']; ?>
						</div>
						
						<div class="form-item">
							<label for="annee">Année</label>
							<?php echo $filiereEnseignement['annee']; ?>
						</div>
						
						<div class="form-item">
							<label for="dateDebut">Date de début de l'enseignement *</label>
							<?php echo $filiereEnseignement['date_debut_enseignement']; ?>
						</div>
						
						<div class="form-item">
							<label for="heuresCours">Nombre d'heures de cours *</label>
							<?php echo $filiereEnseignement['nbr_h_cours']; ?>
						</div>
						
						<div class="form-item">
							<label for="heuresTD">Nombre d'heures de TD *</label>
							<?php echo $filiereEnseignement['nbr_h_td']; ?>
						</div>
						
						<div class="form-item">
							<label for="groupesCours">Nombre de groupe de cours *</label>
							<?php echo $filiereEnseignement['nbr_groupes_cours']; ?>
						</div>
						
						<div class="form-item">
							<label for="groupesTD">Nombre de groupe de TD *</label>
							<?php echo $filiereEnseignement['nbr_groupes_td']; ?>
						</div>
						
						<div class="form-item">
							<label for="semestre">Semestre</label>
							<?php echo $filiereEnseignement['semestre']; ?>
						</div>
						
						<div class="form-item">
							<label for="etudiantsMoyen">Nombre d'étudiants moyen</label>
							<?php echo $filiereEnseignement['nbr_etudiants_moyen']; ?>
						</div>
						
						<div class="form-item">
							<label for="moyenne">Moyenne</label>
							<?php echo $filiereEnseignement['moyenne']; ?>
						</div>
						
						<div class="form-item">
							<input type="submit" name="filiereEnseignement_form_update" class="input-submit input-submit-orange" value="Modifier" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>