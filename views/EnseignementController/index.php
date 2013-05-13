<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="./" title="">Enseignements</a><span class="delimiter">></span>Ajout / Liste des enseignements
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
							<th width="22%">Auteur</th>
							<th width="22%">Etat</th>
							<th width="22%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// on parcours le tableau des enseignements
						foreach($arrayEnseignements as $enseignement) {
							$etat = '';
							if($enseignement['etat'] == 0) {$etat = 'Créé';}
							else if($enseignement['etat'] == 1) {$etat = 'En cours';}
							else if($enseignement['etat'] == 2) {$etat = 'Abandonné';}
						?>
							
							<tr>
								<td><?php echo $enseignement['id']; ?></td>
								<td><?php echo $enseignement['libelle']; ?></td>
								<td><?php echo $_SESSION['v_prenom'].' '. $_SESSION['v_nom']; ?></td>
								<td><?php echo $etat; ?></td>
								<td>
									<span class="buttons button-orange">Modifier</span><span class="buttons button-red">Supprimer</span>
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