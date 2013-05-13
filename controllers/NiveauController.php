<?php
	class NiveauController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Niveau', 'Diplome');
		
		// Variables pour les vues
		var $v_JS = array('jquery-1.9.1.min', 'tools', 'niveau');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Niveaux';
			$d['v_menuActive'] = 'niveaux';
			$d['levels'] = $this->Niveau->getAll();
			$d['degrees'] = $this->Diplome->getAll();
			
			if(isset($_POST) && count($_POST) != 0) {
				
				$dataNiveau = array('libelle' => $_POST['intitule'],
									'id_diplome' => $_POST['diplome']);
				
				$this->Niveau->save($dataNiveau);
				
			}
			
			$this->set($d);
			$this->render('index');
		}
	}
?>