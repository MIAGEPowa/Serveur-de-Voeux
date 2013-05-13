<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Spécialités</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'specialite/index';?>" title="">Spécialités</a><span class="delimiter">></span>Modification d'une spécialité
		</div>
		
		<div class="text text-full">
			<form id="form-update-speciality" action="<?php echo WEBROOT.'specialite/index';?>" method="post">
				<fieldset>
					<legend ><span class="icon-heart"></span>Modifier une spécialité</legend>
					<div>
          
            <input type="hidden" id="idSpeciality" name="idSpeciality" value="<?php echo $info_speciality[0]['id'];?>"/>
            
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="<?php echo $info_speciality[0]['libelle'];?>" class="input-large" />
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