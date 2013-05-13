$(document).ready(function() {
	
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