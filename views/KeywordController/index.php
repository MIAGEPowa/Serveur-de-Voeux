<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Recherche</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'keyword/index'; ?>" title="">Recherche</a>
		</div>
		
		<div class="text text-full">
			<form id="form-search-keyword" action="#" method="post">
				<fieldset>
					<legend><span class="icon-search"></span>Recherche par mots clés</legend>
						<div class="form-item">
							<label for="intitule">Mot clé</label>
							<input type="text" id="intitule" name="intitule" value="" class="input-large" />
						</div>
						
						<div class="form-item">
							<input type="submit" name="keyword_form_search" class="input-submit input-submit-blue" value="Rechercher" />
						</div>
				</fieldset>
			</form>
		</div>
		
		<div class="text text-two">
			<div class="text-two-item text-two-item-first">
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
									<td><a href="<?php echo WEBROOT; ?>enseignement/view/<?php echo $enseignement['id']; ?>" title="<?php echo $enseignement['libelle']; ?>"><?php echo $enseignement['libelle']; ?></a></td>
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
			<div class="text-two-item">
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
									<td><a title="<?php echo $civilite.' '.$utilisateur['prenom'].' '.$utilisateur['nom'];?>" href="<?php echo WEBROOT.'annuaire/visualiser/'.$utilisateur['id'];?>"><?php echo $civilite.' '.$utilisateur['prenom'].' '.$utilisateur['nom']; ?></a></td>
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



<script defer>

$("#intitule").autocomplete({

	source: <?php echo json_encode($arrayLibKeywords); ?>

});

</script>