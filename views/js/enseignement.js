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
	
	//
	// Ajoute un keyword dans la liste lors du click sur le bouton "ajouter"
	//
	
	var isFirstAdding = true;
	
	$('#add-keyword').click(function() {
		if($("#keyword").val() != "") {
			if(isFirstAdding) {
				$('#list-keywords').find('li').remove();
				isFirstAdding = false;
			}
			$('#list-keywords').append('<li style="display:none">'+$("#keyword").val()+' > '+$('select#keyword-type option:selected').text()+'</li>');
			$('#list-keywords li').last().slideDown("medium");
			$('#list-keywords').append('<input type="hidden" name="keyword[]" value="'+$("#keyword").val()+','+$("select#keyword-type").val()+'" />');
		}
	});
	
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-create-teaching').submit(function() {
		if($('#intitule').val() == "") {
			openOverlayError("Vous n'avez pas rempli le champ <strong>\"Intitulé\"</strong> !");
			return false;
		}
		if($('#description').val() == "") {
			openOverlayError("Vous n'avez pas rempli le champ <strong>\"Description\"</strong> !");
			return false;
		}
		return true;
	});
	
});