<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Délégations</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="" title="Délégations">Délégations</a>
		</div>
		
		<div class="text text-full">
			
			<form action="" method="POST">
			
				 <fieldset>
					<legend><span class="icon-delegations"></span>Modifier les vos délégations</legend>
					<div class="form-item">
						<label for="h_delegations">Heures*</label>
						<input id="h_delegations" type="text" name="h_delegations" value="<?php echo $nbr_h_delegation; ?>" class="input-little" />
					</div>
					<span class="form-description">Ajoutez la somme du nombre de vos heures de délégations.</span>
					
					<div class="form-item">
						<label class="label-top" for="description_delegations">Description*</label>
						<textarea id="description_delegations" name="description_delegations"><?php echo $description_delegation; ?></textarea>
					</div>
					<span class="form-description">Veuillez décrire vos heures de délégations.</span>
				
					<div class="form-item">
						<input name="utilisateur_form_delegations" type="submit" value="Enregistrer" class="input-submit input-submit-green" />
					</div>
				
				</fieldset>
				
			</form>
			
		</div>
	
	</div>
	
</div>