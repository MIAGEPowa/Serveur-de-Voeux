<?php
	class EnseignementController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Enseignement','Keyword');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Enseignements';
			$d['v_menuActive'] = 'enseignements';
			$this->v_JS = array('jquery-1.9.1.min', 'tools', 'enseignement');
			
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
				$d['v_success'] = "L'enseignement a bien été créé";
			}
			
			// Liste des enseignements
			$d['arrayEnseignements'] = $this->Enseignement->getAll();
			
			$this->set($d);
			$this->render('index');
		}
		
		function update($id) {
			// Titre
			$d['v_titreHTML'] = 'Modifier un enseignement';
			$d['v_menuActive'] = 'enseignements';
			$this->v_JS = array('jquery-1.9.1.min', 'tools', 'enseignementUpdate');
			
			if(isset($_POST) && count($_POST) != 0) {
				// enseignement
				$dataEnseignement = array(	"id" => $id,
											"libelle" => $_POST['intitule'],
											"description" => $_POST['description'] );
				$this->Enseignement->save($dataEnseignement);

				// Keywords
				// Suppressions
				for($i=0; $i<count($_POST['keywordToDelete']); $i++) {
					$this->Keyword->del($_POST['keywordToDelete'][$i]);
				}
				// Ajouts
				for($i=0; $i<count($_POST['keywordToAdd']); $i++) {
					// $_POST['keywordToAdd'][$i] sous la forme "keyword,typeKeyword"
					// Exemple : "XML,1" (1 = prérequis, 2 = compétence acquise)
					$keywordToAdd = explode(",", $_POST['keywordToAdd'][$i]);
					$prerequis = 0;
					$competences = 0;
					
					if($keywordToAdd[1] == 1) {$prerequis = 1;}
					else if($keywordToAdd[1] == 2) {$competences = 1;}
					
					$dataKeyword = array(	"id_utilisateur" => 0,
											"id_enseignement" => $id,
											"pre_requis" => $prerequis,
											"competences_acquises" => $competences,
											"keyword" => $keywordToAdd[0] );
					$this->Keyword->save($dataKeyword);
				}
				
				$d['v_success'] = "L'enseignement a bien été modifié";
			}
			
			// Liste des enseignements
			$d['enseignement'] = $this->Enseignement->find(array(
									'conditions' => 'id = ' . $id
								));
			$d['enseignement'] = $d['enseignement'][0];
			
			// Les keywords
			$d['arrayKeywords'] = $this->Keyword->find(array('conditions' => 'id_enseignement = '.$id));
			
			$this->set($d);
			$this->render('update');
		}
		
		function delete($id) {
			$this->Enseignement->deleteEnseignement($id);
			redirection("enseignement", "index");
		}
	}
?>