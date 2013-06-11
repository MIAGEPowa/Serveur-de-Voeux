<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'enseignement/index';?>" title="Enseignements">Enseignements</a><span class="delimiter">></span>Visualiser
		</div>
		
		<div class="text text-two">
		
			<div class="text-two-item text-two-item-first">
			
				<fieldset>
					<legend><span class="icon-book"></span><?php echo $enseignement[0]['libelle'];?></legend>
					
					<?php
						$civilite = '';
						($enseignement[0]['auteur_civilite']) ? $civilite = 'M.' : $civilite = 'Mme'; 
					?>
					
					<div class="form-item">
						<label class="blue">Auteur</label>
						<span><a href="<?php echo WEBROOT.'annuaire/visualiser/'.$enseignement[0]['auteur_id'];?>" title="<?php echo $civilite.' '.$enseignement[0]['auteur_nom'].' '.$enseignement[0]['auteur_prenom'];?>"><?php echo $civilite.' '.$enseignement[0]['auteur_nom'].' '.$enseignement[0]['auteur_prenom'];?></a></span>
					</div>
					
					<div class="form-item">
						<label class="blue">Description</label> 
						<span style="text-align: justify; display: inline-block; width: 70%; vertical-align: top;"><?php echo $enseignement[0]['description'];?></span>
					</div>

					<?php
						$etat = '';
						if($enseignement[0]['etat'] == 0) {$etat = 'Créé';}
						else if($enseignement[0]['etat'] == 1) {$etat = 'En cours';}
						else if($enseignement[0]['etat'] == 2) {$etat = 'Abandonné';} 
					?> 
					
					<div class="form-item">
						<label class="blue">Etat</label>
						<span><?php echo $etat;?></span>
					</div>

					<div id="list-keywords" class="form-item">
						<label class="blue">Mots clés</label>
						<?php
						// s'il existe des keywords
						if(count($arrayKeywords) != 0) {
							// On parcours le tableau des enseignements
							for ($i = 0; $i < count($arrayKeywords); $i++) {
								if ($i == 0)
									echo $arrayKeywords[$i]['keyword'];
								else 
									echo ", ".$arrayKeywords[$i]['keyword'];
							}
						}
						?>
					</div>
					
				</fieldset>
			
			</div>

			<div class="text-two-item">
				<h2>Associations de l'enseignement</h2>
					<?php
						// s'il existe des filières
						if(count($arrayFilieres) != 0) {
						?>
							<table>
								<thead>
									<tr>
										<th width="20%">#</th>
										<th width="60%">Intitulé</th>
										<th width="20%">Annee</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// On parcours le tableau des enseignements
									$apprentissage = '';

									foreach($arrayFilieres as $filiere) {
										if ($filiere['apprentissage'] == 0) $apprentissage = 'Initial'; else $apprentissage = 'Apprentissage';
										?>
										<tr>
											<td><?php echo $filiere['id_filiere']; ?></td>
											<td><a href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $filiere['id']; ?>" title="Visualiser la filière enseignement"><?php echo $filiere['libelle_niveau'].' '.$filiere['libelle_specialite'].' '.$apprentissage; ?></a></td>
											<td><?php echo $filiere['annee']; ?></td>
										</tr>
									<?php 
									}
									?>
								</tbody>
							</table>
						<?php 
						} else {
							echo "<p>L'enseignement n'a pas encore été associé à une filière.</p>";
						}
					?>
				</div>
			</div>
			
		</div>
	
	</div>
	
</div>