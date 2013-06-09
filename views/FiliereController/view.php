<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiere/index'; ?>" title="">Filières</a><span class="delimiter">></span>Visualiser une filière
		</div>
		
		<div class="text text-two">
			
			<div class="text-two-item text-two-item-first">
				<fieldset>
					<legend><span class="icon-book"></span><?php echo $niveau.' '.$specialite; if($apprentissage == 'oui') echo ' Apprentissage'; else echo ' Initial'; ?></legend>
					<div>						
						<div class="form-item">
							<label class="label-large">Responsable</label>
							<?php 
								foreach ($arrayResponsable as $resp) {
									($resp['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
									$responsable = ($resp['adjoint'] == 0) ? $civilite.' '.$resp['prenom'].' '.$resp['nom'] : '';
									if ($responsable != '')
										echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$resp['id_utilisateur'].'">'.$responsable.'</a><br />';
								}
							?>
						</div>		
						
						<div class="form-item">
							<label class="label-large">Responsable(s) adjoint(s)</label>
							<span style="text-align: left; display: inline-block; width: auto; vertical-align: top;">
							<?php 
								foreach ($arrayResponsable as $resp) {
									($resp['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
									$responsable = ($resp['adjoint'] == 1) ? $civilite.' '.$resp['prenom'].' '.$resp['nom'] : '';
									if ($responsable != '')
										echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$resp['id_utilisateur'].'">'.$responsable.'</a><br />';
								}
							?>
							</span>
						</div>
						<div class="form-item">
							<label class="label-large">Secrétaire</label>
							<?php 
								foreach ($arraySecretaire as $secr) {
									($secr['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
									echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$secr['id_utilisateur'].'">'.$civilite.' '.$secr['prenom'].' '.$secr['nom'].'</a><br />';
								}
							?>
						</div>

					</div>
				</fieldset>
			</div>
			
			<div class="text-two-item">

			</div>
		</div>
		
		<div class="text text-full">
			<table class="no-tri">
				<thead>
					<tr>
						<th width="20%">Enseignement</th>
						<th width="20%">Enseignant</th>
						<th width="21%">Rôle</th>
						<th width="5%" align="center">Cours</th>
						<th width="5%" align="center">TD</th>
						<th width="5%" align="center">TP</th>
						<th width="8%" align="right">Total eq. TD</th>
						<th width="8%" align="right">Semetre 1</th>
						<th width="8%" align="right">Semetre 2</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// On parcours le tableau des enseignements
					// DEBUG
					//echo '<pre>' . print_r($arrayEnseignements, true) . '</pre>';
					$total = 0;
					foreach($arrayEnseignements as $enseignement) {
						$i = 0;
					?>
						<tr>
							<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $enseignement['id']; ?>" title="<?php echo $niveau.' '.$specialite; if($apprentissage) echo ' Apprentissage'; else echo ' Initial'; echo ' - '.$enseignement['libelle']; ?>"><?php echo $enseignement['libelle']; ?></a></td>
							
							<?php
								foreach($enseignement['voeux'] as $v) {
									if($i) {
										?>
										<tr>
											<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $v['id_filiere_enseignement']; ?>" title="<?php echo $niveau.' '.$specialite; if($apprentissage) echo ' Apprentissage'; else echo ' Initial'; echo ' - '.$enseignement['libelle']; ?>"><?php echo $enseignement['libelle']; ?></a></td>
										<?php
									}
									$total = $total + ($v['nbr_h_td'] + (($v['nbr_h_cours'] / 60) * $v['coeff_cours']) + (($v['nbr_h_tp'] / 60) * $v['coeff_tp']));
							?>
											<td>
												<?php
													if($v['civilite'])
														echo 'M. '.$v['prenom']. ' '.$v['nom'];
													else
														echo 'Mme '.$v['prenom']. ' '.$v['nom'];
												?>
											</td>
											<td><?php echo $v['role_libelle']; ?></td>
											<td align="center"><?php echo str_replace('.', ',', round($v['nbr_h_cours'] / 60, 2)); ?></td>
											<td align="center"><?php echo str_replace('.', ',', round($v['nbr_h_td'] / 60, 2)); ?></td>
											<td align="center"><?php echo str_replace('.', ',', round($v['nbr_h_tp'] / 60, 2)); ?></td>
											<td align="right"><?php echo str_replace('.', ',', round($v['nbr_h_td'] + (($v['nbr_h_cours'] / 60) * $v['coeff_cours']) + (($v['nbr_h_tp'] / 60) * $v['coeff_tp']), 2)); ?></td>
											<td align="right">
												<?php
													if($enseignement['semestre'] == 1)
														echo str_replace('.', ',', round($v['nbr_h_td'] + (($v['nbr_h_cours'] / 60) * $v['coeff_cours']) + (($v['nbr_h_tp'] / 60) * $v['coeff_tp']), 2));
												?>
											</td>
											<td align="right">
												<?php
													if($enseignement['semestre'] == 2)
														echo str_replace('.', ',', round($v['nbr_h_td'] + (($v['nbr_h_cours'] / 60) * $v['coeff_cours']) + (($v['nbr_h_tp'] / 60) * $v['coeff_tp']), 2));
												?>
											</td>
										</tr>
							<?php
									$i = $i + 1;
								}
								
								if(!$enseignement['voeux'])
									echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
					} 
					
					$s1_total = 0;
					$s2_total = 0;
					foreach($arrayEnseignements as $enseignement) {
						if($enseignement['semestre'] == 1) {
							foreach($enseignement['voeux'] as $v) {
								$s1_total = $s1_total + ($v['nbr_h_td'] + (($v['nbr_h_cours'] / 60) * $v['coeff_cours']) + (($v['nbr_h_tp'] / 60) * $v['coeff_tp']));
							}
						} else {
							foreach($enseignement['voeux'] as $v) {
								$s2_total = $s2_total + ($v['nbr_h_td'] + (($v['nbr_h_cours'] / 60) * $v['coeff_cours']) + (($v['nbr_h_tp'] / 60) * $v['coeff_tp']));
							}
						}
					}
					?>
					<tr>
						<td colspan="4" style="border-top: 1px #979797 solid;"></td>
						<td colspan="2" align="left" style="border-top: 1px #979797 solid;"><strong>Total</strong></td>
						<td align="right" style="border-top: 1px #979797 solid;"><strong><span class="blue"><?php echo str_replace('.', ',', round($total, 2)); ?></span></strong></td>
						<td align="right" style="border-top: 1px #979797 solid;"><strong><?php echo str_replace('.', ',', round($s1_total, 2)); ?></strong></td>
						<td align="right" style="border-top: 1px #979797 solid;"><strong><?php echo str_replace('.', ',', round($s2_total, 2)); ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
</div>