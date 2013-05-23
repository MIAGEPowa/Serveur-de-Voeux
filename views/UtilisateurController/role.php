<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Utilisateurs</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'utilisateur/gestion'; ?>" title="Utilisateurs">Utilisateurs</a><span class="delimiter">></span>Associer un rôle à un utilisateur
		</div>
		
		<div class="text text-two">
			<div class="text-two-item text-two-item-first">
				<form method="post" action="<?php echo WEBROOT.'utilisateur/role/'.$id_utilisateur_role; ?>">
					<fieldset>
						<legend><span class="icon-roles"></span>Associer un rôle</legend>

						<div class="form-item">
							<label for="utilisateur">Utilisateur</label>
							<select name="utilisateur" id="utilisateur">
								<option value=""><?php echo $utilisateur; ?></option>
							</select>
						</div>
						
						<div class="form-item">	
							<label for="ur_role">Rôle</label>
							<select name="ur_role" id="ur_role">
								<?php
									foreach($roles as $r) {
										echo '<option value="'.$r['id'].'">'.$r['libelle'].'</option>';
									}
								?>
							</select>
						</div>
						
						<div id="ur_responsable_cours" class="form-item" style="display: none;">	
							<label for="ur_filiere_enseignement">Filière enseignement</label>
							<select name="ur_filiere_enseignement" id="ur_filiere_enseignement">
								<?php
									foreach($arrayFiliereEnseignement as $fe) {
										echo '<option value="'.$fe['id'].'">'.$fe['filiere'].' - '.$fe['enseignement'].'</option>';
									}
								?>
							</select>
						</div>

						<div class="form-item">
							<input type="submit" name="utilisateur_submit_role" value="Enregistrer" class="input-submit input-submit-green" />
						</div>
					</fieldset>
				</form>
			</div>
			
			<div class="text-two-item">
				
				<table>
					<thead>
						<tr>
							<th width="65%">Libellé</th>
							<th width="35%">Actions</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				
			</div>
		</div>
		
	</div>
	
</div>