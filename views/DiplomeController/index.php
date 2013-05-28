<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">

		<div id="contentTitle">
			<h2>Diplômes</h2>
		</div>


		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'diplome/index';?>" title="Diplômes">Diplômes</a><span class="delimiter">></span>Ajout / Liste des diplômes
		</div>


		<div class="text text-full">
			<form id="form-create-degree" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-cup"></span>Ajouter un diplôme<span class="icon-arrow"></span></legend>
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

			<h2>Liste des diplômes</h2>
			<table>
				<thead>
					<tr>
						<th width="12%">#</th>
						<th width="68%">Intitulé</th>
						<th width="20%">Actions</th>
					</tr>
				</thead>

				<tbody>
			
				  <?php foreach ($diplomes as $d) { ?>
		
				      <tr>
				          <td><?php echo $d['id'];?></td>
				          <td><?php echo $d['libelle'];?></td>
				          <td><a class="buttons-link" href="<?php echo WEBROOT.'diplome/update/'.$d['id']; ?>"><span class="buttons button-orange">Modifier</span></a><a class="buttons-link" href="<?php echo WEBROOT.'diplome/delete/'.$d['id']; ?>"><span class="buttons button-red">Supprimer</span></a></td> 
				      </tr>
				
				  <?php } ?>
				
				</tbody>
			</table>	

		</div>

	</div>

</div>