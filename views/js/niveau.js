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
	
});