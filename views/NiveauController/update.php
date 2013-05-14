<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>

	<div id="content">
		
		<div id="contentTitle">
			<h2>Niveaux</h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="<?php echo WEBROOT.'niveau/index';?>" title="">Niveaux</a><span class="delimiter">></span>Modification d'un niveau
		</div>
		
		<div class="text text-full">
			<form id="form-update-level" action="<?php echo WEBROOT.'niveau/index';?>" method="post">
				<fieldset>
					<legend ><span class="icon-podium"></span>Modifier un niveau</legend>
					<div>
          
            <input type="hidden" id="idLevel" name="idLevel" value="<?php echo $info_level[0]['id'];?>"/>
            
						<div class="form-item">
							<label for="intitule">Intitulé *</label>
							<input type="text" id="intitule" name="intitule" value="<?php echo $info_level[0]['libelle'];?>" class="input-large" />
						</div>
						
						<div class="form-item">
							<label for="description">Diplôme *</label>
							<select id="diplome" name="diplome">
                <?php foreach ($degrees as $d) { ?>
                  <?php if ($d['id'] == $info_level[0]['id_diplome']) { ?>
                    <option selected="selected" value="<?php echo $d['id'];?>"><?php echo $d['libelle'];?></option>
                  <?php } else { ?>
                    <option value="<?php echo $d['id'];?>"><?php echo $d['libelle'];?></option>
                <?php 
                    }
                  }; 
                ?>
              </select>
						</div>
						<div class="form-item">
							<input type="submit" class="input-submit input-submit-orange" value="Modifier" />
						</div>
						
					</div>
				</fieldset>
			</form>
		</div>
		
	</div>
</div>