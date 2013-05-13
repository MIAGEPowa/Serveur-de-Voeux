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
		
			<?php foreach ($questions as $q): ?>
			<p><a href="<?php echo WEBROOT; ?>questions/view/<?php echo $q['id']; ?>"><?php echo $q['intitule']; ?></a></p>
			<?php endforeach; ?>
		
		</div>
	</div>
</div>