<?php
	class NotfoundController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Notfound');
		
		// Variables pour les vues
		var $v_JS = array();

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Erreur 404';
			
			$this->set($d);
			$this->render('index');
		}

	}
?>