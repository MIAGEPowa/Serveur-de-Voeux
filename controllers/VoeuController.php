<?php
	class VoeuController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('FiliereEnseignementEnseignant', 'FiliereEnseignement');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Voeux';
			$d['v_menuActive'] = 'voeux';
      //$_SESSION['v_id_utilisateur'];
      
      $d['filiereEnseignement'] = $this->FiliereEnseignement->getAllFiliereEnseignement();
      
			$this->set($d);
			$this->render('index');
		}	
	
	}
?>