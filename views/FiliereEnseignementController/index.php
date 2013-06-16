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
			<?php if($_SESSION['v_droits'] >= 3) { ?>
				<a href="<?php echo WEBROOT; ?>filiereEnseignement/admin" title="Mode administrateur"><span class="buttons button-orange" style="float: right;">Mode administrateur</span></a>
			<?php } ?>
			<span id="mode-enseignant" class="buttons button-green" style="float: right; display: none;">Mode enseignant</span>
			<span id="mode-aff-1" class="buttons button-blue mode-aff" style="float: right;"><img src="<?php echo IMG_DIR; ?>mode_aff_1.png" title="Mode affichage" alt="Icône mode d'affichage" style="display: block;width: 17px;" /></span>
			<span id="mode-aff-2" class="buttons button-blue mode-aff" style="float: right; display: none;"><img src="<?php echo IMG_DIR; ?>mode_aff_2.png" title="Mode affichage" alt="Icône mode d'affichage" style="display: block;width: 17px;margin: 3px 0;" /></span>
			<div class="clear"></div>
		</div>		
		
		<!-- MODE AFFICHAGE ENSEINGNANT 1 (pastilles) -->
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
				<?php
				
				$elementExist = false;
				
				foreach($arrayFiliereEnseignement as $filiereEnseignement) {
					if($filiereEnseignement['id_filiere'] == $f['id']) {
						$elementExist = true;
						break;
					}
				}
				
				if(!$elementExist) {
					echo "<p>Pas d'enseignement pour cette filière...</p>";
				}
				else {
				?>
				<table class="no-tri">
					<thead>
						<tr>
							<th width="50%">Enseignement</th>
							<th width="10%">Annee</th>
							<th width="10%">Réf</th>
							<th width="30%">Conflits</th>
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
														<span style="width: 65%; display: inline-block; margin-top: 2px;">Cours
														
														<?php
															if(!$c['cours_conflit']) {
																echo '<strong><span class="orange" style="float: right;">- '.str_replace('.', ',', round($c['cours'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															} else {
																echo '<strong><span class="red" style="float: right;">+ '.str_replace('.', ',', round($c['cours'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
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
													<span style="width: 65%; display: inline-block; margin-top: 2px;">Cours</span>
													
													<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
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
														<span style="width: 65%; display: inline-block; margin-top: 2px;">TD
														
														<?php
															if(!$c['td_conflit']) {
																echo '<strong><span class="orange" style="float: right;">- '.str_replace('.', ',', round($c['td'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															} else {
																echo '<strong><span class="red" style="float: right;">+ '.str_replace('.', ',', round($c['td'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
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
													<span style="width: 65%; display: inline-block; margin-top: 2px;">TD</span>
													
													<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
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
														<span style="width: 65%; display: inline-block; margin-top: 2px;">TP
														
														<?php
															if(!$c['tp_conflit']) {
																echo '<strong><span class="orange" style="float: right;">- '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #F89406; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
																	</div>
																</div>
															<?php
															} else {
																echo '<strong><span class="red" style="float: right;">+ '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</span></strong></span>';
															?>
																<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
																	<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
																		<div style="background-color: #de3b36; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
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
													<span style="width: 65%; display: inline-block; margin-top: 2px;">TP</span>
													
													<div style="width: 20px; height: 20px; position: relative; border-radius: 20px 20px 20px 20px; border: 2px #c1c1c1 solid; float: right;">
														<div style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, -40px); transform: rotate(0deg);">
															<div style="background-color: #51A351; position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; border-radius: 20px 20px 20px 20px; clip: rect(0px, 20px, 20px, 0px); transform: rotate(180deg);"></div>
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
				} 
				?>
				
				<?php
				if($i % 2) {
					echo '</div>';
				} else {
					echo '</div></div>';
				}
				
				$i = $i + 1;
			}
		?>
		</div>
		
		<!-- MODE AFFICHAGE ENSEINGNANT 2 -->
		<div id="mode-enseignant-2" class="text text-full div-mode-enseignant">
			<h2>Liste des filières enseignements</h2>
			<table>
				 <thead>
					<tr>
						<th width="18%">Filière</th>
						<th width="14%">Enseignement</th>
						<th width="9%">Année</th>
						<th width="9%">Réf</th>
						<th width="18%">Responsable</th>
						<th width="22%" style="min-width:246px">Conflits</th>
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
											echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$responsable['id'].'">'.$responsable['libelle'].'</a><br/>';
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
								
								// COURS
								foreach($filiereEnseignement['conflits'] as $key_c => $c) {
									//DEBUG
									//echo '<pre>' . print_r($c, true) . '</pre>';
									$cours_percent = 0;
									
									if($filiereEnseignement['nbr_h_cours'] > 0 && isset($c['cours']) && isset($c['cours_conflit'])) {
										$volume_cours = $filiereEnseignement['nbr_h_cours'] * $filiereEnseignement['nbr_groupes_cours'];
										
										if(!$c['cours_conflit']) {
											$cours_percent = (($volume_cours - $c['cours']) * 100) / $volume_cours;
											if($cours_percent < 0)
												$cours_percent = 0;
											$width_progression = ($cours_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$cours_percent = (($c['cours'] + $volume_cours) * 100) / $volume_cours;
											if($cours_percent < 0)
												$cours_percent = 0;
											$width_progression = ($cours_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										}
										
									?>
										<span style="width: 25%; float: left;">Cours</span>
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
								}
								
								if($filiereEnseignement['nbr_h_cours'] > 0 && !$c_cours) {
								?>
									<span style="width: 25%; float: left;">Cours</span>
									<div class="barreProgressionMin">
										<span>100 %</span>
										<div class="progressionMin barreProgressionGreen" style="width: 125px;"></div>
									</div>
									<span class="feEtatPrevisionnelleHeuresMin"></span>
								<?php
								}
								
								
								// TD
								foreach($filiereEnseignement['conflits'] as $key_c => $c) {
									//DEBUG
									//echo '<pre>' . print_r($c, true) . '</pre>';
									$td_percent = 0;
									
									if($filiereEnseignement['nbr_h_td'] > 0 && isset($c['td']) && isset($c['td_conflit'])) {
										$volume_td = $filiereEnseignement['nbr_h_td'] * $filiereEnseignement['nbr_groupes_td'];
										
										if(!$c['td_conflit']) {
											$td_percent = (($volume_td - $c['td']) * 100) / $volume_td;
											if($td_percent < 0)
												$td_percent = 0;
											$width_progression = ($td_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$td_percent = (($c['td'] + $volume_td) * 100) / $volume_td;
											if($td_percent < 0)
												$td_percent = 0;
											$width_progression = ($td_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										}
										
									?>
										<span style="width: 25%; float: left;">TD</span>
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
								}
								
								if($filiereEnseignement['nbr_h_td'] > 0 && !$c_td) {
								?>
									<span style="width: 25%; float: left;">TD</span>
									<div class="barreProgressionMin">
										<span>100 %</span>
										<div class="progressionMin barreProgressionGreen" style="width: 125px;"></div>
									</div>
									<span class="feEtatPrevisionnelleHeuresMin"></span>
								<?php
								}
								
								
								// TP
								foreach($filiereEnseignement['conflits'] as $key_c => $c) {
									//DEBUG
									//echo '<pre>' . print_r($c, true) . '</pre>';
									$tp_percent = 0;
									
									if($filiereEnseignement['nbr_h_tp'] > 0 && isset($c['tp']) && isset($c['tp_conflit'])) {
										$volume_tp = $filiereEnseignement['nbr_h_tp'] * $filiereEnseignement['nbr_groupes_tp'];
										
										if(!$c['tp_conflit']) {
											$tp_percent = (($volume_tp - $c['tp']) * 100) / $volume_tp;
											if($tp_percent < 0)
												$tp_percent = 0;
											$width_progression = ($tp_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										} else {
											$tp_percent = (($c['tp'] + $volume_tp) * 100) / $volume_tp;
											if($tp_percent < 0)
												$tp_percent = 0;
											$width_progression = ($tp_percent * 125) / 100;
											if($width_progression > 125)
												$width_progression = 125;
										}
									?>
										<span style="width: 25%; float: left;">TP</span>
										<div class="barreProgressionMin">
											<span><?php echo round($tp_percent, 2); ?> %</span>
											<div class="progressionMin <?php if($tp_percent > 100) echo 'barreProgressionRed'; else echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
										</div>
										<span class="feEtatPrevisionnelleHeuresMin">
											<?php
												if(!$c['tp_conflit']) {
													echo '<span class="orange"><strong>- '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</strong></span>';
												} else {
													echo '<span class="red"><strong>+ '.str_replace('.', ',', round($c['tp'] / 60, 2)).'</strong></span>';
												}
											?>
										</span>
									<?php
										$c_tp = 1;
									}
								}
								
								if($filiereEnseignement['nbr_h_tp'] > 0 && !$c_tp) {
								?>
									<span style="width: 25%; float: left;">TP</span>
									<div class="barreProgressionMin">
										<span>100 %</span>
										<div class="progressionMin barreProgressionGreen" style="width: 125px;"></div>
									</div>
									<span class="feEtatPrevisionnelleHeuresMin"></span>
								<?php
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