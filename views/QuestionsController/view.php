<div id="main">

	<!-- Colonne -->
	<?php include(LAYOUT_DIR.'sidebar.php'); ?>
	
	<div id="content">
		<div id="contentTitle">
			<h2><?php echo $v_titreHTML; ?></h2>
		</div>
		
		<div id="breadcrumb" class="text">
			<a href="./" title="">Tableau de bord</a><span class="delimiter">></span>Page à la con
		</div>
		
		<div class="text text-full">
		
			<h1><?php echo $questions['intitule']; ?></h1>
			<?php echo $questions['reponse']; ?>
		
		</div>
	</div>
</div>
