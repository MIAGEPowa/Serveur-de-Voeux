$(document).ready(function() {
	
	// Ferme le overlay quand l'utilisateur clique sur la croix en haut a droite du bloc
	$(".overlayClose").click(function() {
		var div = $(this).parent().parent();
		div.fadeOut("normal");
	});
	
});

function openOverlayError(msg) {
	$('#overlayError p').html(msg);
	$('#overlay').css('display','block');
	$('#overlayError').css('display','block');
}

function openOverlaySuccess(msg) {
	$('#overlaySuccess p').html(msg);
	$('#overlay').css('display','block');
	$('#overlaySuccess').css('display','block');
}