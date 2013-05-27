<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>
	
	<div id="content">
		<div id="contentTitle">
			<h2><?php echo $v_titreHTML; ?></h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="./" title="Tableau de bord">Tableau de bord</a>
		</div>
		
		<div class="text text-three">
		
			<div class="text-three-item">
				<h2>Enseignements</h2>			

				<?php
				if(count($arrayEnseignements) == 0) {
				?>
					<p>
						Pas de correspondance avec la recherche...
					</p>
				<?php
				} else {
				?>
					<table>
						 <thead>
							<tr>
								<th width="12%">#</th>
								<th width="22%">Intitulé</th>
								<th width="22%">Mot clé</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// On parcours le tableau des enseignements
							foreach($arrayEnseignements as $enseignement) {
							?>
								
								<tr>
									<td><?php echo $enseignement['id']; ?></td>
									<td><?php echo $enseignement['libelle']; ?></td>
									<td><?php echo $enseignement['keyword']; ?></td>
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
			
			
			<div class="text-three-item">
				<h2>Enseignements</h2>			

				<?php
				if(count($arrayEnseignements) == 0) {
				?>
					<p>
						Pas de correspondance avec la recherche...
					</p>
				<?php
				} else {
				?>
					<table>
						 <thead>
							<tr>
								<th width="12%">#</th>
								<th width="22%">Intitulé</th>
								<th width="22%">Mot clé</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// On parcours le tableau des enseignements
							foreach($arrayEnseignements as $enseignement) {
							?>
								
								<tr>
									<td><?php echo $enseignement['id']; ?></td>
									<td><?php echo $enseignement['libelle']; ?></td>
									<td><?php echo $enseignement['keyword']; ?></td>
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
			
			<div class="text-three-item text-three-item-last">
				<h2>Utilisateurs</h2>			

				<?php
				if(count($arrayUtilisateurs) == 0) {
				?>
					<p>
						Pas de correspondance avec la recherche...
					</p>
				<?php
				} else {
				?>
					<table>
						 <thead>
							<tr>
								<th width="12%">#</th>
								<th width="22%">Nom</th>
								<th width="22%">Mot clé</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// On parcours le tableau des utilisateurs
							foreach($arrayUtilisateurs as $utilisateur) {
								if($utilisateur['civilite'] == 1)
									$civilite = "M";
								else
									$civilite = "Mme";
							?>
								
								<tr>
									<td><?php echo $utilisateur['id']; ?></td>
									<td><?php echo $civilite.' '.$utilisateur['prenom'].' '.$utilisateur['nom']; ?></td>
									<td><?php echo $utilisateur['keyword']; ?></td>
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
		</div>
	</div>
</div>