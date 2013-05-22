<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Enseignements</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'enseignement/index';?>" title="Enseignements">Enseignements</a><span class="delimiter">></span>Visualiser
		</div>
		
		<div class="text text-full">
			
			<fieldset>
        <legend><span class="icon-book"></span><?php echo $enseignement[0]['libelle'];?></legend>

        <div class="form-item">
          <label class="blue">Auteur</label>
          <span><a href="<?php echo WEBROOT.'annuaire/visualiser/'.$enseignement[0]['auteur_id'];?>" title="<?php echo $enseignement[0]['auteur_nom'].' '.$enseignement[0]['auteur_prenom'];?>"><?php echo $enseignement[0]['auteur_nom'].' '.$enseignement[0]['auteur_prenom'];?></a></span>
        </div>
        
        <div class="form-item">
					<label class="blue">Description</label> 
          <span style="text-align: justify; display: inline-block; width: 70%; vertical-align: top;"><?php echo $enseignement[0]['description'];?></span>
        </div>

        <?php
        $etat = '';
				if($enseignement[0]['etat'] == 0) {$etat = 'Créé';}
				else if($enseignement[0]['etat'] == 1) {$etat = 'En cours';}
				else if($enseignement[0]['etat'] == 2) {$etat = 'Abandonné';}
        ?> 
        
        <div class="form-item">
          <label class="blue">Etat</label>
					<span><?php echo $etat;?></span>
				</div>

				<div id="list-keywords" class="form-item">
					<label class="blue">Mots clés</label>
					<?php
						// s'il existe des keywords
						if(count($arrayKeywords) != 0) {
							// On parcours le tableau des enseignements
							for ($i = 0; $i < count($arrayKeywords); $i++) {
                if ($i == 0)
                  echo $arrayKeywords[$i]['keyword'];
                else 
                  echo ", ".$arrayKeywords[$i]['keyword'];
              } 
						}
            ?>
        </div>

        <div class="form-item">
          <label class="blue">Filières</label>
          <?php
						// s'il existe des filières
						if(count($arrayFilieres) != 0) {
						?>
							<table class='form-table table-white'>
								<thead>
									<tr>
										<th width="22%">#</th>
                    <th width="78%">Intitulé</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// On parcours le tableau des enseignements
                  $apprentissage = '';
                  
									foreach($arrayFilieres as $filiere) {
                    if ($filiere['apprentissage'] == 0) $apprentissage = 'Initial'; else $apprentissage = 'Apprentissage';
									?>
										<tr>
                      <td><?php echo $filiere['id_filiere']; ?></td>
											<td><?php echo $filiere['libelle_niveau'].' '.$filiere['libelle_specialite'].' '.$apprentissage; ?></td>
										</tr>
									<?php 
									} 
									?>
								</tbody>
							</table>
						<?php 
						}
						?>
        </div>
				</fieldset>
			</form>
		</div>
	
	</div>
	
</div>