<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières - Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiere/index'; ?>" title="">Filières - Enseignements</a>
		</div>
		
		<div class="text text-full">
			<form id="form-create-filiereEnseignement" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-book"></span>Ajouter une association "Filières - Enseignements"<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label for="filiere">Filière</label>
							<select id="filiere" name="filiere">							
								<?php
								// On parcours le tableau des niveaux
								foreach($arrayFilieres as $filiere) {
									?>
									<option value="<?php echo $filiere['id']; ?>">
										<?php 
										echo $filiere['niveau'].' '.
											 $filiere['specialite'].' '.
											 $filiere['apprentissage_lib']; 
										?>
									</option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label for="enseignement">Enseignement</label>
							<select id="enseignement" name="enseignement">							
								<?php
								// On parcours le tableau des niveaux
								foreach($arrayEnseignements as $enseignement) {
									?>
									<option value="<?php echo $enseignement['id']; ?>"><?php echo $enseignement['libelle']; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label for="annee">Année</label>
							<select id="annee" name="annee">							
								<?php
								// On parcours le tableau des niveaux
								foreach($arrayAnnees as $annee) {
									?>
									<option value="<?php echo $annee; ?>" <?php if($annee == date("Y")) {echo 'selected';} ?>><?php echo $annee; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label for="dateDebut">Date de début de l'enseignement *</label>
							<input type="text" id="dateDebut" class="date" name="dateDebut" value="" maxlength="10" readonly="true"/>
						</div>
						
						<div class="form-item">
							<label for="heuresCours">Nombre d'heures de cours *</label>
							<input type="text" class="input-little" id="heuresCours" class="input-little" name="heuresCours" value="" maxlength="5" /> heures
						</div>
						
						<div class="form-item">
							<label for="heuresTD">Nombre d'heures de TD *</label>
							<input type="text" class="input-little" id="heuresTD" class="input-little" name="heuresTD" value="" maxlength="5" /> heures
						</div>
						
						<div class="form-item">
							<label for="groupesCours">Nombre de groupe de cours *</label>
							<input type="text" class="input-little" id="groupesCours" name="groupesCours" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label for="groupesTD">Nombre de groupe de TD *</label>
							<input type="text" class="input-little" id="groupesTD" name="groupesTD" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label for="semestre">Semestre</label>
							<select id="semestre" name="semestre">
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</div>
						
						<div class="form-item">
							<label for="etudiantsMoyen">Nombre d'étudiants moyen</label>
							<input type="text" class="input-little" id="etudiantsMoyen" name="etudiantsMoyen" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label for="moyenne">Moyenne</label>
							<input type="text" class="input-little decimal" id="moyenne" name="moyenne" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<input type="submit" name="filiereEnseignement_form_add" class="input-submit input-submit-green" value="Enregistrer" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-full">
			<h2>Liste des filières</h2>			

			<?php
			if(count($arrayFilieres) == 0) {
			?>
				<p>
					Aucune filière n'a encore été créée...
				</p>
			<?php
			} else {
			?>
				<table>
					 <thead>
						<tr>
							<th width="12%">#</th>
							<th width="22%">Filière</th>
							<th width="22%">Enseignement</th>
							<th width="22%">Année</th>
							<th width="22%">Responsable</th>
							<th width="22%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// On parcours le tableau des enseignements
						foreach($arrayFiliereEnseignement as $filiereEnseignement) {
						?>
							<tr>
								<td><?php echo $filiereEnseignement['id']; ?></td>
								<td><?php echo $filiereEnseignement['filiere']; ?></td>
								<td><?php echo $filiereEnseignement['enseignement']; ?></td>
								<td><?php echo $filiereEnseignement['annee']; ?></td>
								<td>A venir</td>
								<td>
									<span class="buttons button-green">Visualiser</span><a class="buttons-link" href="<?php echo WEBROOT; ?>filiere/update/<?php echo $filiere['id']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>filiere/delete/<?php echo $filiere['id']; ?>"><span class="buttons button-red">Supprimer</span></a>
								</td>
							</tr>
						<?php 
						} 
						?>
					</tbody>
				</table>
			<?php
			}
			?>
		</div>
		
	</div>
</div>