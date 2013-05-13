<!DOCTYPE HTML>
<html>
	<head>
		<title>Projet SMED - <?php echo $v_titreHTML; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo CSS_DIR; ?>style.css" type="text/css" />
	</head>
	
	<body>
		<div id="overlay" <?php if($v_errors || $v_success) echo 'style="display: block;"'; else echo 'style="display: none;"'; ?>>
			<div id="overlaySuccess" class="overlayBlock" <?php if($v_success) echo 'style="display: block;"'; else echo 'style="display: none;"'; ?>>
				<span class="overlayTtile"><span class="overlayIcon icon-ok"></span>Succès !</span>
				<p><?php echo $v_success; ?></p>
				<span class="overlayClose icon-close"></span>
			</div>
			<div id="overlayError" class="overlayBlock" <?php if($v_errors) echo 'style="display: block;"'; else echo 'style="display: none;"'; ?>>
				<span class="overlayTtile"><span class="overlayIcon icon-error"></span>Erreur !</span>
				<p><?php echo $v_errors; ?></p>
				<span class="overlayClose icon-close"></span>
			</div>
		</div>

		<div id="header">
			<h1><a href="<?php echo WEBROOT; ?>" title="Projet SMED">Projet SMED</a></h1>
			<?php 
				if($_SESSION['v_connected']) {
				?>
					<div id="userAccount">
						<a href="<?php echo WEBROOT.'utilisateur/moncompte'; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>"><img src="<?php echo IMG_DIR.'utilisateurs/kevin.jpg'; ?>" alt="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>" /></a>
						<div>
							<a href="<?php echo WEBROOT.'utilisateur/moncompte'; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>">Bonjour, <?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?></a>
						</div>
					</div>
				<?php
				}
			?>
		</div>
		
		<?php echo $content_for_layout; ?>
		
		<!-- JavaScript -->
		<?php foreach($this->v_JS as $js): ?>
		<script src="<?php echo JS_DIR.$js; ?>.js" type="text/javascript" defer="defer"></script>
		<?php endforeach; ?>
		
	</body>
</html>

