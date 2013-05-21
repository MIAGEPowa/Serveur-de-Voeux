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
	});
	
});