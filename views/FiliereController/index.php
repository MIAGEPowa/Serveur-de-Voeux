<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiere/index'; ?>" title="">Filières</a>
		</div>
		
		<div class="text text-full">
			<form id="form-create-filiere" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-book"></span>Ajouter une filière<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label for="niveau">Niveau</label>
							<select id="niveau" name="niveau">							
								<?php
								// On parcours le tableau des niveaux
								foreach($arrayNiveaux as $niveau) {
									?>
									<option value="<?php echo $niveau['id']; ?>"><?php echo $niveau['libelle']; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label for="specialite">Specialité</label>
							<select id="specialite" name="specialite">							
								<?php
								// On parcours le tableau des spécialités
								foreach($arraySpecialites as $specialite) {
									?>
									<option value="<?php echo $specialite['id']; ?>"><?php echo $specialite['libelle']; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label for="apprentissage">Apprentissage</label>
							<select id="apprentissage" name="apprentissage">					
								<option value="1">Oui</option>					
								<option value="0">Non</option>
							</select>
						</div>
						
						<div class="form-item">
							<input type="submit" name="filiere_form_add" class="input-submit input-submit-green" value="Enregistrer" />
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
							<th width="5%">#</th>
							<th width="10%">Niveau</th>
							<th width="10%">Specialité</th>
							<th width="15%" align="center">Apprentissage</th>
							<th width="20%">Responsable</th>
							<th width="20%">Secrétaire</th>
							<th width="20%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// On parcours le tableau des enseignements
						foreach($arrayFilieres as $filiere) {
						?>
							<tr>
								<td><?php echo $filiere['id']; ?></td>
								<td><?php echo $filiere['niveau']; ?></td>
								<td><?php echo $filiere['specialite']; ?></td>
								<td align="center">
									<?php 
										if($filiere['apprentissage_lib'] == 'Oui')
											echo '<img src="'.IMG_DIR.'y.png" title="Icône oui" />'; 
										else
											echo '<img src="'.IMG_DIR.'n.png" title="Icône non" />'; 
									?>
								</td>
								<td>
									<?php 
									foreach ($filiere['responsable'] as $resp) {
										($resp['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
										$responsable = ($resp['adjoint'] == 0) ? $civilite.' '.$resp['prenom'].' '.$resp['nom'] : '';
										if ($responsable != '')
											echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$resp['id_utilisateur'].'">'.$responsable.'</a><br />';
									}
									?>
								</td>
								<td>
									<?php 
									foreach ($filiere['secretaire'] as $secr) {
										($secr['civilite']) ? $civilite = 'M.' : $civilite = 'Mme';
										echo '<a href="'.WEBROOT.'annuaire/visualiser/'.$secr['id_utilisateur'].'">'.$civilite.' '.$secr['prenom'].' '.$secr['nom'].'</a><br />';
									}
									?>
								</td>
								<td>
									<a class="buttons-link" href="<?php echo WEBROOT; ?>filiere/view/<?php echo $filiere['id']; ?>"><span class="buttons button-green">Visualiser</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>filiere/delete/<?php echo $filiere['id']; ?>"><span class="buttons button-red">Supprimer</span></a>
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