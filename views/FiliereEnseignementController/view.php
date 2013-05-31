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
			<h2><?php echo $filiereEnseignement['filiere']; ?> - <?php echo $filiereEnseignement['enseignement']; ?> - <?php echo $filiereEnseignement['annee']; ?></h2>	
		
			<table class="no-tri">
				<thead>
					<tr>
						<th width="9%">Type</th>
						<th align="center" width="9%">Volume h/gr.</th>
						<th align="center" width="9%">Nb de gr.</th>
						<th align="center" width="9%">Total h</th>
						<th width="25%">Enseignants</th>
						<th width="29%">Détails</th>
						<th width="10%">Conflits</th>
					</tr>
				</thead>
				<tbody>
				
					<!-- COURS -->
					<?php if($filiereEnseignement['h_cours_d'] > 0) { ?>
						<tr>
							<td><strong>Cours</strong></td>
							<td align="center"><?php echo $filiereEnseignement['h_cours_d']; ?> h</td>
							<td align="center"><?php echo $filiereEnseignement['nbr_groupes_cours']; ?></td>
							<td align="center"><?php echo $filiereEnseignement['h_cours_d'] * $filiereEnseignement['nbr_groupes_cours']; ?> h</td>
							<td>
								<?php
									$total_volume_cours = $filiereEnseignement['h_cours_d'] * $filiereEnseignement['nbr_groupes_cours'];
									$total_voeux_cours = 0;
									$j = 0;
									foreach ($filiereEnseignementEnseignant as $fee) { 
										if($fee['nbr_h_cours'] > 0) {
											// Total voeux
											$total_voeux_cours = $total_voeux_cours + ($fee['nbr_h_cours'] / 60);
										
											if($j)
												echo '<br />';
											
											if($fee['civilite'])
												$civ = 'M. ';
											else
												$civ = 'Mme ';
											
											echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$fee['id'].'" title="'.$civ.' '.$fee['prenom'].' '.$fee['nom'].'">'.$civ.' '.$fee['prenom'].' '.$fee['nom'].'</a> - '. round($fee['nbr_h_cours'] / 60, 2).' h';
											
											$j = $j + 1;
										}
									}
									
									$cours_percent = ($total_voeux_cours * 100) / $total_volume_cours;
									$width_progression = ($cours_percent * 250) / 100;
									if($width_progression > 250)
										$width_progression = 250;

								?>
							</td>
							<td class="feEtatPrevisionnelle">
								<div class="barreProgression">
									<span><?php echo round($cours_percent, 2); ?> %</span>
									<div class="progression <?php if($cours_percent == 100) echo 'barreProgressionGreen'; else if($cours_percent > 100) echo 'barreProgressionRed'; else if($cours_percent < 100) echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
								</div>
								<span class="feEtatPrevisionnelleHeures"><?php echo round($total_voeux_cours, 2).' / '.$total_volume_cours; ?> h</span>
							</td>
							<td>
								<!-- CONFLITS -->
								<?php
									if($total_volume_cours != $total_voeux_cours) {
										
										// Il manque des heures
										if($total_voeux_cours < $total_volume_cours) {
											$nbr_h_conflit = $total_volume_cours - $total_voeux_cours;
											echo '<span class="orange"><strong>- '.round($nbr_h_conflit, 2).' h</strong></span>';
										}
										
										// Il y a trop d'heures
										if($total_voeux_cours > $total_volume_cours) {
											$nbr_h_conflit = $total_voeux_cours - $total_volume_cours;
											echo '<span class="red"><strong>+ '.round($nbr_h_conflit, 2).' h</strong></span>';
										}
									}
								?>
							</td>
						</tr>
					<?php } ?>

					<!-- TD -->
					<?php if($filiereEnseignement['h_td_d'] > 0) { ?>
						<tr>
							<td><strong>TD</strong></td>
							<td align="center"><?php echo $filiereEnseignement['h_td_d']; ?> h</td>
							<td align="center"><?php echo $filiereEnseignement['nbr_groupes_td']; ?></td>
							<td align="center"><?php echo $filiereEnseignement['h_td_d'] * $filiereEnseignement['nbr_groupes_td']; ?> h</td>
							<td>
								<?php
									$total_volume_td = $filiereEnseignement['h_td_d'] * $filiereEnseignement['nbr_groupes_td'];
									$total_voeux_td = 0;
									$j = 0;
									foreach ($filiereEnseignementEnseignant as $fee) { 
										if($fee['nbr_h_td'] > 0) {
											// Total voeux
											$total_voeux_td = $total_voeux_td + ($fee['nbr_h_td'] / 60);
										
											if($j)
												echo '<br />';
											
											if($fee['civilite'])
												$civ = 'M. ';
											else
												$civ = 'Mme ';
											
											echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$fee['id'].'" title="'.$civ.' '.$fee['prenom'].' '.$fee['nom'].'">'.$civ.' '.$fee['prenom'].' '.$fee['nom'].'</a> - '. round($fee['nbr_h_td'] / 60, 2).' h';
											
											$j = $j + 1;
										}
									}
									
									$td_percent = ($total_voeux_td * 100) / $total_volume_td;
									$width_progression = ($td_percent * 250) / 100;
									if($width_progression > 250)
										$width_progression = 250;
								?>
							</td>
							<td class="feEtatPrevisionnelle">
								<div class="barreProgression">
									<span><?php echo round($td_percent, 2); ?> %</span>
									<div class="progression <?php if($td_percent == 100) echo 'barreProgressionGreen'; else if($td_percent > 100) echo 'barreProgressionRed'; else if($td_percent < 100) echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
								</div>
								<span class="feEtatPrevisionnelleHeures"><?php echo round($total_voeux_td, 2).' / '.$total_volume_td; ?> h</span>
							</td>
							<td>
								<!-- CONFLITS -->
								<?php
									if($total_volume_td != $total_voeux_td) {
										
										// Il manque des heures
										if($total_voeux_td < $total_volume_td) {
											$nbr_h_conflit = $total_volume_td - $total_voeux_td;
											echo '<span class="orange"><strong>- '.round($nbr_h_conflit, 2).' h</strong></span>';
										}
										
										// Il y a trop d'heures
										if($total_voeux_td > $total_volume_td) {
											$nbr_h_conflit = $total_voeux_td - $total_volume_td;
											echo '<span class="red"><strong>+ '.round($nbr_h_conflit, 2).' h</strong></span>';
										}
									}
								?>
							</td>
						</tr>
					<?php } ?>
					
					<!-- TP -->
					<?php if($filiereEnseignement['h_tp_d'] > 0) { ?>
						<tr>
							<td><strong>TP</strong></td>
							<td align="center"><?php echo $filiereEnseignement['h_tp_d']; ?> h</td>
							<td align="center"><?php echo $filiereEnseignement['nbr_groupes_tp']; ?></td>
							<td align="center"><?php echo $filiereEnseignement['h_tp_d'] * $filiereEnseignement['nbr_groupes_tp']; ?> h</td>
							<td>
								<?php
									$total_volume_tp = $filiereEnseignement['h_tp_d'] * $filiereEnseignement['nbr_groupes_tp'];
									$total_voeux_tp = 0;
									$j = 0;
									foreach ($filiereEnseignementEnseignant as $fee) { 
										if($fee['nbr_h_tp'] > 0) {
											// Total voeux
											$total_voeux_tp = $total_voeux_tp + ($fee['nbr_h_tp'] / 60);
										
											if($j)
												echo '<br />';
											
											if($fee['civilite'])
												$civ = 'M. ';
											else
												$civ = 'Mme ';
											
											echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$fee['id'].'" title="'.$civ.' '.$fee['prenom'].' '.$fee['nom'].'">'.$civ.' '.$fee['prenom'].' '.$fee['nom'].'</a> - '. round($fee['nbr_h_tp'] / 60, 2).' h';
											
											$j = $j + 1;
										}
									}
									
									$tp_percent = ($total_voeux_tp * 100) / $total_volume_tp;
									$width_progression = ($tp_percent * 250) / 100;
									if($width_progression > 250)
										$width_progression = 250;
								?>
							</td>
							<td class="feEtatPrevisionnelle">
								<div class="barreProgression">
									<span><?php echo round($tp_percent, 2); ?> %</span>
									<div class="progression <?php if($tp_percent == 100) echo 'barreProgressionGreen'; else if($tp_percent > 100) echo 'barreProgressionRed'; else if($tp_percent < 100) echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
								</div>
								<span class="feEtatPrevisionnelleHeures"><?php echo round($total_voeux_tp, 2).' / '.$total_volume_tp; ?> h</span>
							</td>
							<td>
								<!-- CONFLITS -->
								<?php
									if($total_volume_tp != $total_voeux_tp) {
										
										// Il manque des heures
										if($total_voeux_tp < $total_volume_tp) {
											$nbr_h_conflit = $total_volume_tp - $total_voeux_tp;
											echo '<span class="orange"><strong>- '.round($nbr_h_conflit, 2).' h</strong></span>';
										}
										
										// Il y a trop d'heures
										if($total_voeux_tp > $total_volume_tp) {
											$nbr_h_conflit = $total_voeux_tp - $total_volume_tp;
											echo '<span class="red"><strong>+ '.round($nbr_h_conflit, 2).' h</strong></span>';
										}
									}
								?>
							</td>
						</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
		
		<div class="text text-two">
			
			<div class="text-two-item text-two-item-first">
			
				<form id="form-update-filiereEnseignement" action="#" method="post">
					<fieldset>
						<legend><span class="icon-filieres-enseignement"></span>
							Informations complémentaires
						</legend>
						<div class="form-item">
							<label class="label-large blue" for="filiere">Filière</label>
							<?php echo $filiereEnseignement['filiere']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="enseignement">Enseignement</label>
							<?php echo $filiereEnseignement['enseignement']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="annee">Année</label>
							<?php echo $filiereEnseignement['annee']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="reference">Référence</label>
							<?php echo $filiereEnseignement['reference']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="dateDebut">Date de début de l'enseignement</label>
							<?php echo $filiereEnseignement['date_debut_enseignement']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="semestre">Semestre</label>
							<?php echo $filiereEnseignement['semestre']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="etudiantsMoyen">Nombre d'étudiants moyen</label>
							<?php echo $filiereEnseignement['nbr_etudiants_moyen']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="moyenne">Moyenne</label>
							<?php echo $filiereEnseignement['moyenne']; ?>
						</div>
					</fieldset>
				</form>
			</div>
			
			<div class="text-two-item">
				<?php
					// Voeu utilisateur, ajout ou modification
					$add_voeu_utilisateur = 1;
					foreach ($filiereEnseignementEnseignant as $fee) {
						if($fee['id'] == $_SESSION['v_id_utilisateur']) {
							$voeur_utilisateur_h_cours = floor($fee['nbr_h_cours'] / 60);
							$voeur_utilisateur_h_td = floor($fee['nbr_h_td'] / 60);
							$voeur_utilisateur_h_tp = floor($fee['nbr_h_tp'] / 60);
							$voeur_utilisateur_minutes_cours = $fee['nbr_h_cours'] % 60;
							$voeur_utilisateur_minutes_td = $fee['nbr_h_td'] % 60;
							$voeur_utilisateur_minutes_tp = $fee['nbr_h_tp'] % 60;
							$add_voeu_utilisateur = 0;
						}	
					}
				?>
				<form id="form-update-filiereEnseignement" action="#" method="post">
					<fieldset>
						<legend><span class="icon-heart"></span>
							<?php
								if($add_voeu_utilisateur)
									echo 'Ajouter un voeu';
								else
									echo 'Modifier mon voeu';
							?>
						</legend>
						
						<?php if($filiereEnseignement['h_cours_d'] > 0) { ?>
							<div class="form-item">
								<label style="width: 250px;" for="heuresCours">Nombre d'heures de cours</label>
								<input type="text" class="input-little" id="heuresCours" class="input-little" name="heuresCours" value="<?php echo $voeur_utilisateur_h_cours; ?>" maxlength="5" /> heures
								<input type="text" class="input-little" id="minutesCours" class="input-little" name="minutesCours" value="<?php echo $voeur_utilisateur_minutes_cours; ?>" maxlength="5" /> minutes
							</div>
						<?php } ?>
						
						<?php if($filiereEnseignement['h_td_d'] > 0) { ?>
							<div class="form-item">
								<label style="width: 250px;" for="heuresTD">Nombre d'heures de TD</label>
								<input type="text" class="input-little" id="heuresTD" class="input-little" name="heuresTD" value="<?php echo $voeur_utilisateur_h_td; ?>" maxlength="5" /> heures
								<input type="text" class="input-little" id="minutesTD" class="input-little" name="minutesTD" value="<?php echo $voeur_utilisateur_minutes_td; ?>" maxlength="5" /> minutes
							</div>
						<?php } ?>

						<?php if($filiereEnseignement['h_tp_d'] > 0) { ?>
							<div class="form-item">
								<label style="width: 250px;" for="heuresTP">Nombre d'heures de TP</label>
								<input type="text" class="input-little" id="heuresTP" class="input-little" name="heuresTP" value="<?php echo $voeur_utilisateur_h_tp; ?>" maxlength="5" /> heures
								<input type="text" class="input-little" id="minutesTP" class="input-little" name="minutesTP" value="<?php echo $voeur_utilisateur_minutes_tp; ?>" maxlength="5" /> minutes
							</div>
						<?php } ?>
						
						<div class="form-item">
							<?php if($add_voeu_utilisateur) { ?>
								<input style="margin-left: 270px;" type="submit" name="filiereEnseignement_form_add_voeu" class="input-submit input-submit-green" value="Ajouter" />
							<?php } else { ?>
								<input style="margin-left: 270px;" type="submit" name="filiereEnseignement_form_add_voeu" class="input-submit input-submit-orange" value="Modifier" />
							<?php } ?>
						</div>
					</fieldset>
				</form>
				<br />
				
				<h2>Liste des badges</h2>
				<?php
					if(count($filiereEnseignementEnseignant) == 0) {
				?>
						<p>Aucun voeu n'a encore été créé ...</p>
				<?php
					} else {
				?>
						<table class="table-white no-tri">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Badge</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($filiereEnseignementEnseignant as $fee) { ?>
									<tr>
										<td><a href="<?php echo WEBROOT; ?>annuaire/visualiser/<?php echo $fee['id']; ?>" title="<?php if($fee['civilite']) echo 'M. '; else echo 'Mme '; echo $fee['prenom'].' '.$fee['nom']; ?>"><?php if($fee['civilite']) echo 'M. '; else echo 'Mme '; echo $fee['prenom'].' '.$fee['nom']; ?></a></td>
										<td><?php echo $fee['badge'];?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
				<?php
					}
				?>
			</div>

		</div>
	</div>
</div>