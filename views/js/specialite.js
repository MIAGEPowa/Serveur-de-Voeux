$(document).ready(function() {
	
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-create-speciality').submit(function() {
		if($('#intitule').val() == "") {
			openOverlayError("Vous n'avez pas rempli le champ <strong>\"Intitulé\"</strong> !");
			return false;
		}
		return true;
	});

  $('#form-update-speciality').submit(function() {
		if($('#intitule').val() == "") {
			openOverlayError("Vous n'avez pas rempli le champ <strong>\"Intitulé\"</strong> !");
			return false;
		}
		return true;
	});
	
});