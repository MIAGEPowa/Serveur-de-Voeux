<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières - Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiereEnseignement/index'; ?>" title="">Filières - Enseignements</a><span class="delimiter">&gt;</span>Mode administateur
		</div>
		
		<div class="text text-full">
			<a href="<?php echo WEBROOT; ?>filiereEnseignement/index" title="Mode enseignant"><span id="mode-enseignant" class="buttons button-green" style="float: right;">Mode enseignant</span></a>
			<div class="clear"></div>
		</div>
		
		<div class="text text-full div-mode-admin">
			<form id="form-create-filiereEnseignement" action="<?php echo WEBROOT; ?>filiereEnseignement/admin" method="POST">
				<fieldset>
					<legend class="button-slide"><span class="icon-filieres-enseignement"></span>Associer un enseignement à une filière<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label class="label-large" for="filiere">Filière</label>
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
							<label class="label-large" for="enseignement">Enseignement</label>
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
							<label class="label-large" for="annee">Année</label>
							<select id="annee" name="annee">							
								<?php
								// On parcours le tableau des niveaux
								foreach($arrayAnnees as $annee) {
									?>
									<option value="<?php echo $annee; ?>" <?php if($annee == $arrayAnnees[1]) {echo 'selected';} ?>><?php echo $annee; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label class="label-large" for="reference">Référence</label>
							<input type="text" class="input-normal" id="reference" name="reference" />
						</div>
						
						<div class="form-item">
							<label class="label-large" for="dateDebut">Date de début de l'enseignement *</label>
							<input type="text" id="dateDebut" class="date" name="dateDebut" value="" maxlength="10" readonly="true"/>
						</div>
						
						<div class="form-item">
							<label class="label-large" for="heuresCours">Nombre d'heures de cours</label>
							<input type="text" class="input-little" id="heuresCours" class="input-little" name="heuresCours" value="" maxlength="5" /> heures
							<input type="text" class="input-little" id="minutesCours" class="input-little" name="minutesCours" value="" maxlength="5" /> minutes
						</div>
						
						<div class="form-item">
							<label class="label-large" for="groupesCours">Nombre de groupe de cours</label>
							<input type="text" class="input-little" id="groupesCours" name="groupesCours" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label class="label-large" for="heuresTD">Nombre d'heures de TD</label>
							<input type="text" class="input-little" id="heuresTD" class="input-little" name="heuresTD" value="" maxlength="5" /> heures
							<input type="text" class="input-little" id="minutesTD" class="input-little" name="minutesTD" value="" maxlength="5" /> minutes
						</div>
						
						<div class="form-item">
							<label class="label-large" for="groupesTD">Nombre de groupe de TD</label>
							<input type="text" class="input-little" id="groupesTD" name="groupesTD" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label class="label-large" for="heuresTP">Nombre d'heures de TP</label>
							<input type="text" class="input-little" id="heuresTP" class="input-little" name="heuresTP" value="" maxlength="5" /> heures
							<input type="text" class="input-little" id="minutesTP" class="input-little" name="minutesTP" value="" maxlength="5" /> minutes
						</div>
						
						<div class="form-item">
							<label class="label-large" for="groupesTP">Nombre de groupe de TP</label>
							<input type="text" class="input-little" id="groupesTP" name="groupesTP" value="" maxlength="5" />
						</div>					
						
						<div class="form-item">
							<label class="label-large" for="semestre">Semestre</label>
							<select id="semestre" name="semestre">
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</div>
						
						<div class="form-item">
							<label class="label-large" for="etudiantsMoyen">Nombre d'étudiants moyen</label>
							<input type="text" class="input-little" id="etudiantsMoyen" name="etudiantsMoyen" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<label class="label-large" for="moyenne">Moyenne</label>
							<input type="text" class="input-little decimal" id="moyenne" name="moyenne" value="" maxlength="5" />
						</div>
						
						<div class="form-item">
							<input type="submit" name="filiereEnseignement_form_add" class="input-submit input-submit-large input-submit-green" value="Enregistrer" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-full div-mode-admin">

			<div id="choix-annees">
				Année : 
				<select id="filtre-annees">							
					<?php
					// On parcours le tableau des niveaux
					foreach($arrayAnnees as $annee) {
						?>
						<option value="<?php echo WEBROOT; ?>filiereEnseignement/admin/0/0/<?php echo $annee; ?>" <?php if($annee == $selection) {echo 'selected';} ?>><?php echo $annee; ?></option>
						<?php
					}
					?>
					<option value="<?php echo WEBROOT; ?>filiereEnseignement/admin/0/0/tout" <?php if($selection == "tout") {echo 'selected';} ?>>Tout l'historique</option>
				</select>
			</div>
		
			<h2>Liste des filières enseignements</h2>			
			
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
							<th width="5%">#</th>
							<th width="18%">Filière</th>
							<th width="18%">Enseignement</th>
							<th width="9%">Année</th>
							<th width="9%">Réf</th>
							<th width="18%">Responsable</th>
							<th width="18%">Actions</th>
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
								<td><?php echo $filiereEnseignement['reference']; ?></td>
								<td>
									<?php
										if(is_array($filiereEnseignement['responsable'])) {
											foreach($filiereEnseignement['responsable'] as $responsable) {
												echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$responsable['id'].'">'.$responsable['libelle'].'</a><br/>';
											}
										} else {
											echo 'Pas de responsable';
										}
									?>
								</td>
								<td>
									<a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $filiereEnseignement['id']; ?>"><span class="buttons button-green">Visualiser</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/update/<?php echo $filiereEnseignement['id']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/admin/<?php echo $filiereEnseignement['id']; ?>"><span class="buttons button-red">Supprimer</span></a>
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