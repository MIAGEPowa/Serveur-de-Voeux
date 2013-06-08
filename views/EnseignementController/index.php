<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="">Enseignements</a>
		</div>
		
		<div class="text text-full">
			<form id="form-create-teaching" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-book"></span>Ajouter un enseignement<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="" class="input-large" />
						</div>
						
						<div class="form-item">
							<label class="label-top" for="description">Description *</label>
							<textarea id="description" name="description"></textarea>
						</div>
						<span class="form-description">Plan de l'enseignement...</span>
						
						
						<div class="form-item">
							<label for="keyword">Ajouter mot clé</label>
							<input type="text" id="keyword" value="" class="input-medium" />
							<select id="keyword-type" name="keywordType">
								<option value="1">Pré-requis</option>
								<option value="2">Compétences acquises</option>
							</select>
							<span id="add-keyword" class="buttons button-blue">Ajouter</span>
						</div>
						<span class="form-description">Mot clé + type du mot clé</span>
						
						<div class="form-item">
							<label for="">Liste des mots clés</label>
							<ul id="list-keywords">
								<li>Aucun mot clé...</li>
							</ul>
						</div>
						
						<div class="form-item">
							<input type="submit" class="input-submit input-submit-green" value="Enregistrer" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-full">
			<h2>Liste des enseignements</h2>

			<?php
			if(count($arrayEnseignements) == 0) {
			?>
				<p>
					Aucun enseignement n'a encore été créé...
				</p>
			<?php
			} else {
			?>
				<table>
					 <thead>
						<tr>
							<th width="12%">#</th>
							<th width="22%">Intitulé</th>
							<th width="22%">Créé par</th>
							<th width="22%">Etat</th>
							<th width="22%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// On parcours le tableau des enseignements
						foreach($arrayEnseignements as $enseignement) {
							$etat = '';
							$civilite = '';
							if($enseignement['etat'] == 0) {$etat = 'Créé';}
							else if($enseignement['etat'] == 1) {$etat = 'En cours';}
							else if($enseignement['etat'] == 2) {$etat = 'Abandonné';}
							($enseignement['auteur_civilite']) ? $civilite = 'M.' : $civilite = 'Mme'; 
						?>
							
							<tr>
								<td><?php echo $enseignement['id_enseignement']; ?></td>
								<td><?php echo $enseignement['libelle']; ?></td>
								<td><?php echo $civilite.' '.$enseignement['auteur_nom'].' '. $enseignement['auteur_prenom']; ?></td>
								<td><?php echo $etat; ?></td>
								<td>
									<a class="buttons-link" href="<?php echo WEBROOT; ?>enseignement/view/<?php echo $enseignement['id_enseignement']; ?>"><span class="buttons button-green">Visualiser</span><a class="buttons-link" href="<?php echo WEBROOT; ?>enseignement/update/<?php echo $enseignement['id_enseignement']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT; ?>enseignement/delete/<?php echo $enseignement['id_enseignement']; ?>"><span class="buttons button-red">Supprimer</span></a>
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