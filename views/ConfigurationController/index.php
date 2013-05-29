<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Configuration</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'configuration/index'; ?>" title="">Configuration</a>
		</div>
		
		<div class="text text-full">
			<form id="form-config" action="#" method="post">
				<fieldset>
					<legend><span class="icon-config"></span>Configuration</legend>
						<div class="form-item">
							Attention ! Si vous décidez de passer à l'année suivante, cela aura des répercutions <strong>IRREVERSIBLES</strong> au sein de l'application.<br />
							Les listes ....
						</div>
						
						<div class="form-item">
							<input type="submit" id="config_annee" name="config_annee" class="input-submit input-submit-blue" value="Passer à l'année suivante" /> <?php echo $anneeActuelle." => ".($anneeActuelle+1) ?>
						</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>