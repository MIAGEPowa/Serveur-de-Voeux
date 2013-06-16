<?php
	class EnseignementController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Enseignement', 'Keyword', 'FiliereEnseignement');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Enseignements';
			$d['v_menuActive'] = 'enseignements';
			$this->v_JS = array('enseignement');

			if(isset($_POST) && count($_POST) != 0 && $_SESSION['v_droits'] >= 2) {
				// enseignement
				$dataEnseignement = array(	"libelle" => $_POST['intitule'],
									"description" => $_POST['description'],
									"auteur" => $_SESSION['v_id_utilisateur'],
									"etat" => 0 );
									
				$checkEnseignement = $this->Enseignement->checkEnseignementLibelle($_POST['intitule']);   
				
				if(!$checkEnseignement) {
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
				} else {
					$d['v_errors'] = 'Oops ! Cet enseignement a déjà été créé.';
				}
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
			$this->v_JS = array('enseignementUpdate');
			$d['v_needRights'] = 2;
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {
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
				
				// L'enseignement à modifier
				$d['enseignement'] = $this->Enseignement->find(array(
										'conditions' => 'id = '.$id));
				$d['enseignement'] = $d['enseignement'][0];
				
				// Les keywords
				$d['arrayKeywords'] = $this->Keyword->find(array('conditions' => 'id_enseignement = '.$id));
				
				$this->set($d);
				$this->render('update');
				
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
		function delete($id) {
			$d['v_titreHTML'] = 'Enseignements';
			$d['v_menuActive'] = 'enseignements';
			$this->v_JS = array('enseignement');
			$d['v_needRights'] = 4;
			
			$enseignement = $this->Enseignement->find(array( 'conditions' => 'auteur = '.$_SESSION['v_id_utilisateur']));
			
			// suppression que pour l'admin et l'auteur							
			if($_SESSION['v_droits'] >= $d['v_needRights'] || $enseignement[0]['auteur'] == $_SESSION['v_id_utilisateur']) {
				$check = 0;
				$allFiliereEnseignement = $this->FiliereEnseignement->getAllFiliereEnseignement(); 
				foreach($allFiliereEnseignement as $fe) {
					if($fe['id_enseignement'] == $id)
						$check = 1;
				}
				
				if(!$check) {
					$this->Enseignement->deleteEnseignement($id);
					$d['v_success'] = 'L\'enseignement a bien été supprimé !';
				} else {
					$d['v_errors'] = 'Oops ! Cet enseignement est associé à une filière et ne peut-être supprimé.';
				}
				
				// Liste des enseignements
				$d['arrayEnseignements'] = $this->Enseignement->getAll();
				
				$this->set($d);
				$this->render('index');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
    
		function view($id) {
			// Titre
			$d['v_titreHTML'] = 'Enseignements';
			$d['v_menuActive'] = 'enseignements';
			$this->v_JS = array('enseignement');
		  
			$d['enseignement'] = $this->Enseignement->getEnseignementView($id);
			$d['arrayKeywords'] = $this->Keyword->find(array('conditions' => 'id_enseignement = '.$id));
			$d['arrayFilieres'] = $this->FiliereEnseignement->getAllFiliere($id);

			$this->set($d);
			$this->render('view');
		}
	}
?>