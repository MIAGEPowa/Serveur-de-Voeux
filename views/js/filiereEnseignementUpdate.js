$(document).ready(function() {
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-update-filiereEnseignement').submit(function() {
		// date début
		if($('#dateDebut').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Date de début\"</strong> !");
			return false;
		}
		// nombre heures cours
		if($('#heuresCours').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Nombre d'heures de cours\"</strong> !");
			return false;
		}
		if(!$.isNumeric($('#heuresCours').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre d'heures de cours\"</strong> !");
			return false;
		}
		// nombre heures de TD
		if($('#heuresTD').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Nombre d'heures de TD\"</strong> !");
			return false;
		}
		if(!$.isNumeric($('#heuresTD').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre d'heures de TD\"</strong> !");
			return false;
		}
		// nombre de groupes de cours
		if($('#groupesCours').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Nombre de groupes de cours\"</strong> !");
			return false;
		}
		if(!$.isNumeric($('#groupesCours').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de groupes de cours\"</strong> !");
			return false;
		}
		// nombre de groupes de TD
		if($('#groupesTD').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Nombre de groupes de TD\"</strong> !");
			return false;
		}
		if(!$.isNumeric($('#groupesTD').val())) {
			openOverlayError("Oops ! Vous avez mal rempli le champ <strong>\"Nombre de groupes de TD\"</strong> !");
			return false;
		}
		return true;
	});
	
});