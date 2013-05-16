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
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Intitulé\"</strong> !");
			return false;
		}
		if($('#description').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Description\"</strong> !");
			return false;
		}
		return true;
	});
	
});

// permet de supprimer une ligne de keyword
function deleteRow(element) {
	
	$toDeleteInBDD = true;
	
	// s'il n'a pas encore été enregistré, on supprime le input hidden associé
	$('input.hidden-keyword').each(function(i) {
		if(element.parent().parent().find('td.value-keyword').html() == $(this).val()) {
			$(this).remove();
			$toDeleteInBDD = false;
			return false;
		}
	});
	
	// si le keyword était déjà présent en base
	if($toDeleteInBDD) {
		$('#list-keywords').append('<input class="todelete-keyword" type="hidden" name="keywordToDelete[]" value="'+trimAndLowCase(element.parent().parent().find('td.value-keyword').attr('data-id-key'))+'" />');
	}
	
	element.parent().parent().fadeOut('fast',function(){$(this).remove();});
	
	// s'il n'y a plus de ligne, on suppr le tableau
	if($('#list-keywords table tbody').find('tr').size() == 1) {
		$('#list-keywords table').fadeOut('fast',function(){
													$(this).remove(); 
													$('#list-keywords').find('span').show();});
	}
}