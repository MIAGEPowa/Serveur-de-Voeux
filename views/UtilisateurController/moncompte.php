<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Mon compte</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="" title="Mon compte">Mon compte</a>
		</div>
		
		<div class="text text-full">
			<!-- Se déconnecter -->
			<a href="<?php echo WEBROOT.'authentification/deconnexion/'; ?>" title="Se déconnecter"><span class="buttons button-red" style="float: right;">Se déconnecter</span></a>
			<div class="clear"></div>
			
			<form id="form-update-profile" action="" method="POST" enctype="multipart/form-data">
				 <fieldset>
					<legend><span class="icon-user"></span>Modifier les informations de mon compte</legend>
					<div class="form-item">
						<label for="email">Email*</label>
						<input id="email" type="text" name="email" value="<?php echo $email; ?>" class="input-large" />
					</div>
					<span class="form-description">Vous pouvez modifier votre email via ce champ. Attention cela modifiera votre login de connexion.</span>
					
					<div class="form-item">
						<label for="password">Mot de passe</label>
						<input type="password" name="password" class="input-large" />
					</div>
					<span class="form-description">Attention, ne modifiez ce champ uniquement si vous souhaitez changer votre mot de passe.</span>					
					
					<div class="form-item">
						<label class="label-top" for="biographie">Biographie</label>
						<textarea name="biographie"><?php echo $biographie; ?></textarea>
					</div>
					<span class="form-description">Décrivez-vous dans ce champ libre.</span>
					
					<div class="form-item">
						<label for="badge">Badge</label>
						<input type="text" name="badge" value="<?php echo $badge; ?>" class="input-medium" />
					</div>
					<span class="form-description">Renseignez ce champ uniquement si vous possédez un badge d'accès aux salles informatiques.</span>
					
					<div class="form-item">
						<label for="keyword">Ajouter un mot clé</label>
						<input type="text" id="keyword" name="keyword" value="" class="input-medium" />
						<span id="add-keyword" class="buttons button-blue">Ajouter</span>
					</div>
					<span class="form-description">Ce mot clé s'ajoutera à la liste de vos mots clés. Il faudra enregistrer pour prendre en compte vos modifications.</span>
					
					<div id="list-keywords" class="form-item">
						<label for="keyword">Liste des mots clés</label>
						<?php
						// s'il existe des keywords
						if(count($arrayKeywords) != 0) {
						?>
							<table class='form-table'>
								<thead>
									<tr>
										<th width="22%">Intitulé</th>
										<th width="22%">Actions</th>
										<th width="22%"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									// On parcours le tableau des enseignements
									foreach($arrayKeywords as $keyword) {
									?>
										<tr>
											<td class="value-keyword" data-id-key="<?php echo $keyword['id'] ?>"><?php echo $keyword['keyword']; ?></td>
											<td>
												<a class="buttons-link" onclick="deleteRow($(this))"><span class="buttons button-red">Supprimer</span></a>
											</td>
											<td></td>
										</tr>
									<?php 
									} 
									?>
								</tbody>
							</table>
							<span style="display:none">Aucun mot clé...</span>
						<?php 
						} else {
						?>
							<span>Aucun mot clé...</span>
						<?php
						}
						?>
					</div>
					
					<div class="form-item">
						<label for="cv">CV</label>
						<input type="file" name="cv" class="input-large" />
					</div>
					<span class="form-description">Vous pouvez ici télécharger votre CV au format PDF.
					
					<?php
						
						if(file_exists(ROOT.'files/cv/'.$_SESSION['v_id_utilisateur'].'.pdf'))
							echo '<br /><a href="'.WEBROOT.'files/cv/'.$_SESSION['v_id_utilisateur'].'.pdf" title="Votre CV" target="_blank">Votre CV.</a></span>';
						else
							echo '</span>';
					
					?>
					
					<div class="form-item">
						<label for="photo">Photo</label>
						<input type="file" name="photo" class="input-large" />
					</div>
					<span class="form-description">Pour un affichage optimal, l'image doit être carrée (exemple : 50x50). Seuls les formats de fichiers suivants sont acceptés : PNG, GIF et JPG.</span>
					
					<?php
						if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.png'))
							$photo = $_SESSION['v_id_utilisateur'].'.png';
						else if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.jpg'))
							$photo = $_SESSION['v_id_utilisateur'].'.jpg';
						else if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.gif'))
							$photo = $_SESSION['v_id_utilisateur'].'.gif';
						else
							$photo = 'default.jpg';
					?>
					
					<img src="<?php echo WEBROOT.'files/avatar/'.$photo; ?>" alt="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>" width="115" height="115" style="margin: 20px 0 0 165px;" />
					
					<div class="form-item">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
						<input name="utilisateur_form_moncompte" type="submit" value="Enregistrer" class="input-submit input-submit-blue">
					</div>
				</fieldset>
			</form>
		</div>
	
	</div>
	
</div>