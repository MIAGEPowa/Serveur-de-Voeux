$(document).ready(function() {

	$('#droits').change(function () {
		var d =  $("#droits option:selected").val();
		$(".div-droits").slideUp("normal");
		$("#div-"+d).slideDown("normal");
	});
	
	$('#r_droits').change(function () {
		var d =  $("#r_droits option:selected").val();
		$(".r-div-droits").slideUp("normal");
		$("#r-div-"+d).slideDown("normal");
		
		if (d == 1) {
			$("#r_diplome").prop("disabled", true);
			$("#s_filiere").removeAttr('disabled');
		} else {
			$("#s_filiere").prop("disabled", true);
			$("#r_diplome").removeAttr('disabled');
		}
			
	});
	
});