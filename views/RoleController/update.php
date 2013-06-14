<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">

		<div id="contentTitle">
			<h2>Rôles</h2>
		</div>

		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'role/index';?>" title="">Rôles</a><span class="delimiter">></span>Modification d'un rôle
		</div>

		<div class="text text-full">
			<form id="form-update-role" action="#" method="post">
				<fieldset>
					<legend class="button-slide"><span class="icon-roles"></span>Modifier un rôle<span class="icon-arrow"></span></legend>
						
						<?php
						switch ($role[0]['droits']) {
							case 1:
						?>
							<div class="form-item">
								<label for="a_droits">Droits</label>
								<span>Secrétaire</span>
								<input type="hidden" name="role_libelle" value="Secrétaire"/>
							</div>
							
							<div class="form-item">
								<label for="s_filiere">Filiere</label>
								<select name="role_filiere">
									<?php
										foreach($arrayFilieres as $f) {
											if ($role[0]['id_filiere'] == $f['id'])
												echo '<option value="'.$f['id'].'" selected="selected">'.$f['name'].'</option>';
											else
												echo '<option value="'.$f['id'].'">'.$f['name'].'</option>';
										}
									?>
								</select>
							</div>
						<?php
								break;
							case 2:
						?>
							<div class="form-item">
								<label for="a_droits">Droits</label>
								<span>Enseignant</span>
							</div>
							
							<div class="form-item">
								<label for="a_libelle">Libellé</label>
								<input type="text" id="a_libelle" name="role_libelle" value="<?php echo $role[0]['libelle'];?>" class="input-large" />
							</div>
							
							<div class="form-item">
								<label for="e_quota_heures">Quota heures</label>
								<input type="text" id="e_quota_heures" name="role_quota_h" value="<?php echo $role[0]['quota_h'];?>" class="input-little" />
							</div>
							
							<div class="form-item">
								<label for="e_coeff_cours">1h de cours équivaut à</label>
								<input type="text" id="e_coeff_cours" name="role_coeff_cours" value="<?php echo $role[0]['coeff_cours'];?>" class="decimal input-little" />
								h de TD
							</div>
							
							<div class="form-item">
								<label for="e_coeff_tp">1h de TP équivaut à</label>
								<input type="text" id="e_coeff_tp" name="role_coeff_tp" value="<?php echo $role[0]['coeff_tp'];?>" class="decimal input-little" />
								h de TD
							</div>
						<?php
								break;
							case 3:
						?>
							<div class="form-item">
								<label for="a_droits">Droits</label>
								<span>Responsable</span>
							</div>
							
							<div class="form-item">
								<label class="label-top">Adjoint ?</label>
								<input type="radio" name="role_adjoint" value="0" <?php if (!$role[0]['adjoint']) echo 'checked="checked"';?>/>Non
								<input type="radio" name="role_adjoint" value="1" <?php if ($role[0]['adjoint']) echo 'checked="checked"';?>/>Oui
							</div>
							
							<div class="form-item">
								<label for="r_droits">Responsabilités</label>
								<select name="r_droits" id="r_droits">
									<option value="1">Filière</option>
									<option value="2">Diplôme</option>
								</select>
							</div>
							
							<div id="r-div-1" class="r-div-droits" <?php if ($role[0]['id_filiere'] == 0) echo 'style="display: none;"';?>>
								<div class="form-item">
									<label for="r_filiere">Filiere</label>
									<select name="role_filiere" id="s_filiere" <?php if ($role[0]['id_filiere'] == 0) echo 'disabled="disabled"';?>>
										<?php
											foreach($arrayFilieres as $f) {
												if ($role[0]['id_filiere'] == $f['id'])
													echo '<option value="'.$f['id'].'" selected="selected">'.$f['name'].'</option>';
												else
													echo '<option value="'.$f['id'].'">'.$f['name'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							
							<div id="r-div-2" class="r-div-droits" <?php if ($role[0]['id_diplome'] == 0) echo 'style="display: none;"';?>>
								<div class="form-item">
									<label for="r_diplome">Diplome</label>
									<select name="role_diplome" id="r_diplome" <?php if ($role[0]['id_diplome'] == 0) echo 'disabled="disabled"';?>>
										<?php
											foreach($diplomes as $d) {
												if ($role[0]['id_diplome'] == $d['id'])
													echo '<option value="'.$d['id'].'" selected="selected">'.$d['libelle'].'</option>';
												else
													echo '<option value="'.$d['id'].'">'.$d['libelle'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
						<?php
								break;
							case 4:
						?>
							<div class="form-item">
								<label for="a_droits">Droits</label>
								<span>Administrateur</span>
							</div>
							
							<div class="form-item">
								<label for="a_libelle">Libellé</label>
								<input type="text" id="a_libelle" name="role_libelle" value="<?php echo $role[0]['libelle'];?>" class="input-large" />
							</div>
						<?php
								break;
						}
						?>			

						<div class="form-item">
							<input name="role_submit_update" type="submit" class="input-submit input-submit-orange" value="Modifier" />
						</div>
				</fieldset>
			</form>
		</div>
		
	</div>

</div>