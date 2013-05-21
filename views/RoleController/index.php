<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">

		<div id="contentTitle">
			<h2>Rôles</h2>
		</div>


		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'role/index';?>" title="">Rôles</a>
		</div>

		<div class="text text-full">
			<form id="form-create-degree" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-roles"></span>Ajouter un rôle<span class="icon-arrow"></span></legend>
					<div style="display:none">
						
						<div class="form-item">
							<label for="droits">Droits *</label>
							<select name="droits" id="droits">
								<option value="1">Secrétaire</option>
								<option value="2">Enseignant</option>
								<option value="3">Responsable</option>
								<option value="4">Administrateur</option>
							</select>
							<span class="form-description">
								Sélectionnez le niveau de droits que le nouveau rôle possèdera.
							</span>
						</div>
						
						<!-- Secrétaire -->
						<div id="div-1" class="div-droits">
							<div class="form-item">
								<label for="s_libelle">Libellé *</label>
								<input type="text" id="s_libelle" name="s_libelle" value="" class="input-large" />
							</div>
							<span class="form-description">
								Inscrivez dans ce champ le libellé souhaitez pour le nouveau rôle.
							</span>
						</div>
						
						<!-- Enseignant -->
						<div id="div-2" class="div-droits" style="display: none;">
							<div class="form-item">
								<label for="e_libelle">Libellé *</label>
								<input type="text" id="e_libelle" name="e_libelle" value="" class="input-large" />
							</div>
							<span class="form-description">
								Inscrivez dans ce champ le libellé souhaitez pour le nouveau rôle.
							</span>
							
							<div class="form-item">
								<label for="e_quota_heures">Quota heures *</label>
								<input type="text" id="e_quota_heures" name="e_quota_heures" value="" class="input-little" />
							</div>
							<span class="form-description">
								Veuillez préciser le nombre d'heures que doit effectuer le nouveau rôle d'enseignant.
							</span>
						</div>
						
						<!-- Responsable -->
						<div id="div-3" class="div-droits" style="display: none;">
							<div class="form-item">
								<label class="label-top">Adjoint ?</label>
								<input type="radio" name="r_adjoint" value="0" />Non
								<input type="radio" name="r_adjoint" value="1" checked="checked" />Oui
							</div>
						
							<div class="form-item">
								<label for="r_droits">Responsabilités *</label>
								<select name="r_droits" id="r_droits">
									<option value="1">Filière</option>
									<option value="2">Diplôme</option>
								</select>
								<span class="form-description">
									Sélectionnez le type de responsablités que le nouveau rôle possèdera.
								</span>
							</div>
							
							<div id="r-div-1" class="r-div-droits">
								<div class="form-item">
									<label for="r_filiere">Filiere *</label>
									<select name="r_filiere" id="r_filiere">
										<?php
											foreach($arrayFilieres as $f) {
												echo '<option value="'.$f['id'].'">'.$f['name'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							
							<div id="r-div-2" class="r-div-droits" style="display: none;">
								<div class="form-item">
									<label for="r_diplome">Diplome *</label>
									<select name="r_diplome" id="r_diplome">
										<?php
											foreach($diplomes as $d) {
												echo '<option value="'.$d['id'].'">'.$d['libelle'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
						
						<!-- Administrateur -->
						<div id="div-4" class="div-droits" style="display: none;">
							<div class="form-item">
								<label for="a_libelle">Libellé *</label>
								<input type="text" id="a_libelle" name="a_libelle" value="" class="input-large" />
							</div>
							<span class="form-description">
								Inscrivez dans ce champ le libellé souhaitez pour le nouveau rôle.
							</span>
						</div>
						
						<div class="form-item">
							<input name="role_submit_add" type="submit" class="input-submit input-submit-green" value="Enregistrer" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>

		<div class="text text-full">
		
			<table>
				<thead>
					<tr>
						<th width="55%">Libellé</th>
						<th width="45%">Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						
						foreach($roles as $r) {
							
							echo '	<tr>
										<td>'.$r['libelle'].'</td>
										<td></td>
									</tr>';
							
						}
						
					?>
					
				</tbody>
			</table>
			
		</div>
		
	</div>

</div>