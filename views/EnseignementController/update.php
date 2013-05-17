<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Modification d'un enseignement</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'enseignement/index'; ?>" title="">Enseignements</a><span class="delimiter">></span>Modification d'un enseignement
		</div>
		
		<div class="text text-full">
			<form id="form-update-teaching" action="#" method="post">
				<fieldset>
					<legend><span class="icon-book"></span>Modifier un enseignement</legend>
					<div>
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="<?php echo $enseignement['libelle']; ?>" class="input-large" />
						</div>
						
						<div class="form-item">
							<label class="label-top" for="description">Description *</label>
							<textarea id="description" name="description"><?php echo $enseignement['description']; ?></textarea>
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
						
						<div id="list-keywords" class="form-item">
						<label for="keyword">Liste des mots clés</label>
						<?php
						// s'il existe des keywords
						if(count($arrayKeywords) != 0) {
						?>
							<table class='form-table'>
								<thead>
									<tr>
										<th width="22%">Intitulé</th>
										<th width="22%">Type</th>
										<th width="22%">Action</th>
										<th width="22%"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									// On parcours le tableau des enseignements
									foreach($arrayKeywords as $keyword) {
										$type = '';
										if($keyword['pre_requis'] == 1) {$type = 'Pré-requis';}
										else{$type = 'Compétences acquises';}
									?>
										<tr>
											<td class="value-keyword" data-id-key="<?php echo $keyword['id'] ?>"><?php echo $keyword['keyword']; ?></td>
											<td><?php echo $type; ?></td>
											<td>
												<a class="buttons-link" onclick="deleteRow($(this))"><span class="buttons button-red">Supprimer</span></a>
											</td>
											<td></td>
										</tr>
									<?php 
									} 
									?>
								</tbody>
							</table>
							<span style="display:none">Aucun mot clé...</span>
						<?php 
						} else {
						?>
							<span>Aucun mot clé...</span>
						<?php
						}
						?>
					</div>
						
						<div class="form-item">
							<input type="submit" class="input-submit input-submit-orange" value="Modifier" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>