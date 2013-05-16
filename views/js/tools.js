$(document).ready(function() {
	
  //
	// Déroule le formulaire d'ajout
	//
	$(".button-slide").click(function() {
		if($(this).next().css('display') == 'none') {
			$(this).next().slideDown('medium');
			$(this).find(".icon-arrow").animate({
				myRotationProperty: -180
			},
			{
				step: function(now, tween) {
					if (tween.prop === "myRotationProperty") {
						$(this).css('-webkit-transform','rotate('+now+'deg)');
						$(this).css('-moz-transform','rotate('+now+'deg)'); 
						// add Opera, MS etc. variants
						$(this).css('transform','rotate('+now+'deg)');  
					}
				}
			});
		}
		else {
			$(this).next().slideUp('medium');
			$(this).find(".icon-arrow").animate({
				myRotationProperty: 0
			},
			{
				step: function(now, tween) {
					if (tween.prop === "myRotationProperty") {
						$(this).css('-webkit-transform','rotate('+now+'deg)');
						$(this).css('-moz-transform','rotate('+now+'deg)'); 
						// add Opera, MS etc. variants
						$(this).css('transform','rotate('+now+'deg)');  
					}
				}
			});
		}
	});
  
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

// Enleve les espaces devant et derrière la string
function trim(myString) {
	return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
} 

// Enleve les espaces devant et derrière la string et met tout en minuscules
function trimAndLowCase(myString) {
	return (myString.replace(/^\s+/g,'').replace(/\s+$/g,'')).toLowerCase()
} 

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\.+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 