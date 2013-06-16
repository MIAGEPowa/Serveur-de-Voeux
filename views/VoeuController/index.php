<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Mes v&oelig;ux</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'voeu/index'; ?>" title="">Mes v&oelig;ux</a>
		</div>
		
		<div class="text text-full">
			<form id="form-create-voeu" action="<?php echo WEBROOT.'voeu/index'; ?>" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-heart"></span>Ajouter un voeu<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label style="width: 250px;" for="filiereEnseignement">Filières - Enseignements</label>
							<select name="filiereEnseignement" id="filiereEnseignement">
								<?php foreach($arrayFilieresEnseignements as $fe) { ?>
									<option value="<?php echo $fe['id']; ?>"><?php echo $fe['libelle']; ?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-item">
							<label style="width: 250px;" for="heuresCours">Nombre d'heures de cours</label>
							<input type="text" class="input-little" id="heuresCours" class="input-little" name="heuresCours" value="<?php echo $voeur_utilisateur_h_cours; ?>" maxlength="5" /> heures
							<input type="text" class="input-little" id="minutesCours" class="input-little" name="minutesCours" value="<?php echo $voeur_utilisateur_minutes_cours; ?>" maxlength="5" /> minutes
						</div>
					
						<div class="form-item">
							<label style="width: 250px;" for="heuresTD">Nombre d'heures de TD</label>
							<input type="text" class="input-little" id="heuresTD" class="input-little" name="heuresTD" value="<?php echo $voeur_utilisateur_h_td; ?>" maxlength="5" /> heures
							<input type="text" class="input-little" id="minutesTD" class="input-little" name="minutesTD" value="<?php echo $voeur_utilisateur_minutes_td; ?>" maxlength="5" /> minutes
						</div>

						<div class="form-item">
							<label style="width: 250px;" for="heuresTP">Nombre d'heures de TP</label>
							<input type="text" class="input-little" id="heuresTP" class="input-little" name="heuresTP" value="<?php echo $voeur_utilisateur_h_tp; ?>" maxlength="5" /> heures
							<input type="text" class="input-little" id="minutesTP" class="input-little" name="minutesTP" value="<?php echo $voeur_utilisateur_minutes_tp; ?>" maxlength="5" /> minutes
						</div>
						
						<div class="form-item">
								<input type="submit" name="filiereEnseignement_form_add_voeu" class="input-submit input-submit-green" value="Ajouter" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-full">
			<h2>Liste de mes v&oelig;ux</h2>
			
			<table>
				 <thead>
					<tr>
						<th width="21%">Filière</th>
						<th width="15%">Enseignement</th>
						<th width="8%" align="center">Année</th>
						<th width="8%" align="center">Cours</th>
						<th width="8%" align="center">TD</th>
						<th width="8%" align="center">TP</th>
						<th width="26%" style="min-width:246px">Conflits</th>
						<th width="6%" style="min-width:100px">Actions</th> <!-- Visualiser et Supprimer -->
					</tr>
				</thead>
				<tbody>
				
					<?php 
						foreach($fee as $f) {
							$voeur_utilisateur_h_cours = round($f['nbr_h_cours'] / 60, 2);
							$voeur_utilisateur_h_td = round($f['nbr_h_td'] / 60, 2);
							$voeur_utilisateur_h_tp = round($f['nbr_h_tp'] / 60, 2);
					?>
						
						<tr>
							<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $f['id_filiere_enseignement']; ?>"><?php echo $f['filiere']; ?></a></td>
							<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $f['id_filiere_enseignement']; ?>"><?php echo $f['libelle']; ?></a></td>
							<td align="center"><?php echo $f['annee']; ?></td>
							<td align="center"><?php echo $voeur_utilisateur_h_cours; ?> h</td>
							<td align="center"><?php echo $voeur_utilisateur_h_td; ?> h</td>
							<td align="center"><?php echo $voeur_utilisateur_h_tp; ?> h</td>
							<td class="feEtatPrevisionnelle">
								<?php
								
								$c_cours = 0;
								$c_td = 0;
								$c_tp = 0;
								$j = 0;
								
								// COURS
								$volume_h_cours = ($f['t_cours'] * $f['nbr_groupes_cours']);
								foreach($f['conflits'] as $key_c => $c) {
									
									$cours_percent = 0;
									
									if($volume_h_cours > 0 && isset($c['cours']) && isset($c['cours_conflit'])) {
										if(!$c['cours_conflit']) {
											$cours_percent = (($volume_h_cours - $c['cours']) * 100) / $volume_h_cours;
											if($cours_percent < 0)
												$cours_percent = 0;
											$width_progression = ($cours_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$cours_percent = (($c['cours'] + $volume_h_cours) * 100) / $volume_h_cours;
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
									
									if($volume_h_cours > 0 && !$c_cours && !$j) {
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
								$volume_h_td = ($f['t_td'] * $f['nbr_groupes_td']);
								foreach($f['conflits'] as $key_c => $c) {
									
									$td_percent = 0;
									
									if($volume_h_td > 0 && isset($c['td']) && isset($c['td_conflit'])) {
										if(!$c['td_conflit']) {
											$td_percent = (($volume_h_td - $c['td']) * 100) / $volume_h_td;
											if($td_percent < 0)
												$td_percent = 0;
											$width_progression = ($td_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$td_percent = (($c['td'] + $volume_h_td) * 100) / $volume_h_td;
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
									
									if($volume_h_td > 0 && !$c_td && !$j) {
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
								$volume_h_tp = ($f['t_tp'] * $f['nbr_groupes_tp']);
								foreach($f['conflits'] as $key_c => $c) {
									
									$tp_percent = 0;

									if($volume_h_tp > 0 && isset($c['tp']) && isset($c['tp_conflit'])) {
										if(!$c['tp_conflit']) {
											$tp_percent = (($volume_h_tp - $c['tp']) * 100) / $volume_h_tp;
											if($tp_percent < 0)
												$tp_percent = 0;
											$width_progression = ($tp_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$tp_percent = (($c['tp'] + $volume_h_tp) * 100) / $volume_h_tp;
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
												if(!$c['cours_conflit']) {
													echo '<span class="orange"><strong>- '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</strong></span>';
												} else {
													echo '<span class="red"><strong>+ '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</strong></span>';
												}
											?>
										</span>
									<?php
										$c_tp = 1;
									}
									
									if($volume_h_tp > 0 && !$c_tp && !$j) {
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
							<td>
								<a class="buttons-link" href="<?php echo WEBROOT; ?>voeu/index/<?php echo $f['id_filiere_enseignement']; ?>"><span class="buttons button-red">Supprimer</span></a>
							</td>
						</tr>
						
					<?php } ?>
				
				</tbody>
			</table>
		</div>

	</div>
</div>