<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières - Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiereEnseignement/index'; ?>" title="">Filières - Enseignements</a>
		</div>
		
		<div class="text text-full">
			<span id="mode-admin" class="buttons button-orange" style="float: right;">Mode administrateur</span>
			<span id="mode-enseignant" class="buttons button-green" style="float: right; display: none;">Mode enseignant</span>
			<span id="mode-aff-1" class="buttons button-blue mode-aff" style="float: right;"><img src="<?php echo IMG_DIR; ?>mode_aff_1.png" title="Mode affichage" alt="Icône mode d'affichage" style="display: block;width: 17px;" /></span>
			<span id="mode-aff-2" class="buttons button-blue mode-aff" style="float: right; display: none;"><img src="<?php echo IMG_DIR; ?>mode_aff_2.png" title="Mode affichage" alt="Icône mode d'affichage" style="display: block;width: 17px;margin: 3px 0;" /></span>
			<div class="clear"></div>
		</div>
		
		<div class="text text-full div-mode-admin" style="display: none;">
			<form id="form-create-filiereEnseignement" action="#" method="post">
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
		
		<div class="text text-full div-mode-admin" style="display: none;">

			<div id="choix-annees">
				Année : 
				<select id="filtre-annees">							
					<?php
					// On parcours le tableau des niveaux
					foreach($arrayAnnees as $annee) {
						?>
						<option value="<?php echo WEBROOT; ?>filiereEnseignement/index/0/0/<?php echo $annee; ?>" <?php if($annee == $selection) {echo 'selected';} ?>><?php echo $annee; ?></option>
						<?php
					}
					?>
					<option value="<?php echo WEBROOT; ?>filiereEnseignement/index/0/0/tout" <?php if($selection == "tout") {echo 'selected';} ?>>Tout l'historique</option>
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
												echo $responsable.'<br/>';
											}
										} else {
											echo 'Pas de responsable';
										}
									?>
								</td>
								<td>
									<a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $filiereEnseignement['id']; ?>"><span class="buttons button-green">Visualiser</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/update/<?php echo $filiereEnseignement['id']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/index/<?php echo $filiereEnseignement['id']; ?>"><span class="buttons button-red">Supprimer</span></a>
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
		
		
		<!-- MODE AFFICHAGE ENSEINGNANT 1 -->
		<div id="mode-enseignant-1" class="div-mode-enseignant" style="display: none;">
		<?php
			$i = 1;	
			foreach($arrayFilieres as $f) {
				if($i % 2) {
					echo '<div class="text text-two">
							<div class="text-two-item text-two-item-first">';
				} else {
					echo '<div class="text-two-item">';
				}
				?>
					
				<h2><?php echo $f['niveau'].' '.$f['specialite'].' '.$f['apprentissage_lib']?></h2>	
				<table>
					<thead>
						<tr>
							<th width="47%">Enseignement</th>
							<th width="10%">Annee</th>
							<th width="10%">Réf</th>
							<th width="33%">Conflits</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($arrayFiliereEnseignement as $filiereEnseignement) {
								if($filiereEnseignement['id_filiere'] == $f['id']) {
								//DEBUG
								//echo '<pre>' . print_r($filiereEnseignement, true) . '</pre>';
								
								$c_cours = 0;
								$c_td = 0;
								$c_tp = 0;
								$j = 0;
								?>
								
								<tr>
									<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $filiereEnseignement['id']; ?>"><?php echo $filiereEnseignement['enseignement']; ?></a></td>
									<td><?php echo $filiereEnseignement['annee']; ?></td>
									<td><?php echo $filiereEnseignement['reference']; ?></td>
									<td>
										<?php
										
											// COURS
											foreach($filiereEnseignement['conflits'] as $key_c => $c) {
												//DEBUG
												//echo '<pre>' . print_r($c, true) . '</pre>';
												
												if($filiereEnseignement['nbr_h_cours'] > 0 && isset($c['cours']) && isset($c['cours_conflit'])) {
												?>
													<div style="display: block;overflow: hidden;margin: 2px 0;">
														<span style="width: 75%; display: inline-block; margin-top: 2px;">Cours
														
														<?php
															if(!$c['cours_conflit']) {
																echo '<strong><span class="orange" style="float: right;">- '.str_replace('.', ',', round($c['cours'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															} else {
																echo '<strong><span class="red" style="float: right;">+ '.str_replace('.', ',', round($c['cours'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															}
														?>
														
													</div>
												<?php
													$c_cours = 1;
												}
											}
											
											if($filiereEnseignement['nbr_h_cours'] > 0 && !$c_cours && !$j) {
											?>
												<div style="display: block;overflow: hidden;margin: 2px 0;">
													<span style="width: 75%; display: inline-block; margin-top: 2px;">Cours</span>
													
													<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
														</div>
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
														</div>
													</div>
												</div>
											<?php
												$j = 1;
											}
											
											
											
											// TD
											foreach($filiereEnseignement['conflits'] as $key_c => $c) {
												//DEBUG
												//echo '<pre>' . print_r($c, true) . '</pre>';
												
												if($filiereEnseignement['nbr_h_td'] > 0 && isset($c['td']) && isset($c['td_conflit'])) {
												?>
													<div style="display: block;overflow: hidden;margin: 2px 0;">
														<span style="width: 75%; display: inline-block; margin-top: 2px;">TD
														
														<?php
															if(!$c['td_conflit']) {
																echo '<strong><span class="orange" style="float: right;">- '.str_replace('.', ',', round($c['td'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															} else {
																echo '<strong><span class="red" style="float: right;">+ '.str_replace('.', ',', round($c['td'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															}
														?>
						
													</div>
												<?php
													$c_td = 1;
												}
											}
											
											if($filiereEnseignement['nbr_h_td'] > 0 && !$c_td && !$j) {
											?>
												<div style="display: block;overflow: hidden;margin: 2px 0;">
													<span style="width: 75%; display: inline-block; margin-top: 2px;">TD</span>
													
													<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
														</div>
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
														</div>
													</div>
												</div>
											<?php
												$j = 1;
											}
											
											// TP
											foreach($filiereEnseignement['conflits'] as $key_c => $c) {
												//DEBUG
												//echo '<pre>' . print_r($c, true) . '</pre>';
												
												if($filiereEnseignement['nbr_h_tp'] > 0 && isset($c['tp']) && isset($c['tp_conflit'])) {
												?>
													<div style="display: block;overflow: hidden;margin: 2px 0;">
														<span style="width: 75%; display: inline-block; margin-top: 2px;">TP
														
														<?php
															if(!$c['tp_conflit']) {
																echo '<strong><span class="orange" style="float: right;">- '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															} else {
																echo '<strong><span class="red" style="float: right;">+ '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															}
														?>
														
													</div>
												<?php
													$c_tp = 1;
												}
											}
											
											if($filiereEnseignement['nbr_h_tp'] > 0 && !$c_tp && !$j) {
											?>
												<div style="display: block;overflow: hidden;margin: 2px 0;">
													<span style="width: 75%; display: inline-block; margin-top: 2px;">TP</span>
													
													<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
														</div>
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 10px); transform: rotate(180deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 10px, 20px, 0px); transform: rotate(180deg);"></div>
														</div>
													</div>
												</div>
											<?php
												$j = 1;
											}
											
										?>
									</td>
								</tr>
								
								<?php								
								}
							}
						?>
					</tbody>
				</table>
				
				<?php
				if($i % 2) {
					echo '</div>';
				} else {
					echo '</div></div>';
				}
				
				$i = $i + 1;
			}
			echo '</div>';
		?>
		</div>
		
		<!-- MODE AFFICHAGE ENSEINGNANT 2 -->
		<div id="mode-enseignant-2" class="text text-full div-mode-enseignant">
			<h2>Liste des filières enseignements</h2>
			<table>
				 <thead>
					<tr>
						<th width="18%">Filière</th>
						<th width="18%">Enseignement</th>
						<th width="9%">Année</th>
						<th width="9%">Réf</th>
						<th width="18%">Responsable</th>
						<th width="18%">Conflits</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// On parcours le tableau des enseignements
					foreach($arrayFiliereEnseignement as $filiereEnseignement) {
					?>
						<tr>
							<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $filiereEnseignement['id']; ?>"><?php echo $filiereEnseignement['filiere']; ?></a></td>
							<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $filiereEnseignement['id']; ?>"><?php echo $filiereEnseignement['enseignement']; ?></a></td>
							<td><?php echo $filiereEnseignement['annee']; ?></td>
							<td><?php echo $filiereEnseignement['reference']; ?></td>
							<td>
								<?php
									if(is_array($filiereEnseignement['responsable'])) {
										foreach($filiereEnseignement['responsable'] as $responsable) {
											echo $responsable.'<br/>';
										}
									} else {
										echo 'Pas de responsable';
									}
								?>
							</td>
							<td class="feEtatPrevisionnelle">
							
								<?php
								
								$c_cours = 0;
								$c_td = 0;
								$c_tp = 0;
								$j = 0;
								
								// COURS
								foreach($filiereEnseignement['conflits'] as $key_c => $c) {
									//DEBUG
									//echo '<pre>' . print_r($c, true) . '</pre>';
									$cours_percent = 0;
									
									if($filiereEnseignement['nbr_h_cours'] > 0 && isset($c['cours']) && isset($c['cours_conflit'])) {
										if(!$c['cours_conflit']) {
											$cours_percent = (($filiereEnseignement['nbr_h_cours'] - $c['cours']) * 100) / $filiereEnseignement['nbr_h_cours'];
											if($cours_percent < 0)
												$cours_percent = 0;
											$width_progression = ($cours_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$cours_percent = (($c['cours'] + $filiereEnseignement['nbr_h_cours']) * 100) / $filiereEnseignement['nbr_h_cours'];
											if($cours_percent < 0)
												$cours_percent = 0;
											$width_progression = ($cours_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										}
										
									?>
										<span style="width: 20%; float: left;">Cours</span>
										<div class="barreProgressionMin">
											<span><?php echo round($cours_percent, 2); ?> %</span>
											<div class="progressionMin <?php if($cours_percent > 100) echo 'barreProgressionRed'; else echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin">
											<?php
												if(!$c['cours_conflit']) {
													echo '<span class="orange"><strong>- '.str_replace('.', ',', round($c['cours'] / 60, 2)).'</strong></span>';
												} else {
													echo '<span class="red"><strong>+ '.str_replace('.', ',', round($c['cours'] / 60, 2)).'</strong></span>';
												}
											?>
										</span>
									<?php
										$c_cours = 1;
									}
									
									if($filiereEnseignement['nbr_h_cours'] > 0 && !$c_cours && !$j) {
									?>
										<span style="width: 20%; float: left;">Cours</span>
										<div class="barreProgressionMin">
											<span>100 %</span>
											<div class="progressionMin barreProgressionGreen" style="width: 125px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin"></span>
									<?php
										$j = 1;
									}
		
								}
								
								
								// TD
								foreach($filiereEnseignement['conflits'] as $key_c => $c) {
									//DEBUG
									//echo '<pre>' . print_r($c, true) . '</pre>';
									$td_percent = 0;
									
									if($filiereEnseignement['nbr_h_td'] > 0 && isset($c['td']) && isset($c['td_conflit'])) {
										if(!$c['td_conflit']) {
											$td_percent = (($filiereEnseignement['nbr_h_td'] - $c['td']) * 100) / $filiereEnseignement['nbr_h_td'];
											if($td_percent < 0)
												$td_percent = 0;
											$width_progression = ($td_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$td_percent = (($c['td'] + $filiereEnseignement['nbr_h_td']) * 100) / $filiereEnseignement['nbr_h_td'];
											if($td_percent < 0)
												$td_percent = 0;
											$width_progression = ($td_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										}
										
									?>
										<span style="width: 20%; float: left;">TD</span>
										<div class="barreProgressionMin">
											<span><?php echo round($td_percent, 2); ?> %</span>
											<div class="progressionMin <?php if($td_percent > 100) echo 'barreProgressionRed'; else echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin">
											<?php
												if(!$c['td_conflit']) {
													echo '<span class="orange"><strong>- '.str_replace('.', ',', round($c['td'] / 60, 2)).'</strong></span>';
												} else {
													echo '<span class="red"><strong>+ '.str_replace('.', ',', round($c['td'] / 60, 2)).'</strong></span>';
												}
											?>
										</span>
									<?php
										$c_td = 1;
									}
									
									if($filiereEnseignement['nbr_h_td'] > 0 && !$c_td && !$j) {
									?>
										<span style="width: 20%; float: left;">TD</span>
										<div class="barreProgressionMin">
											<span>100 %</span>
											<div class="progressionMin barreProgressionGreen" style="width: 125px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin"></span>
									<?php
										$j = 1;
									}
		
								}
								
								
								// TP
								foreach($filiereEnseignement['conflits'] as $key_c => $c) {
									//DEBUG
									//echo '<pre>' . print_r($c, true) . '</pre>';
									$tp_percent = 0;
									
									if($filiereEnseignement['nbr_h_tp'] > 0 && isset($c['tp']) && isset($c['tp_conflit'])) {
										if(!$c['tp_conflit']) {
											$tp_percent = (($filiereEnseignement['nbr_h_tp'] - $c['tp']) * 100) / $filiereEnseignement['nbr_h_tp'];
											if($tp_percent < 0)
												$tp_percent = 0;
											$width_progression = ($tp_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$tp_percent = (($c['tp'] + $filiereEnseignement['nbr_h_tp']) * 100) / $filiereEnseignement['nbr_h_tp'];
											if($tp_percent < 0)
												$tp_percent = 0;
											$width_progression = ($tp_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										}
										
									?>
										<span style="width: 20%; float: left;">TP</span>
										<div class="barreProgressionMin">
											<span><?php echo round($tp_percent, 2); ?> %</span>
											<div class="progressionMin <?php if($tp_percent > 100) echo 'barreProgressionRed'; else echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin">
											<?php
												if(!$c['td_conflit']) {
													echo '<span class="orange"><strong>- '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</strong></span>';
												} else {
													echo '<span class="red"><strong>+ '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</strong></span>';
												}
											?>
										</span>
									<?php
										$c_tp = 1;
									}
									
									if($filiereEnseignement['nbr_h_tp'] > 0 && !$c_tp && !$j) {
									?>
										<span style="width: 20%; float: left;">TP</span>
										<div class="barreProgressionMin">
											<span>100 %</span>
											<div class="progressionMin barreProgressionGreen" style="width: 125px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin"></span>
									<?php
										$j = 1;
									}
		
								}
								?>								
							</td>
						</tr>
					<?php 
					} 
					?>
				</tbody>
			</table>
		</div>
		
	</div>
</div>