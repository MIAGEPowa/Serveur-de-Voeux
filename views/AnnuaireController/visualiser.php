<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Annuaire</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'annuaire/index';?>" title="">Annuaire</a><span class="delimiter">></span>Visualiser
		</div>
		
		<div class="text text-full">
			
      <?php
      if(file_exists(ROOT.'files/cv/'.$utilisateur[0]['id'].'.pdf')) {
          echo '<a href="'.WEBROOT.'files/cv/'.$utilisateur[0]['id'].'.pdf" title="CV" target="_blank">';
          echo '<span class="buttons button-blue" style="float: right;">Télécharger CV</span>';
          echo '</a>';
          echo '<div class="clear"></div>';
        }
        else
          echo '</span>';
      ?>
			<fieldset>
        <legend><span class="icon-user"></span>Profil de <?php if($utilisateur[0]['civilite']) echo 'M. '; else echo 'Mme '; echo $utilisateur[0]['nom'].' '. $utilisateur[0]['prenom'];?></legend>
				
        <?php
          
          if(file_exists(ROOT.'files/avatar/'.$utilisateur[0]['id'].'.png'))
            $photo = $utilisateur[0]['id'].'.png';
          else if(file_exists(ROOT.'files/avatar/'.$utilisateur[0]['id'].'.jpg'))
            $photo = $utilisateur[0]['id'].'.jpg';
          else if(file_exists(ROOT.'files/avatar/'.$utilisateur[0]['id'].'.gif'))
            $photo = $utilisateur[0]['id'].'.gif';
          else
            $photo = 'default.jpg';
        ?>
        
        <img src="<?php echo WEBROOT.'files/avatar/'.$photo; ?>" alt="<?php echo $utilisateur[0]['prenom'].' '.$utilisateur[0]['nom']; ?>" title="<?php echo $utilisateur[0]['prenom'].' '.$utilisateur[0]['nom']; ?>" width="115" height="115" style="margin: 20px 0 0 0" />
        
        <div class="form-item">
					<label class="blue">Email</label> 
          <span><?php echo $utilisateur[0]['email'];?></span>
        </div>

				<div class="form-item" >
					<label class="blue">Biographie</label>
          <span style="text-align: justify; display: inline-block; width: 70%; vertical-align: top;"><?php echo $utilisateur[0]['biographie'];?></span>
				</div>

        <div class="form-item">
          <label class="blue">Badge</label>
					<span><?php echo $utilisateur[0]['badge'];?></span>
				</div>

				<div id="list-keywords" class="form-item">
					<label class="blue">Mots clés</label>
					<?php
						// s'il existe des keywords
						if(count($arrayKeywords) != 0) {
							// On parcours le tableau des enseignements
							for ($i = 0; $i < count($arrayKeywords); $i++) {
                if ($i == 0)
                  echo $arrayKeywords[$i]['keyword'];
                else 
                  echo ", ".$arrayKeywords[$i]['keyword'];
              } 
						}
            ?>
        </div>
        
        <div class="form-item">
          <label class="blue">Délégations</label>
          <?php 
          if (isset($utilisateur[0]['nbr_h_delegation']) && (!empty($utilisateur[0]['nbr_h_delegation'])) && (isset($utilisateur[0]['description_delegation'])) && (!empty($utilisateur[0]['description_delegation']))) 
          {
          ?>
          <table class='form-table table-white'>
						<thead>
							<tr>
								<th width="22%">Heures</th>
                <th width="22%">Description</th>
                <th width="22%"></th>
							</tr>
						</thead>
						<tbody>
              <tr>
                <td><?php echo $utilisateur[0]['nbr_h_delegation'];?></td>
                <td><?php echo $utilisateur[0]['description_delegation'];?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
          <?php
          }
          ?>
        </div>
        
        <div class="form-item">
          <label class="blue">Enseignements</label>
          <?php
						// s'il existe des enseignements
						if(count($arrayDegrees) != 0) {
						?>
							<table class='form-table table-white'>
								<thead>
									<tr>
										<th width="22%">#</th>
                    <th width="22%">Intitulé</th>
                    <th width="22%">Description</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// On parcours le tableau des enseignements
									foreach($arrayDegrees as $degree) {
									?>
										<tr>
                      <td><?php echo $degree['id']; ?></td>
											<td><?php echo $degree['libelle']; ?></td>
                      <td><?php echo $degree['description']; ?></td>
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

				</fieldset>
			</form>
		</div>
	
	</div>
	
</div>