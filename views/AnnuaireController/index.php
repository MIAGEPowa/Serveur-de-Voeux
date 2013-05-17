<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Annuaire</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="./" title="">Annuaire</a>
		</div>
		
		<div class="text text-full">
			
			<!-- Exporter l'annuaire -->
			<a href="<?php echo WEBROOT.'annuaire/exporter'; ?>" title="Exporter de l'annuaire" target="_blank"><span class="buttons button-blue" style="float: right;">Exporter</span></a>
			<div class="clear"></div>
			
			<table>
				 <thead>
					<tr>
						<th width="15%">Photo</th>
						<th width="21%">Nom</th>
						<th width="21%">Email</th>
						<th width="23%">Rôle</th>
						<th width="10%">CV</th>
						<th width="10%">Actions</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						
						foreach($utilisateurs as $u) {
							
							if($u['civilite'])
								$civ = 'M.';
							else
								$civ = 'Mme';
								
							// On affiche la photo que si l'utilisateur en a une
							if(file_exists(ROOT.'files/avatar/'.$u['id'].'.png'))
								$photo = $u['id'].'.png';
							else if(file_exists(ROOT.'files/avatar/'.$u['id'].'.jpg'))
								$photo = $u['id'].'.jpg';
							else if(file_exists(ROOT.'files/avatar/'.$u['id'].'.gif'))
								$photo = $u['id'].'.gif';
							else
								$photo = 'default.jpg';
							
							echo '	<tr>
										<td><img src="'.WEBROOT.'files/avatar/'.$photo.'" alt="'.$civ.' '.$u['prenom'].' '.$u['nom'].'" title="'.$civ.' '.$u['prenom'].' '.$u['nom'].'" width="45" height="45" /></td>
										<td><a href="'.WEBROOT.'annuaire/visualiser/'.$u['id'].'" title="'.$civ.' '.$u['prenom'].' '.$u['nom'].'">'.$civ.' '.$u['prenom'].' '.$u['nom'].'</a></td>
										<td>'.$u['email'].'</td>
										<td>Directeur du département</td>';
										
							// On affiche le CV de l'utilisateur que s'il en a un
							if(file_exists(ROOT.'files/cv/'.$u['id'].'.pdf'))
								echo '<td><a href="'.WEBROOT.'files/cv/'.$u['id'].'.pdf" title="CV" target="_blank"><span class="buttons button-grey">CV</span></a></td>';
							else
								echo '<td></td>';
							
							echo '
										<td><span class="buttons button-green">Visualiser</span></td>
									</tr>';							
							
						}
					?>
					
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>