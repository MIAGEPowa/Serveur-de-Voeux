<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Importer des utilisateurs</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'utilisateurs/gestion'; ?>" title="Utilisateurs">Utilisateurs</a><span class="delimiter">> </span>Importer des utilisateurs
		</div>
		
		<div class="text text-full">
			
			<form action="" method="POST">
			
				 <fieldset>
					<legend><span class="icon-import-utilisateur"></span>Importer des utilisateurs</legend>
					<div class="form-item">
						<label class="label-top" for="textarea_csv">Contenu fichier CSV*</label>
						<textarea id="textarea_csv" name="textarea_csv"></textarea>
					</div>
					<span class="form-description">
						Veuillez insérer dans le textarea ci-dessus le contenu du fichier CSV d'importation des utilisateurs.<br />
						Un utilisateur par ligne.<br />
						(civilite;nom;prenom;email;badge;actif)<br />
						Pour les civilités, veuillez préciser 0 pour Madame et 1 pour Monsieur.<br />
						Seul le paramètre badge est facultatif.	Si vous souhaitez importer un utilisateur sans badge (civilite;nom;prenom;email;;actif).				
					</span>
				
					<div class="form-item">
						<input name="utilisateur_form_importer" type="submit" value="Importer" class="input-submit input-submit-green" />
					</div>
				
				</fieldset>
				
			</form>
			
		</div>
	
	</div>
	
</div>