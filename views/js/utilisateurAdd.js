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
	
	
	$('#ur_role').change(function () {
		var v =  $("#ur_role option:selected").val();
		
		// ID du role "Responsable Cours" == 7
		if(v == 7) {
			$("#ur_responsable_cours").slideDown("normal");
		} else {
			$("#ur_responsable_cours").slideUp("normal");
		}
	});
});