<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Niveaux</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'niveau/index';?>" title="">Niveaux</a><span class="delimiter">></span>Ajout / Liste des niveaux
		</div>
		
		<div class="text text-full">
			<form id="form-create-level" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-heart"></span>Ajouter un niveau<span class="icon-arrow"></span></legend>
					<div style="display:none">
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="" class="input-large" />
						</div>
						
						<div class="form-item">
							<label for="description">Diplôme *</label>
							<select id="diplome" name="diplome">
                <?php foreach ($degrees as $d): ?>
                  <option value="<?php echo $d['id'];?>"><?php echo $d['libelle'];?></option>
                  <?php endforeach; ?>
              </select>
						</div>
						<div class="form-item">
							<input type="submit" class="input-submit input-submit-green" value="Enregistrer" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-full">
			<h2>Liste des niveaux</h2>
			<table>
          <thead>
            <tr>
                <th width="12%">#</th>
                <th width="34%">Intitulé</th>
                <th width="34%">Diplôme</th>
                <th width="20%">Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($levels as $l) { ?>
                  <tr>
                      <td><?php echo $l['id_niveau'];?></td>
                      <td><?php echo $l['libelle_niveau'];?></td>
                      <td><?php echo $l['libelle_diplome'];?></td>
                      <td><a class="buttons-link" href="<?php echo WEBROOT.'niveau/update/'.$l['id_niveau']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT.'niveau/delete/'.$l['id_niveau']; ?>"><span class="buttons button-red">Supprimer</span></a></td> 
                  </tr>
              <?php } ?>
          </tbody>
			</table>	
            
		</div>
		
	</div>
</div>