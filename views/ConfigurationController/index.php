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
							Attention ! Si vous décidez de passer à l'année suivante, cela aura des <strong>répercutions</strong> au sein de l'application.<br />
							<br />
							<i>
							- Les utilisateurs qui n'ont pas fait de voeux pendant 3 années successives seront désactivés <br />
							- Les enseignements en cours et qui ne sont reliés à aucune filière passeront dans l'état <u>abandonné</u> <br />
							- Les filières-enseignements de l'année N seront copiées pour l'année N+1 <br />
							</i>
						</div>
						
						<div class="form-item">
							<input type="submit" id="config_annee" name="config_annee" class="input-submit input-submit-blue" value="Passer à l'année suivante" /> <?php echo $anneeActuelle." => ".($anneeActuelle+1) ?>
						</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>