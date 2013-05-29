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
					<legend><span class="icon-book"></span>Visualiser une filière</legend>
					<div>
						<div class="form-item">
							<label class="label-large blue">Niveau</label>
							<?php echo $niveau ?>
						</div>
						
						<div class="form-item">
							<label class="label-large blue">Specialité</label>						
							<?php echo $specialite ?>
						</div>
						
						<div class="form-item">
							<label class="label-large blue">Apprentissage</label>
							<?php echo $apprentissage ?>
						</div>

					</div>
				</fieldset>
			</div>
			
			<div class="text-two-item">
				<?php
					if(count($arrayEnseignements) == 0) {
				?>
						<h2>Liste des enseignements de la filière</h2>
						<p>Aucun enseignement n'est associé à cette filière</p>
				<?php
					} else {
				?>
					<h2>Liste des enseignements de la filière</h2>
					<table>
					 <thead>
						<tr>
							<th width="22%">Intitulé</th>
							<th width="22%">Créé par</th>
							<th width="22%">Etat</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// On parcours le tableau des enseignements
						foreach($arrayEnseignements as $enseignement) {
							$etat = '';
							if($enseignement['etat'] == 0) {$etat = 'Créé';}
							else if($enseignement['etat'] == 1) {$etat = 'En cours';}
							else if($enseignement['etat'] == 2) {$etat = 'Abandonné';}
						?>
							
							<tr>
								<td><?php echo $enseignement['libelle']; ?></td>
								<td><?php echo $enseignement['auteur']; ?></td>
								<td><?php echo $etat; ?></td>
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
</div>