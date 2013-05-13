<?php
	class EnseignementController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Enseignement','Keyword');
		
		// Variables pour les vues
		var $v_JS = array('jquery-1.9.1.min', 'tools', 'enseignement');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Enseignements';
			$d['v_menuActive'] = 'enseignements';
			
			if(isset($_POST) && count($_POST) != 0) {
				// enseignement
				$dataEnseignement = array(	"libelle" => $_POST['intitule'],
											"description" => $_POST['description'],
											"auteur" => $_SESSION['v_id_utilisateur'],
											"etat" => 0 );
				$this->Enseignement->save($dataEnseignement);
				
				// keywords
				$idEnseignement = $this->Enseignement->id;
				
				for($i=0; $i<count($_POST['keyword']); $i++) {
					
					// $_POST['keyword'][$i] sous la forme "keyword,typeKeyword"
					// Exemple : "XML,1" (1 = prérequis, 2 = compétence acquise)
					$keyword = explode(",", $_POST['keyword'][$i]);
					$prerequis = 0;
					$competences = 0;
					
					if($keyword[1] == 1) {$prerequis = 1;}
					else if($keyword[1] == 2) {$competences = 1;}
					
					$dataKeyword = array(	"id_utilisateur" => 0,
											"id_enseignement" => $idEnseignement,
											"pre_requis" => $prerequis,
											"competences_acquises" => $competences,
											"keyword" => $keyword[0] );
					$this->Keyword->save($dataKeyword);
				}
			}
			
			// Liste des enseignements
			$d['arrayEnseignements'] = $this->Enseignement->find();
			
			$this->set($d);
			$this->render('index');
		}
	}
?>