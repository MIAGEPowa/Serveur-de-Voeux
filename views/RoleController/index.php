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
					<div style="display: none;">
						
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
								<label for="s_filiere">Filiere *</label>
								<select name="s_filiere" id="s_filiere">
									<?php
										foreach($arrayFilieres as $f) {
											echo '<option value="'.$f['id'].'">'.$f['name'].'</option>';
										}
									?>
								</select>
							</div>
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
							
							<div class="form-item">
								<label for="e_coeff_cours">1h de cours équivaut à *</label>
								<input type="text" id="e_coeff_cours" name="e_coeff_cours" value="" class="decimal input-little" />
								h de TD
							</div>
							<span class="form-description">
								Veuillez préciser le coefficient qui permet de valoriser une heure de cours en équivalent TD.<br />
								(Exemple : 1h de cours = 1,5h de TD, donc 1.5 de coefficient)
							</span>
							
							<div class="form-item">
								<label for="e_coeff_tp">1h de TP équivaut à *</label>
								<input type="text" id="e_coeff_tp" name="e_coeff_tp" value="" class="decimal input-little" />
								h de TD
							</div>
							<span class="form-description">
								Veuillez préciser le coefficient qui permet de valoriser une heure de TP en équivalent TD.<br />
								(Exemple : 1h de TP = 2h de TD, donc 2 de coefficient)
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
			<h2>Liste des rôles</h2>
			
			<table>
				<thead>
					<tr>
						<th width="45%">Libellé</th>
						<th width="15%">Role d'enseignant</th>
						<th width="15%">Droits</th>
						<th width="15%">Utilisateurs</th>
						<th width="10%">Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						
						foreach($roles as $r) {
							
							// Role d'enseignant
							if($r['role_enseignant'])
								$re = '<img src="'.IMG_DIR.'y.png" title="Icône oui" />';
							else
								$re = '<img src="'.IMG_DIR.'n.png" title="Icône non" />';
								
							// Droits
							if($r['droits'] == 1)
								$role_txt = 'Secrétaire';
							else if($r['droits'] == 2)
								$role_txt = 'Enseignant';
							else if($r['droits'] == 3)
								$role_txt = 'Responsable';
							else if($r['droits'] == 4)
								$role_txt = 'Administrateur';
								
							echo '<tr>
										<td>'.$r['libelle'].'</td>
										<td>'.$re.'</td>
										<td>'.$role_txt.'</td>
										<td>'.$r['utilisateurs'].'</td>
										<td>'; 
							if ($r['libelle'] == 'Responsable de cours') echo ''; else echo '<a class="buttons-link" href="'.WEBROOT.'role/index/'.$r['id'].'" title="Supprimer"><span class="buttons button-red">Supprimer</span></a>';
							echo '</td></tr>';
						}
						
					?>
					
				</tbody>
			</table>
			
		</div>
		
	</div>

</div>