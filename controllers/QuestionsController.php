<?php
	class QuestionsController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Question');
		
		// Variables pour les vues
		var $v_JS = array();

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Liste des questions';
			// Menu à sélectionné
			$d['v_menuActive'] = 'questions';
			
			$d['questions'] = $this->Question->getLast(100);
			$this->set($d);
			$this->render('index');
		}

		function view($id) {
			$d['v_titreHTML'] = 'Question #'.$id;
			$d['v_menuActive'] = 'questions';
			
			$d['questions'] = $this->Question->find(array(
				'conditions' => 'id='.$id
			));
			$d['questions'] = $d['questions'][0];
			$this->set($d);
			$this->render('view'); 
		}

	}
?>