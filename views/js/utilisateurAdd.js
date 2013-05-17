$(document).ready(function() {
	
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-add-user').submit(function() {
		if($('#email').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Email\"</strong> !");
			return false;
		}
		if(validateEmail($('#email').val()) == "") {
			openOverlayError("Oops ! L'email renseigné est mal saisi !");
			return false;
		}
		if($('#prenom').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Prenom\"</strong> !");
			return false;
		}
		if($('#nom').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Nom\"</strong> !");
			return false;
		}
		return true;
	});
	
});