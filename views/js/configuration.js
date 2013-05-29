$(document).ready(function() {
	
	//
	// Lance un fenêtre de confirmation quand l'utilisateur souhaite passer à l'année suivante
	//
	
	$('#form-config').submit(function() {
        if (confirm('Voulez-vous vraiment passer à l\'année suivante ?')) {
            return true;
        }
		return false;
	});
	
});