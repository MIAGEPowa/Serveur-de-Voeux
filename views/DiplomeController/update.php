<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Diplômes</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'diplome/index';?>" title="">Diplômes</a><span class="delimiter">></span>Modification d'un diplôme
		</div>
		
		<div class="text text-full">
			<form id="form-update-degree" action="<?php echo WEBROOT.'diplome/index';?>" method="post">
				<fieldset>
					<legend ><span class="icon-heart"></span>Modifier un diplôme</legend>
					<div>
          
            <input type="hidden" id="idDegree" name="idDegree" value="<?php echo $info_degree[0]['id'];?>"/>
            
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="<?php echo $info_degree[0]['libelle'];?>" class="input-large" />
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