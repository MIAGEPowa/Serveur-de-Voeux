<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières - Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiereEnseignement/index'; ?>" title="">Filières - Enseignements</a><span class="delimiter">></span>Modification d'une association filière-enseignement
		</div>
		
		<div class="text text-full">
			<form id="form-update-filiereEnseignement" action="#" method="post">
				<fieldset>
					<legend><span class="icon-book"></span>
						Modifier l'association <?php echo $filiereEnseignement['filiere']; ?> - <?php echo $filiereEnseignement['enseignement']; ?>
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
							<input type="text" id="dateDebut" class="date" name="dateDebut" value="<?php echo $filiereEnseignement['date_debut_enseignement']; ?>" maxlength="10" readonly="true"/>
						</div>
						
						<div class="form-item">
							<label for="heuresCours">Nombre d'heures de cours *</label>
							<input type="text" class="input-little" id="heuresCours" class="input-little" name="heuresCours" value="<?php echo $filiereEnseignement['nbr_h_cours']; ?>" maxlength="5" /> heures
						</div>
						
						<div class="form-item">
							<label for="heuresTD">Nombre d'heures de TD *</label>
							<input type="text" class="input-little" id="heuresTD" class="input-little" name="heuresTD" value="<?php echo $filiereEnseignement['nbr_h_td']; ?>" maxlength="5" /> heures
						</div>
						
						<div class="form-item">
							<label for="groupesCours">Nombre de groupe de cours *</label>
							<input type="text" class="input-little" id="groupesCours" name="groupesCours" value="<?php echo $filiereEnseignement['nbr_groupes_cours']; ?>" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label for="groupesTD">Nombre de groupe de TD *</label>
							<input type="text" class="input-little" id="groupesTD" name="groupesTD" value="<?php echo $filiereEnseignement['nbr_groupes_td']; ?>" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label for="semestre">Semestre</label>
							<select id="semestre" name="semestre">
								<option value="1" <?php if($filiereEnseignement['semestre']==1) {echo "selected";} ?>>1</option>
								<option value="2" <?php if($filiereEnseignement['semestre']==2) {echo "selected";} ?>>2</option>
							</select>
						</div>
						
						<div class="form-item">
							<label for="etudiantsMoyen">Nombre d'étudiants moyen</label>
							<input type="text" class="input-little" id="etudiantsMoyen" name="etudiantsMoyen" value="<?php echo $filiereEnseignement['nbr_etudiants_moyen']; ?>" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label for="moyenne">Moyenne</label>
							<input type="text" class="input-little decimal" id="moyenne" name="moyenne" value="<?php echo $filiereEnseignement['moyenne']; ?>" maxlength="5" />
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