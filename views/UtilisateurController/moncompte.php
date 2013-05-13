<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Mon compte</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="" title="">Mon compte</a>
		</div>
		
		<div class="text text-full">
			<form action="" method="POST" enctype="multipart/form-data">
				 <fieldset>
					<legend><span class="icon-user"></span>Modifier les informations de mon compte</legend>
					<div class="form-item">
						<label for="email">Email</label>
						<input type="text" name="email" value="<?php echo $email; ?>" class="input-large" />
					</div>
					<span class="form-description">Vous pouvez modifier votre email via ce champ. Attention çela modifira votre login de connexion.</span>
					
					<div class="form-item">
						<label for="password">Mot de passe</label>
						<input type="password" name="password" class="input-large" />
					</div>
					<span class="form-description">Modifiez ce champ que si vous souhaitez changer votre mot de passe.</span>					
					
					<div class="form-item">
						<label class="label-top" for="biographie">Biographie</label>
						<textarea name="biographie"><?php echo $biographie; ?></textarea>
					</div>
					<span class="form-description">Ce champ libre permet de vous décrire.</span>
					
					<div class="form-item">
						<label for="badge">Badge</label>
						<input type="text" name="badge" value="<?php echo $badge; ?>" class="input-large" />
					</div>
					<span class="form-description">Si vous possèdez un badge pour accéder aux salles informatiques, renseignez le dans ce champ.</span>
					
					<div class="form-item">
						<label for="photo">Photo</label>
						<input type="file" name="photo" class="input-large" />
					</div>
					<span class="form-description">Vous pouvez ajouter une photo à votre compte.</span>
					
					<div class="form-item">
						<label for="cv">CV</label>
						<input type="file" name="cv" class="input-large" />
					</div>
					<span class="form-description">Vous pouvez lier à votre compte un CV sous le format PDF.</span>
					
					<div class="form-item">
						<input type="hidden" name="MAX_FILE_SIZE" value="100000">
						<input name="utilisateur_form_moncompte" type="submit" value="Enregistrer" class="input-submit input-submit-blue">
					</div>
				</fieldset>
			</form>
		</div>
	
	</div>
	
</div>