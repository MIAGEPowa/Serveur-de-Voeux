<?php
	class TableaudebordController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Filiere','Enseignement','FiliereEnseignement', 'Configuration');
		
		// Variables pour les vues
		var $v_JS = array();

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Tableau de bord';
			$d['v_menuActive'] = 'tableaudebord';
			
			// pour la secrétaire, on regarde les filières - enseignements qui ont la meme ref
			// if($_SESSION['v_droits'] == 1) {
				$annee = $this->Configuration->find();
				$annee = $annee[0]['annee'];
				
				$d["arrayFilieresEnseignementsSameRef"] = $this->FiliereEnseignement->getSameRef($annee);
			// }
			
			$this->set($d);
			$this->render('index');
		}

	}
?>