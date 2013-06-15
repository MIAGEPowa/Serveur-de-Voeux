<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>
	
	<div id="content">
		<div id="contentTitle">
			<h2><?php echo $v_titreHTML; ?></h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="./" title="Tableau de bord">Tableau de bord</a>
		</div>
		
		<?php
			if($_SESSION['v_droits'] != 2) {
		?>
		
			<div class="text text-two">
			
				<div class="text-two-item text-two-item-first" style="clear: both;">
					<h2>Etat prévisionnel des filières</h2>
					
					<table class="no-search">
						<thead>
							<tr>
								<th width="40%">Filière</th>
								<th width="30%">Responsable</th>
								<th width="30%">Secrétaire</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($arrayFilieres as $f) {
								?>
								<tr>
									<td><a href="<?php echo WEBROOT; ?>filiere/view/<?php echo $f['id']; ?>" title="<?php echo $f['name']; ?>"><?php echo $f['name']; ?></a></td>
									<td>
										<?php 
											foreach ($f['responsable'] as $resp) {
												($resp['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
												$responsable = ($resp['adjoint'] == 0) ? $civilite.' '.$resp['prenom'].' '.$resp['nom'] : '';
												if ($responsable != '')
													echo $responsable.'<br />';
											}
										?>
									</td>
									<td>
										<?php 
											foreach ($f['secretaire'] as $secr) {
												($secr['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
												echo $civilite.' '.$secr['prenom'].' '.$secr['nom'].'<br />';
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
				
				<div class="text-two-item">
					<h2>Filière-enseignements avec la même référence</h2>			

					<?php
					if(count($arrayFilieresEnseignementsSameRef) == 0) {
					?>
						<p>
							Il n'y a pas de filière-enseignement avec la même référence
						</p>
					<?php
					} else {
					?>
						<table class="no-search">
							 <thead>
								<tr>
									<th width="60%">Filière - Enseignement</th>
									<th width="20%">Réf</th>
									<th width="20%">Réf</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// On parcours le tableau des enseignements
								foreach($arrayFilieresEnseignementsSameRef as $key/*=ref*/ => $arrayFilieresEnseignements) {
								?>
									<tr>
										<td>
											<?php
												$i = 0;
												foreach($arrayFilieresEnseignements as $fe) {
													if($i != 0) {echo '<br/>';}
													$apprentissage = ($fe['apprentissage'] == 0) ? "initial" : "apprentissage";
													echo $fe['libelle_niveau'].' '.$fe['libelle_specialite'].' '.$apprentissage.' - '.$fe['libelle_enseignement'];
													$i++;
												}
											?>
										</td>
										<td><strong><?php echo $key; ?></strong></td>
										<td>
											<a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/index/0/<?php echo $key ?>"><span class="buttons button-orange">Modifier</span></a>
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
   
		<?php
			}
		?>
	
		<?php
			if($_SESSION['v_droits'] >= 2) {
		?>
		<div class="text text-full">
			<h2>Vos heures</h2>	
			  <table class="no-tri">
				 <thead>
				  <tr>
					<th width="20%">Détail</th>
					<th width="10%">Conflit</th>
					<th width="10%"></th>
				  </tr>
				</thead>
				<tbody>
					<tr>
						<td class="feEtatPrevisionnelle">
							<?php
								$widthBarre = 300;
								$percent = ($total / $quota_h) * 100;
								if($percent <= 100)
									$width_progression = 400 * ($percent/100);
								else
									$width_progression = $widthBarre;
							?>
							<div class="barreProgression" style="width:<?php echo $widthBarre.'px'; ?>">
								<span><?php echo round($percent, 2); ?> %</span>
								<div class="progression <?php if($percent == 100) echo 'barreProgressionGreen'; else if($percent > 100) echo 'barreProgressionRed'; else if($percent < 100) echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
							</div>
							<span class="feEtatPrevisionnelleHeures">
								<?php echo $total.' <span style="font-size:11px">(dont '.$utilisateur['nbr_h_delegation'].' h de délégations)</span> / '.$quota_h.' h'; ?>
							</span>
						</td>
						<td>
							<?php
								$conflit = $total - $quota_h;
								$signe = '';
								if($conflit < 0) {
									$couleur = 'orange';
									$conflit = str_replace('-','',$conflit);
									$signe = '-';
								}
								else if($conflit > 0) {
									$couleur = 'red';
									$signe = '+';
								}
								else {
									$couleur = 'green';
								}
							?>
							<span class="<?php echo $couleur; ?>"><strong><?php echo $signe.' '.str_replace('.',',',$conflit); ?> h</strong></span>
						</td>
						<td><a class="buttons-link" href="<?php echo WEBROOT; ?>voeu/index"><span class="buttons button-green">Visualiser</span></a></td>
					</tr>
				</tbody>
			</table> 
		</div>
		
		<?php
			}
		?>
	
		<div class="text text-full">
			<h2>Filière-enseignements ayant des conflits</h2>	
			
			<?php
					if(count($arrayConflits) == 0) {
					?>
						<p>
							Il n'y a pas de conflits
						</p>
					<?php
					} else {
					?>
			  <table class="no-search">
				 <thead>
				  <tr>
					<th width="40%">Filière - Enseignement</th>
					<th width="10%">Type</th>
					<th width="35%">Détails</th>
					<th width="15%">Conflits</th>
				  </tr>
				</thead>
				<tbody>
				  <?php
								// On parcours le tableau des enseignements
								foreach($arrayConflits as $conflit) {
								?>
					<tr>
					  <td> <a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $conflit['id']; ?>"><?php echo $conflit['filiere'].' '.$conflit['enseignement']?></a></td>
					  <td>
						<?php
						if (isset($conflit['cours'])) 
						  echo 'Cours';
						else if (isset($conflit['td']))
						  echo 'TD';
						else 
						  echo 'TP';
						?>
					  </td>
					  <td class="feEtatPrevisionnelle">
						<?php
						if (isset($conflit['cours'])) {
						  $total_volume = $conflit['nbr_h_cours'] * $conflit['nbr_groupes_cours'];
						  if ($conflit['cours_conflit'] == 0)
							$total_voeux = $total_volume - $conflit['cours'];
						  else
							$total_voeux = $conflit['cours'] + $total_volume;
							
						  $type = $conflit['cours_conflit'];
						}
						else if (isset($conflit['td'])) {
						  $total_volume = $conflit['nbr_h_td'] * $conflit['nbr_groupes_td'];
						  if ($conflit['td_conflit'] == 0)
							$total_voeux = $total_volume - $conflit['td'];
						  else
							$total_voeux = $conflit['td'] + $total_volume;
							
						  $type = $conflit['td_conflit'];
						}    
						else {
						  $total_volume = $conflit['nbr_h_tp'] * $conflit['nbr_groupes_tp'];
						  if ($conflit['tp_conflit'] == 0)
							$total_voeux = $total_volume - $conflit['tp'];
						  else
							$total_voeux = $conflit['tp'] + $total_volume;
							
						  $type = $conflit['tp_conflit'];
						} 
						
						$percent = ($total_volume == 0) ? 0 : ($total_voeux * 100) / $total_volume;
						$width_progression = ($percent * 250) / 100;
						if($width_progression > 250)
						  $width_progression = 250;
						?>
						
						<div class="barreProgression">
						  <span><?php echo round($percent, 2); ?> %</span>
						  <div class="progression <?php if($percent == 100) echo 'barreProgressionGreen'; else if($percent > 100) echo 'barreProgressionRed'; else if($percent < 100) echo 'barreProgressionOrange'; ?>" style="width: <?php echo $width_progression; ?>px;"></div>
						</div>
						<span class="feEtatPrevisionnelleHeures"><?php echo str_replace('.', ',', round($total_voeux / 60, 2)).' / '.str_replace('.', ',', round($total_volume / 60, 2));  ?> h</span>
					  </td>
					  <td>
						<?php   
						// Il manque des heures
						if($type == 0) {
						  $nbr_h_conflit = $total_volume - $total_voeux;
						  echo '<span class="orange"><strong>- '.str_replace('.', ',', round($nbr_h_conflit / 60, 2)).' h</strong></span>';
						}
						else {
						  $nbr_h_conflit = abs($total_voeux - $total_volume);
						  echo '<span class="red"><strong>+ '.str_replace('.', ',', round($nbr_h_conflit / 60, 2)).' h</strong></span>';
						}
						?>
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