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
			<form id="form-create-voeu" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-book"></span>Ajouter un voeu<span class="icon-arrow"></span></legend>
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
						<th width="18%">Filière</th>
						<th width="18%">Enseignement</th>
						<th width="8%" align="center">Année</th>
						<th width="10%" align="center">Cours</th>
						<th width="10%" align="center">TD</th>
						<th width="10%" align="center">TP</th>
						<th width="11%">Conflits</th>
						<th width="15%">Actions</th> <!-- Visualiser et Supprimer -->
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
							<td><?php echo $f['filiere']; ?></td>
							<td><?php echo $f['libelle']; ?></td>
							<td align="center"><?php echo $f['annee']; ?></td>
							<td align="center"><?php echo $voeur_utilisateur_h_cours; ?> h</td>
							<td align="center"><?php echo $voeur_utilisateur_h_td; ?> h</td>
							<td align="center"><?php echo $voeur_utilisateur_h_tp; ?> h</td>
							<td>
								<?php
									if($f['conflits']) {
										// Cours
										if(isset($f['conflits']['cours']) && isset($f['conflits']['cours_conflit'])) {
											if(!$f['conflits']['cours_conflit'])
												echo 'Cours (<strong><span class="orange">- '.round($f['conflits']['cours'] / 60, 2).'</span></strong>)<br />';
											else
												echo 'Cours (<strong><span class="red">+ '.round($f['conflits']['cours'] / 60, 2).'</span></strong>)<br />';
										}
										
										// TD
										if(isset($f['conflits']['td']) && isset($f['conflits']['td_conflit'])) {
											if(!$f['conflits']['td_conflit'])
												echo 'TD (<strong><span class="orange">- '.round($f['conflits']['td'] / 60, 2).'</span></strong>)<br />';
											else
												echo 'TD (<strong><span class="red">+ '.round($f['conflits']['td'] / 60, 2).'</span></strong>)<br />';
										}
										
										// TP
										if(isset($f['conflits']['tp']) && isset($f['conflits']['tp_conflit'])) {
											if(!$f['conflits']['tp_conflit'])
												echo 'TP (<strong><span class="orange">- '.round($f['conflits']['tp'] / 60, 2).'</span></strong>)<br />';
											else
												echo 'TP (<strong><span class="red">+ '.round($f['conflits']['tp'] / 60, 2).'</span></strong>)<br />';
										}
									}
								?>
							</td>
							<td>
								<a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $f['id_filiere_enseignement']; ?>"><span class="buttons button-green">Visualiser</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>"><span class="buttons button-red">Supprimer</span></a>
							</td>
						</tr>
						
					<?php } ?>
				
				</tbody>
			</table>
		</div>

	</div>
</div>