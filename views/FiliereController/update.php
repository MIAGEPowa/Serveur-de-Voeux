<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Filières</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'filiere/index'; ?>" title="">Filières</a><span class="delimiter">></span>Modification d'une filière
		</div>
		
		<div class="text text-full">
			<form id="form-update-filiere" action="#" method="post">
				<fieldset>
					<legend><span class="icon-book"></span>Modifier une filière</legend>
					<div>
						<div class="form-item">
							<label for="niveau">Niveau</label>
							<select id="niveau" name="niveau">							
								<?php
								// On parcours le tableau des niveaux
								foreach($arrayNiveaux as $niveau) {
									$selected = '';
									if($niveau['id'] == $filiere['id_niveau']) {
										$selected = 'selected';
									}
									?>
									<option value="<?php echo $niveau['id']; ?>" <?php echo $selected ?>><?php echo $niveau['libelle']; ?></option>
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
									$selected = '';
									if($specialite['id'] == $filiere['id_specialite']) {
										$selected = 'selected';
									}
									?>
									<option value="<?php echo $specialite['id']; ?>" <?php echo $selected ?>><?php echo $specialite['libelle']; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						
						<div class="form-item">
							<label for="apprentissage">Apprentissage</label>
							<select id="apprentissage" name="apprentissage">	
								<option value="1" <?php if($filiere['apprentissage'] == 1){echo 'selected';} ?>>Oui</option>					
								<option value="0" <?php if($filiere['apprentissage'] == 0){echo 'selected';} ?>>Non</option>
							</select>
						</div>
						
						<div class="form-item">
							<input type="submit" name="filiere_form_update" class="input-submit input-submit-orange" value="Modifier" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>