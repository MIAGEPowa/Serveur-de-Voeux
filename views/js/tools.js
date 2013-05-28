$(document).ready(function() {
	
	//
	// ------------- Déroule le formulaire d'ajout
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
	
	//
	// ------------- Gestion de l'ouverture des sous menus
	//
	
	$('#col .sub-menu').hide();
	$('#col .sub-menu').each( function() {
		$(this).prev().find('a').append('<span class="icon-arrow"></span>');
		if($(this).find('li').hasClass('active')) {
			$(this).show();
		}
	});
	// si hover sur un super menu
	$('#col > ul > li').mouseenter(
		function() {
			if($(this).next().is('.sub-menu') && $(this).next().css('display') == 'none') {
				$('#col .sub-menu').slideUp('medium');
				$(this).next().slideDown('medium');
			}
		}
	);
	// si click sur la flèche d'un super menu
	$('#col > ul > li .icon-arrow').click( function() {
		// acces au sous menu
		if($(this).parent().parent().next().css('display') == 'none') {
			$(this).parent().parent().next().slideDown('medium');
		}
		else {
			$(this).parent().parent().next().slideUp('medium');
		}
		// pour annuler le href
		return false;
	});
	
	//
	// ------------- Pour les champs décimal, remplace les "," par des "."
	//
	
	$('.decimal').keyup( function(e) {
		// si la touche tapée n'est pas un chiffre, on la supprime
		if(!$.isNumeric($(this).val())) {
			$(this).val($(this).val().slice(0,$(this).val().length-1));
		}
		else {
			$(this).val($(this).val().replace(",","."));
			if($(this).val().length == 3 && $(this).val().substr($(this).val().length - 1) != '.') {
				$(this).val([$(this).val().slice(0, 2), '.', $(this).val().slice(2)].join(''));
			}
		}
	});
	
	//
	// ------------- Pour le tri des tableaux ainsi que la recherche
	//
	
	$(document).ready( function() { 
        $("table:not(.form-table):not(.no-tri)").dataTable({		
			"oLanguage": {
			  "sSearch": "Recherche:",
			  "sInfo": "",
			  "sZeroRecords": "La recherche n'a donné aucun résultat..."
			},
			"bPaginate": false,
			"bInfo": false, 
		});
    } 
); 
	
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

// vérifie si la string passée en param a bien la forme d'une adresse mail
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\.+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}