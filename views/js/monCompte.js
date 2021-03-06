$(document).ready(function() {
	
	//
	// Ajoute un keyword dans la liste lors du click sur le bouton "ajouter"
	//
	
	$('#add-keyword').click(function() {
		if($("#keyword").val() != "") {
			// si aucun keyword n'a jamais été enregistré.
			if($('#list-keywords').find('table').size() == 0) {
				$('#list-keywords').find('span').hide();
				$('#list-keywords').append('	<table style="display:none" class="form-table">'+
													'<thead>'+
														'<tr>'+
															'<th width="22%">Intitulé</th>'+
															'<th width="22%">Actions</th>'+
															'<th width="22%"></th>'+
														'</tr>'+
													'</thead>'+
													'<tbody>'+
														'<tr>'+
															'<td class="value-keyword">'+trimAndLowCase($("#keyword").val())+'</td>'+
															'<td>'+
																'<a class="buttons-link" onclick="deleteRow($(this))">'+
																	'<span class="buttons button-red">Supprimer</span>'+
																'</a>'+
															'</td>'+
															'<td><i>A enregistrer !</i></td>'+
														'</tr>'+
													'</tbody>'+
												'</table>');
				$('#list-keywords table').fadeIn("medium");
					$('#list-keywords').append('<input class="hidden-keyword" type="hidden" name="keywordToAdd[]" value="'+trimAndLowCase($("#keyword").val())+'" />');
			}
			else {
				var canAdd = true; 
				
				// on vérifie s'il le keyword ajouté n'existe pas déjà
				$('#list-keywords table tbody td.value-keyword').each(function(i) {
					if($(this).html() == trimAndLowCase($("#keyword").val())) {
						canAdd = false;
						openOverlayError("Ce mot clé existe déjà");
						return false;
					}
				});
				
				if(canAdd) {
					$('#list-keywords table tbody').append(	'<tr style="display:none">'+
																'<td class="value-keyword">'+trimAndLowCase($("#keyword").val())+'</td>'+
																'<td>'+
																	'<a class="buttons-link" onclick="deleteRow($(this))">'+
																		'<span class="buttons button-red">Supprimer</span>'+
																	'</a>'+
																'</td>'+
																'<td><i>A enregistrer !</i></td>'+
															'</tr>');
					$('#list-keywords table tbody tr').fadeIn("medium");
					$('#list-keywords').append('<input class="hidden-keyword" type="hidden" name="keywordToAdd[]" value="'+trimAndLowCase($("#keyword").val())+'" />');
				}
			}
		}
	});
	
	//
	// vérifie si tous les champs sont valides au moment du submit du formulaire
	//
	
	$('#form-update-profile').submit(function() {
		if($('#email').val() == "") {
			openOverlayError("Oops ! Vous n'avez pas rempli le champ <strong>\"Email\"</strong> !");
			return false;
		}
		if(validateEmail($('#email').val()) == "") {
			openOverlayError("Oops ! L'email renseigné est mal saisi !");
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