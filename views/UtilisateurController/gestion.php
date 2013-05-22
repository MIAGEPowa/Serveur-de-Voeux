<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Utilisateurs</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="./" title="">Utilisateurs</a>
		</div>
		
		<div class="text text-full">
			
			<table>
				 <thead>
					<tr>
						<th width="15%">Photo</th>
						<th width="21%">Nom</th>
						<th width="21%">Email</th>
						<th width="23%">Rôle</th>
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
							
							echo '<td>';
                echo '<a class="buttons-link" href="'.WEBROOT.'annuaire/visualiser/'.$u['id'].'"><span class="buttons button-green">Visualiser</span></a>';
                echo '<a class="buttons-link" href=""><span class="buttons button-orange">Rôle</span></a>';
                if ($u['actif'] == 1)
                  echo '<a class="buttons-link" href="'.WEBROOT.'utilisateur/updateEtat/'.$u['id'].'/0"><span class="buttons button-blue">Désactiver</span></a>';
                else 
                  echo '<a class="buttons-link" href="'.WEBROOT.'utilisateur/updateEtat/'.$u['id'].'/1"><span class="buttons button-blue">Activer</span></a>';
              echo '</td>';
              echo '</td>';
							echo '</tr>';							
							
						}
					?>
					
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>