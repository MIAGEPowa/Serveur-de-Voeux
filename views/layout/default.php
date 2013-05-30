<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo PAGE_TITLE; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo CSS_DIR; ?>style.css" type="text/css" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
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
			<h1><a href="<?php echo WEBROOT; ?>" title="<?php echo PAGE_TITLE; ?>"><?php echo PAGE_TITLE; ?></a></h1>
			<?php 
				if($_SESSION['v_connected']) {
					if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.png'))
						$photo = $_SESSION['v_id_utilisateur'].'.png';
					else if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.jpg'))
						$photo = $_SESSION['v_id_utilisateur'].'.jpg';
					else if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.gif'))
						$photo = $_SESSION['v_id_utilisateur'].'.gif';
					else
						$photo = 'default.jpg';
				
					if($_SESSION['v_droits'] >= 4) {
				?>
						<div id="configuration">
							<div id="linkConfiguration">
								<a href="<?php echo WEBROOT.'configuration/index'; ?>" title="Configuration"><img src="<?php echo IMG_DIR; ?>configuration.png" title="Configuration" alt="Icône configuration" /></a>
							</div>
						</div>
				<?php
				
					}
				?>					
					<div id="userAccount">
						<a href="<?php echo WEBROOT.'utilisateur/moncompte'; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>"><img src="<?php echo WEBROOT.'files/avatar/'.$photo; ?>" alt="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>" /></a>
						<div>
							<a href="<?php echo WEBROOT.'utilisateur/moncompte'; ?>" title="<?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?>">Bonjour, <?php echo $_SESSION['v_prenom'].' '.$_SESSION['v_nom']; ?></a>
						</div>
					</div>
				<?php
				}
			?>
		</div>
		
		<!-- JavaScript -->
		<script src="<?php echo JS_DIR.'jquery-1.9.1.min'; ?>.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="<?php echo JS_DIR.'jquery.dataTables.min'; ?>.js" type="text/javascript"></script>
		<?php 
		if($this->v_JS) {
		foreach($this->v_JS as $js): 
		?>
			<script src="<?php echo JS_DIR.$js; ?>.js" type="text/javascript" defer="defer"></script>
		<?php 
		endforeach; 
		}?>
		<script src="<?php echo JS_DIR.'tools'; ?>.js" type="text/javascript" defer="defer"></script>
		
		<!-- Calendrier -->
		<script>
		$(function() {
			$( ".date" ).datepicker({
				buttonImageOnly: true,
				changeMonth: false,
				changeYear: false,
				dateFormat: 'dd/mm/yy',
				nextText: 'Suivant',
				prevText: 'Précédent',
				showOtherMonths: true,
				firstDay: 1,
				weekHeader: 'Sem.',
				showAnim: 'fadeIn',
				dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
				dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
				monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
				monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jui','Juil','Aoû','Sep','Oct','Nov','Déc']
			});
		});
		</script>
		
		<?php echo $content_for_layout; ?>
		
	</body>
</html>
