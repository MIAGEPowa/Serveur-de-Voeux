$(document).ready(function() {
	
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-update-voeu').submit(function() {
    if ((parseInt($('#heuresCours').val()) > parseInt($('#nbr_h_cours').val())) && (parseInt($('#heuresTD').val()) > parseInt($('#nbr_h_td').val()))) {
      openOverlayError("Vous avez dépassé le <strong> \"Nombre d'heures de cours\"</strong> et le <strong> \"Nombre d'heures de TD\"</strong> qu'il est possible de s'allouer !");
      return false;
    } else {
      if (parseInt($('#heuresCours').val()) > parseInt($('#nbr_h_cours').val())) {
        openOverlayError("Vous avez dépassé le <strong> \"Nombre d'heures de cours\"</strong> qu'il est possible de s'allouer !");
        return false;
      } 
      if (parseInt($('#heuresTD').val()) > parseInt($('#nbr_h_td').val())) {
        openOverlayError("Vous avez dépassé le <strong> \"Nombre d'heures de TD\"</strong> qu'il est possible de s'allouer !");
        return false;
      }
    }
		return true;
	});
	
});