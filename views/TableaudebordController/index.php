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
		
		<div class="text text-two">
		
			<div class="text-two-item text-two-item-first" style="clear:both">
				<h2>Filière-enseignements avec la même référence</h2>			

				<?php
				if(count($arrayFilieresEnseignementsSameRef) == 0) {
				?>
					<p>
						Il n'y a pas de filière-enseignement avec la même référence
					</p>
				<?php
				} else {
				?>
					<table class="no-search">
						 <thead>
							<tr>
								<th width="60%">Filière - Enseignement</th>
								<th width="20%">Réf</th>
								<th width="20%">Réf</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// On parcours le tableau des enseignements
							foreach($arrayFilieresEnseignementsSameRef as $key/*=ref*/ => $arrayFilieresEnseignements) {
							?>
								
								<tr>
									<td>
										<?php
											$i = 0;
											foreach($arrayFilieresEnseignements as $fe) {
												if($i != 0) {echo '<br/>';}
												$apprentissage = ($fe['apprentissage'] == 0) ? "initial" : "apprentissage";
												echo $fe['libelle_niveau'].' '.$fe['libelle_specialite'].' '.$apprentissage.' - '.$fe['libelle_enseignement'];
												$i++;
											}
										?>
									</td>
									<td><strong><?php echo $key; ?></strong></td>
									<td>
										<a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/index/0/<?php echo $key ?>"><span class="buttons button-orange">Modifier</span></a>
									</td>
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