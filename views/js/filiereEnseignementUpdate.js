$(document).ready(function() {
	//
	// v�rifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-update-filiereEnseignement').submit(function() {
		// date d�but
		if($('#dateDebut').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Date de d�but\"</strong> !");
			return false;
		}
		
		// On v�rifie si au moins un des 6 est remplis
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
	
});