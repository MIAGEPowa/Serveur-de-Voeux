<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Voeux</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'voeu/index'; ?>" title="">Voeux</a><span class="delimiter">></span>Modification d'un voeu
		</div>
		
		<div class="text text-full">
			<form id="form-update-voeu" action="#" method="post">
				<fieldset>
					<legend><span class="icon-heart"></span>
						Modifier le voeu
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
							<label for="dateDebut">Date de début de l'enseignement</label>
							<?php echo $filiereEnseignement['date_debut_enseignement']; ?>
						</div>
            
            <div class="form-item">
							<label for="heuresCours">Nombre d'heures de cours</label>
              <input type="hidden" id="nbr_h_cours" value="<?php echo $filiereEnseignement['nbr_h_cours']; ?>"/>
							<?php echo $filiereEnseignement['nbr_h_cours']; ?>
						</div>
						
						<div class="form-item">
							<label for="heuresTD">Nombre d'heures de TD</label>
              <input type="hidden" id="nbr_h_td" value="<?php echo $filiereEnseignement['nbr_h_td']; ?>"/>
							<?php echo $filiereEnseignement['nbr_h_td']; ?>
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
							<label for="heuresCours">Voeu heures de cours</label>
							<input type="text" class="input-little" id="heuresCours" class="input-little" name="heuresCours" value="<?php echo $filiereEnseignement['nb_heures_cours'];?>" maxlength="5" /> heures
						</div>
						
						<div class="form-item">
							<label for="heuresTD">Voeu heures de TD</label>
							<input type="text" class="input-little" id="heuresTD" class="input-little" name="heuresTD" value="<?php echo $filiereEnseignement['nb_heures_td'];?>" maxlength="5" /> heures
						</div>
            
            <div class="form-item">
							<input type="submit" name="voeu_form_update" class="input-submit input-submit-orange" value="Modifier" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>