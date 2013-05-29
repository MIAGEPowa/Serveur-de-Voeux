<?php
	class ConfigurationController extends Controller {

		// Déclaration du modèle rattaché au controlleur
		var $models = array('Configuration');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Configuration';
			$d['v_menuActive'] = '';
			$d['v_needRights'] = 4;
			$this->v_JS = array('configuration');
			
			$d['anneeActuelle'] = $this->Configuration->find();
			$id = $d['anneeActuelle'][0]['id'];
			$d['anneeActuelle'] = $d['anneeActuelle'][0]['annee'];
			
			if($_POST['config_annee']) {
				$dataAnnee = array( "id" => $id,
									"annee" => $d['anneeActuelle']+1 );
				$this->Configuration->save($dataAnnee);
				
				$d['v_success'] = "L'année a bien été modifiée !";
			}
			
			$d['anneeActuelle'] = $this->Configuration->find();
			$d['anneeActuelle'] = $d['anneeActuelle'][0]['annee'];
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {	
				$this->set($d);
				$this->render('index');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
	}
?>