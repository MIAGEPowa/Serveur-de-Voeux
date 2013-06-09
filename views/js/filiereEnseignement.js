$(document).ready(function() {
	
	// Animation des barres de progressions
	$(".progressionMin").each(function(i) {
		var width = $(this).width();
		$(this).width(0).animate({"width": width}, 2000);
	});
	
	// Contrôle l'affichage des différents modes d'affichages	
	$('#mode-aff-1').click(function () {
		$(this).hide();
		$('#mode-enseignant-2').hide();
		$('#mode-enseignant-1, #mode-aff-2').show();
	});
	
	$('#mode-aff-2').click(function () {
		$(this).hide();
		$('#mode-enseignant-1').hide();
		$('#mode-enseignant-2, #mode-aff-1').show();
	});
	
	
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-create-filiereEnseignement').submit(function() {
		// date début
		if($('#dateDebut').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Date de début\"</strong> !");
			return false;
		}
		
		// On vérifie si au moins un des 6 est remplis
		if($('#heuresCours').val() == "" && $('#heuresTD').val() == "" && $('#heuresTP').val() == "") {
			openOverlayError("Oops ! Vous devez remplir au moins les heures de cours, TD ou TP !");
			return false;
		}
		
		if($('#heuresCours').val() != "" && !$.isNumeric($('#heuresCours').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre d'heures de cours\"</strong> !");
			return false;
		}
		
		if($('#minutesCours').val() != "" && !$.isNumeric($('#minutesCours').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de minutes de Cours\"</strong> !");
			return false;
		}
		
		if($('#heuresTD').val() != "" && !$.isNumeric($('#heuresTD').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre d'heures de TD\"</strong> !");
			return false;
		}
		
		if($('#minutesTD').val() != "" && !$.isNumeric($('#minutesTD').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de minutes de TD\"</strong> !");
			return false;
		}
		
		if($('#groupesCours').val() != "" && !$.isNumeric($('#groupesCours').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de groupes de cours\"</strong> !");
			return false;
		}

		if($('#groupesTD').val() != "" && !$.isNumeric($('#groupesTD').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de groupes de TD\"</strong> !");
			return false;
		}
		
		if($('#heuresTP').val() != "" && !$.isNumeric($('#heuresTP').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre d'heures de TP\"</strong> !");
			return false;
		}
		
		if($('#minutesTP').val() != "" && !$.isNumeric($('#minutesTP').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de minutes de TP\"</strong> !");
			return false;
		}
		
		if($('#groupesTP').val() != "" && !$.isNumeric($('#groupesTP').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de groupes de TP\"</strong> !");
			return false;
		}
		
		return true;
	});
	
	
	$('#filtre-annees').change(function () {
		var url = $(this).val(); // get selected value
		if (url) { // require a URL
			window.location = url; // redirect
		}
		return false;
	});
	
});