<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
	
		<div id="contentTitle">
			<h2>V&oelig;ux</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'voeu/index'; ?>" title="">V&oelig;ux</a>
		</div>
		
		<div class="text text-two">
      <?php 
      $f_id = '';
      $f_libelle = '';
      $f_num = 0;
      $f_bool = false;
      $apprentissage = '';
      
      foreach ($filiereEnseignement as $f) { 
        
        if (($f_id == '') || ($f_id != $f['id_filiere'])) {
          $f_id = $f['id_filiere'];
          if ($f['apprentissage'] == 1) $apprentissage = 'Apprentissage'; else $apprentissage = 'Initial';
          $f_libelle = $f['libelle_niveau'].' '.$f['libelle_specialite'].' '.$apprentissage;
          $f_bool = true;
        }
        
        if ($f_bool == true) {
          if ($f_num != 0) {
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
          }
          if ($f_num % 2 == 0)
            echo '<div class="text-two-item text-two-item-first">';
          else
            echo '<div class="text-two-item">';
          echo '<h2>'.$f_libelle.'</h2>';
          echo '<table>
                  <thead>
                    <tr>
                      <th width="10%";>#</th>
                      <th width="30%";>Enseignement</th>
                      <th width="15%";>Année</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>';    
        }
          
          echo '<tr>';
            echo '<td>'.$f['id_filiere_enseignement'].'</td>';
            echo '<td>'.$f['libelle_enseignement'].'</td>';
            echo '<td>'.$f['annee'].'</td>';
            echo '<td>';
              echo '<a class="buttons-link" href='.WEBROOT.'filiereEnseignement/view/'.$f['id_filiere_enseignement'].'><span class="buttons button-green">Visualiser</span></a>';
              echo '<a class="buttons-link" href='.WEBROOT.'voeu/update/"'.$f['id_filiere_enseignement'].'><span class="buttons button-orange">Réaliser un voeu</span></a>';
            echo '</td>';
          echo '</tr>';
          
        if ($f_bool == true)
          $f_bool = false;
        
        $f_num = $f_num + 1;
      } ?>
		</div>

		
	</div>
</div>