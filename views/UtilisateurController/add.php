<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Ajout d'un utilisateur</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'utilisateur/gestion'; ?>" title="">Utilisateurs</a><span class="delimiter">></span>Ajout d'un utilisateur
		</div>
		
		<div class="text text-full">
		
			<form id="form-add-user" action="" method="POST">
				 <fieldset>
					<legend><span class="icon-user"></span>Ajouter un utilisateur</legend>
					<div class="form-item">
						<label for="email">Email *</label>
						<input id="email" type="text" name="email" class="input-large" />
					</div>
					<span class="form-description">Une fois l'utilisateur enregistré, un mail lui sera envoyé afin de le prévenir. Ce mail contiendra aussi un mot de passe avec lequel il pourra se connecter.</span>
					
					<div class="form-item">
						<label for="civilite">Civilité</label>						
						<select id="civilite" name="civilite">
							<option value="1">M</option>
							<option value="0">Mme</option>
						</select>
					</div>
					
					<div class="form-item">
						<label for="nom">Nom *</label>
						<input id="nom" type="text" name="nom" class="input-large" />
					</div>
					
					<div class="form-item">
						<label for="prenom">Prenom *</label>
						<input id="prenom" type="text" name="prenom" class="input-large" />
					</div>
					
					<div class="form-item">
						<label for="badge">Badge</label>
						<input id="badge" type="text" name="badge" class="input-large" />
					</div>
					
					<div class="form-item">
						<input name="utilisateur_form_add" type="submit" value="Enregistrer" class="input-submit input-submit-blue">
					</div>
				
				</fieldset>
			</form>
		</div>
	
	</div>
	
</div>