<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Spécialités</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'spécialite/index';?>" title="">Spécialités</a><span class="delimiter">></span>Ajout / Liste des spécialités
		</div>
		
		<div class="text text-full">
			<form id="form-create-speciality" action="<?php echo WEBROOT.'spécialite/index';?>" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-star"></span>Ajouter une spécialité<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="" class="input-large" />
						</div>
						
						<div class="form-item">
							<input type="submit" class="input-submit input-submit-green" value="Enregistrer" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-full">
			<h2>Liste des spécialités</h2>
			<table>
          <thead>
            <tr>
                <th width="12%">#</th>
                <th width="68%">Intitulé</th>
                <th width="20%">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($specialities as $s) { ?>
                  <tr>
                      <td><?php echo $s['id'];?></td>
                      <td><?php echo $s['libelle'];?></td>
                      <td><a class="buttons-link" href="<?php echo WEBROOT.'specialite/update/'.$s['id']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT.'specialite/delete/'.$s['id']; ?>"><span class="buttons button-red">Supprimer</span></a></td> 
                  </tr>
              <?php } ?>
          </tbody>
			</table>	
            
		</div>
		
	</div>
</div>