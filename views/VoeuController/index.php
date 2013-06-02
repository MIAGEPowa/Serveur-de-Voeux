<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>Mes v&oelig;ux</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'voeu/index'; ?>" title="">Mes v&oelig;ux</a>
		</div>
		
		<div class="text text-full">
			<h2>Liste de mes v&oelig;ux</h2>
			
			<table>
				 <thead>
					<tr>
						<th width="18%">Filière</th>
						<th width="13%">Enseignement</th>
						<th width="8%" align="center">Année</th>
						<th width="10%" align="center">Nb h cours</th>
						<th width="10%" align="center">Nb h TD</th>
						<th width="10%" align="center">Nb h TP</th>
						<th width="11%">Conflits</th>
						<th width="20%">Actions</th> <!-- Visualiser et Supprimer -->
					</tr>
				</thead>
				<tbody>
				
					<?php 
						foreach($fee as $f) { 
							$voeur_utilisateur_h_cours = round($f['nbr_h_cours'] / 60, 2);
							$voeur_utilisateur_h_td = round($f['nbr_h_td'] / 60, 2);
							$voeur_utilisateur_h_tp = round($f['nbr_h_tp'] / 60, 2);
					?>
						
						<tr>
							<td><?php echo $f['filiere']; ?></td>
							<td><?php echo $f['libelle']; ?></td>
							<td align="center"><?php echo $f['annee']; ?></td>
							<td align="center"><?php echo $voeur_utilisateur_h_cours; ?> h</td>
							<td align="center"><?php echo $voeur_utilisateur_h_td; ?> h</td>
							<td align="center"><?php echo $voeur_utilisateur_h_tp; ?> h</td>
							<td>
								<?php
									if($f['conflits']) {
										// Cours
										if(isset($f['conflits']['cours']) && isset($f['conflits']['cours_conflit'])) {
											if(!$f['conflits']['cours_conflit'])
												echo 'Cours (<strong><span class="orange">- '.round($f['conflits']['cours'] / 60, 2).'</span></strong>)<br />';
											else
												echo 'Cours (<strong><span class="red">+ '.round($f['conflits']['cours'] / 60, 2).'</span></strong>)<br />';
										}
										
										// TD
										if(isset($f['conflits']['td']) && isset($f['conflits']['td_conflit'])) {
											if(!$f['conflits']['td_conflit'])
												echo 'TD (<strong><span class="orange">- '.round($f['conflits']['td'] / 60, 2).'</span></strong>)<br />';
											else
												echo 'TD (<strong><span class="red">+ '.round($f['conflits']['td'] / 60, 2).'</span></strong>)<br />';
										}
										
										// TP
										if(isset($f['conflits']['tp']) && isset($f['conflits']['tp_conflit'])) {
											if(!$f['conflits']['tp_conflit'])
												echo 'TP (<strong><span class="orange">- '.round($f['conflits']['tp'] / 60, 2).'</span></strong>)<br />';
											else
												echo 'TP (<strong><span class="red">+ '.round($f['conflits']['tp'] / 60, 2).'</span></strong>)<br />';
										}
									}
								?>
							</td>
							<td>
								<a class="buttons-link" href="<?php echo WEBROOT; ?>filiereEnseignement/view/<?php echo $f['id_filiere_enseignement']; ?>"><span class="buttons button-green">Visualiser</span></a>
								<a class="buttons-link" href="<?php echo WEBROOT; ?>voeu/index/<?php echo $f['id_filiere_enseignement']; ?>"><span class="buttons button-red">Supprimer</span></a>
							</td>
						</tr>
						
					<?php } ?>
				
				</tbody>
			</table>
		</div>

	</div>
</div>