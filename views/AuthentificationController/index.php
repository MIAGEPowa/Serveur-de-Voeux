<div id="main">
	<div id="authentificationForm" class="authentification">
		<div class="text text-full">
			<h2>Authentification</h2>
			<form action="" method="POST">
				<fieldset>
					<div class="form-item">
						<label for="email">Utilisateur</label>
						<input type="text" name="email" class="input-large" />
					</div>
					<div class="form-item">
						<label for="password">Mot de passe</label>
						<input type="password" name="password" class="input-large" />
					</div>
					<span id="linkMotdepasseoublie" class="form-description span-link">Mot de passe oublié ?</span>
					
					<input name="authentification_form_submit" type="submit" class="input-submit-blue" value="Valider" />
				</fieldset>
			</form>
		</div>
	</div>
	<div id="motdepasseoublie" class="authentification" style="display: none;">
		<div class="text text-full">
			<h2>Mot de passe oublié ?</h2>
			<form action="" method="POST">
				<fieldset>
					<div class="form-item">
						<label for="email">Utilisateur</label>
						<input type="text" name="email" class="input-large" />
					</div>
					<span class="form-description">Veuillez saisir l'email qui correspond à votre compte.</span>
					
					<input name="authentification_form_motdepasseoublie" type="submit" class="input-submit-blue" value="Valider" />
				</fieldset>
			</form>
		</div>
	</div>
</div>