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
		
		<div class="text text-two">
			
			<div class="text-two-item text-two-item-first">
			
				<form id="form-update-filiereEnseignement" action="#" method="post">
					<fieldset>
						<legend><span class="icon-filieres-enseignement"></span>
							Visualiser l'association <?php echo $filiereEnseignement['filiere']; ?> - <?php echo $filiereEnseignement['enseignement']; ?>
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
							<label class="label-large blue" for="heuresCours">Nombre d'heures de cours</label>
							<?php echo $filiereEnseignement['h_cours']; if($filiereEnseignement['h_cours']) echo ' heures'; ?> <?php if($filiereEnseignement['m_cours']) echo 'et '.$filiereEnseignement['m_cours'].' minutes'; ?> 
						</div>

						<div class="form-item">
							<label class="label-large blue" for="groupesCours">Nombre de groupe de cours</label>
							<?php echo $filiereEnseignement['nbr_groupes_cours']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="heuresTD">Nombre d'heures de TD</label>
							<?php echo $filiereEnseignement['h_td']; if($filiereEnseignement['h_td']) echo ' heures'; ?> <?php if($filiereEnseignement['m_td']) echo 'et '.$filiereEnseignement['m_td'].' minutes'; ?> 
						</div>

						<div class="form-item">
							<label class="label-large blue" for="groupesTD">Nombre de groupe de TD</label>
							<?php echo $filiereEnseignement['nbr_groupes_td']; ?>
						</div>

						<div class="form-item">
							<label class="label-large blue" for="heuresTD">Nombre d'heures de TP</label>
							<?php echo $filiereEnseignement['h_tp']; if($filiereEnseignement['h_tp']) echo ' heures'; ?> <?php if($filiereEnseignement['m_tp']) echo ' et '.$filiereEnseignement['m_tp'].' minutes'; ?> 
						</div>

						<div class="form-item">
							<label class="label-large blue" for="groupesTD">Nombre de groupe de TP</label>
							<?php echo $filiereEnseignement['nbr_groupes_tp']; ?>
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
				<h2>Etat prévisionnelle</h2>
				<div id="feEtatPrevisionnelle">
					<div style="overflow: hidden; height: 45px;">	
						<span class="feEtatPrevisionnelleTitle">Cours</span>
						<div class="barreProgression">
							<span>55 %</span>
							<div class="progression barreProgressionRed" style="width: 115px;"></div>
						</div>
						<span class="feEtatPrevisionnelleHeures">100.5 / 305.5 heures</span>
					</div>
					
					<div style="overflow: hidden; height: 45px;">
						<span class="feEtatPrevisionnelleTitle">TD</span>
						<div class="barreProgression">
							<span>55 %</span>
							<div class="progression barreProgressionRed" style="width: 115px;"></div>
						</div>
						<span class="feEtatPrevisionnelleHeures">100.5 / 305.5 heures</span>
					</div>
					
					<div style="overflow: hidden; height: 45px;">
						<span class="feEtatPrevisionnelleTitle">TP</span>
						<div class="barreProgression">
							<span>100 %</span>
							<div class="progression barreProgressionGreen" style="width: 250px;"></div>
						</div>
						<span class="feEtatPrevisionnelleHeures">32.5 / 32.5 heures</span>
					</div>
				</div>
				
		
				<?php
					if(count($filiereEnseignementEnseignant) == 0) {
				?>
						<h2>Liste des voeux</h2>
						<p>Aucun voeu n'a encore été créé ...</p>
				<?php
					} else {
				?>
					<h2>Liste des voeux</h2>
					<table class="table-white no-tri">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Cours</th>
								<th>TD</th>
								<th>TP</th>
								<th>Badge</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($filiereEnseignementEnseignant as $fee) { ?>
							<tr>
								<td><?php echo $fee['prenom'].' '.$fee['nom'];?></td>
								<td><?php echo $fee['nbr_h_cours'];?></td>
								<td><?php echo $fee['nbr_h_td'];?></td>
								<td>0</td>
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