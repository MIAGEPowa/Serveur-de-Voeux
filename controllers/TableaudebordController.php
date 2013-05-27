<?php
	class TableaudebordController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Filiere','Enseignement','FiliereEnseignement');
		
		// Variables pour les vues
		var $v_JS = array();

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Tableau de bord';
			$d['v_menuActive'] = 'tableaudebord';
			
			$this->set($d);
			$this->render('index');
		}

	}
?>