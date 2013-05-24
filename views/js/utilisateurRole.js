$(document).ready(function() {

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