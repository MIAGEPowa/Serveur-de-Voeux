<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Annuaire</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'annuaire/index';?>" title="">Annuaire</a><span class="delimiter">></span>Visualiser
		</div>
		
		<div class="text text-full">
			<?php
				if(file_exists(ROOT.'files/cv/'.$utilisateur[0]['id'].'.pdf')) {
					echo '<a href="'.WEBROOT.'files/cv/'.$utilisateur[0]['id'].'.pdf" title="CV" target="_blank">';
					echo '<span class="buttons button-blue" style="float: right;">Télécharger CV</span>';
					echo '</a>';
				} else {
					echo '</span>';
				}
			?>
		</div>
		<div class="clear"></div>
		
		<div class="text text-two-large">
			
			<div class="text-two-large-item text-two-large-item-first">
			
				<fieldset>
					<legend><span class="icon-user"></span>Profil de <?php if($utilisateur[0]['civilite'] == 1) echo 'M. '; else echo 'Mme '; echo $utilisateur[0]['nom'].' '. $utilisateur[0]['prenom'];?></legend>
							
					<?php
					  
					  if(file_exists(ROOT.'files/avatar/'.$utilisateur[0]['id'].'.png'))
						$photo = $utilisateur[0]['id'].'.png';
					  else if(file_exists(ROOT.'files/avatar/'.$utilisateur[0]['id'].'.jpg'))
						$photo = $utilisateur[0]['id'].'.jpg';
					  else if(file_exists(ROOT.'files/avatar/'.$utilisateur[0]['id'].'.gif'))
						$photo = $utilisateur[0]['id'].'.gif';
					  else
						$photo = 'default.jpg';
					?>
					
					<img src="<?php echo WEBROOT.'files/avatar/'.$photo; ?>" alt="<?php echo $utilisateur[0]['prenom'].' '.$utilisateur[0]['nom']; ?>" title="<?php echo $utilisateur[0]['prenom'].' '.$utilisateur[0]['nom']; ?>" width="115" height="115" style="margin: 20px 0 0 0" />
					
					<div class="form-item">
						<label class="blue" style="width: 25%;">Email</label> 
						<span><?php echo $utilisateur[0]['email'];?></span>
					</div>

					<div class="form-item" >
						<label class="blue" style="width: 25%;">Biographie</label>
						<span style="text-align: justify; display: inline-block; width: 70%; vertical-align: top;"><?php echo $utilisateur[0]['biographie'];?></span>
					</div>

					<div class="form-item">
						<label class="blue" style="width: 25%;">Badge</label>
						<span><?php echo $utilisateur[0]['badge'];?></span>
					</div>

					<div id="list-keywords" class="form-item">
						<label class="blue" style="width: 25%;">Mots clés</label>
						<?php
							// s'il existe des keywords
							if(count($arrayKeywords) != 0) {
								// On parcours le tableau des keywords
								for ($i = 0; $i < count($arrayKeywords); $i++) {
									if ($i == 0)
										echo $arrayKeywords[$i]['keyword'];
									else 
										echo ", ".$arrayKeywords[$i]['keyword'];
								}
							}
						?>
					</div>
					
					<div id="list-keywords" class="form-item">
						<label class="blue" style="width: 25%;">Rôle(s)</label>
						<?php
							// s'il existe des rôles
							if(count($roles_utilisateur) != 0) {
								// On parcours le tableau des rôles
								echo '<span style="text-align: justify; display: inline-block; width: 70%; vertical-align: top;">';
								for ($i = 0; $i < count($roles_utilisateur); $i++) {
									echo $roles_utilisateur[$i]['libelle'].'<br />';
								}
								echo '</span>';
							}
						?>
					</div>
				</fieldset>
			</div>
			
			<div class="text-two-large-item">
				<h2>Etat prévisionnel</h2>
				<?php
				// s'il existe des voeux
				if(count($arrayVoeux) != 0) {
				?>
					<table class="table-white no-tri">
						<thead>
							<tr>
								<th width="26%">Filière</th>
								<th width="26%">Enseignement</th>
								<th width="11%" align="center">Cours</th>
								<th width="11%" align="center">TD</th>
								<th width="11%" align="center">TP</th>
								<th width="15%" align="right">Total eq. TD</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// On parcours le tableau des voeux
							$total = 0;
							foreach($arrayVoeux as $voeu) {
								$apprentissage = ($voeu['filiere_apprentissage'] == 1) ? 'Apprentissage' : 'Initial';
								$nbr_h_cours = ($voeu['fee_nbr_h_cours'] % 60 != 0) ? (floor( $voeu['fee_nbr_h_cours'] / 60 )).','.round((($voeu['fee_nbr_h_cours'] % 60) * 100 / 60), 0) : (floor( $voeu['fee_nbr_h_cours'] / 60 ));
								$nbr_h_td = ($voeu['fee_nbr_h_td'] % 60 != 0) ? (floor( $voeu['fee_nbr_h_td'] / 60 )).','.round((($voeu['fee_nbr_h_td'] % 60) * 100 / 60), 0) : (floor( $voeu['fee_nbr_h_td'] / 60 ));
								$nbr_h_tp = ($voeu['fee_nbr_h_tp'] % 60 != 0) ? (floor( $voeu['fee_nbr_h_tp'] / 60 )).','.round((($voeu['fee_nbr_h_tp'] % 60) * 100 / 60), 0) : (floor( $voeu['fee_nbr_h_tp'] / 60 ));
							
								$total = $total + ($nbr_h_td + (($voeu['fee_nbr_h_cours'] / 60) * $coeff_cours) + (($voeu['fee_nbr_h_tp'] / 60) * $coeff_tp));
							?>
								<tr>
									<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $voeu['id_filiere_enseignement']; ?>"><?php echo $voeu['niveau_libelle'].' '.$voeu['specialite_libelle'].' '.$apprentissage; ?></a></td>
									<td><?php echo $voeu['enseignement_libelle']; ?></td>
									<td align="center"><?php echo $nbr_h_cours; ?></td>
									<td align="center"><?php echo $nbr_h_td; ?></td>
									<td align="center"><?php echo $nbr_h_tp; ?></td>
									<td align="right"><?php echo str_replace('.', ',', round($nbr_h_td + (($voeu['fee_nbr_h_cours'] / 60) * $coeff_cours) + (($voeu['fee_nbr_h_tp'] / 60) * $coeff_tp), 2); ?></td>
								</tr>
							<?php 
							} 
							?>
							<tr>
								<td colspan="3" style="border-top: 1px #979797 solid;"></td>
								<td colspan="2" align="left" style="border-top: 1px #979797 solid;"><strong>Total</strong></td>
								<td align="right" style="border-top: 1px #979797 solid;"><?php echo str_replace('.', ',', $total); ?></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td colspan="2" align="left"><strong>Heures statutaires</strong></td>
								<td align="right"><?php echo str_replace('.', ',', $quota_h); ?></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td colspan="2" align="left"><strong>Délégations</strong></td>
								<td align="right"><?php echo str_replace('.', ',', $utilisateur[0]['nbr_h_delegation']); ?></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td colspan="2" align="left"><strong><?php if($total > ($quota_h - $utilisateur[0]['nbr_h_delegation'])) echo 'Heures supplémentaires'; else echo 'Heures restantes'; ?></strong></td>
								<td align="right">
									<strong><span class="blue">
									<?php
										if($total > ($quota_h - $utilisateur[0]['nbr_h_delegation']))
											echo str_replace('.', ',', $total - ($quota_h - $utilisateur[0]['nbr_h_delegation']));
										else
											echo str_replace('.', ',', ($quota_h - $utilisateur[0]['nbr_h_delegation']) - $total);
									?>
									</span></strong>
								</td>
							</tr>
						</tbody>
					</table>
				<?php 
				} else { 
				?>
				<p>Aucun voeu pour le moment</p>
				<?php
				}
				?>
			</div>
			
		</div>
		
		<div class="text text-two">
		
			<div class="text-two-item text-two-item-first">
				<h2>Enseignement(s)</h2>
				<?php
				// s'il existe des enseignements
				if(count($arrayDegrees) != 0) {
				?>
					<table class="table-white no-tri">
						<thead>
							<tr>
								<th width="22%">#</th>
								<th width="22%">Intitulé</th>
								<th width="22%">Description</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// On parcours le tableau des enseignements
							foreach($arrayDegrees as $degree) {
							?>
								<tr>
									<td><?php echo $degree['id']; ?></td>
									<td><a href="<?php echo WEBROOT; ?>enseignement/view/<?php echo $degree['id']; ?>" title="<?php echo $degree['libelle']; ?>"><?php echo $degree['libelle']; ?></a></td>
									<td><?php echo $degree['description']; ?></td>
								</tr>
							<?php 
							} 
							?>
						</tbody>
					</table>
				<?php 
				} else {
				?>
				<p>Aucun enseignement créé</p>
				<?php } ?>
			</div>
		
			<div class="text-two-item">
				<h2>Délégations</h2>
				<?php 
				if (isset($utilisateur[0]['nbr_h_delegation']) && (!empty($utilisateur[0]['nbr_h_delegation'])) && (isset($utilisateur[0]['description_delegation'])) && (!empty($utilisateur[0]['description_delegation']))) {
				?>
					<table class="table-white no-tri">
						<thead>
							<tr>
								<th width="50%">Heures</th>
								<th width="50%">Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $utilisateur[0]['nbr_h_delegation'];?></td>
								<td><?php echo $utilisateur[0]['description_delegation'];?></td>
							</tr>
						</tbody>
					</table>
				<?php
				} else {
				?>
				<p>Aucune délégation</p>
				<?php
				}
				?>
			</div>
		
		</div>
	
	</div>
	
</div>