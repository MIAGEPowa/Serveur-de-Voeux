<?php
	class DiplomeController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Diplome');
		
		// Variables pour les vues
		var $v_JS = array('diplome');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Diplômes';
			$d['v_menuActive'] = 'diplomes';
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				if(isset($_POST) && count($_POST) != 0) {
					
					$dataDiplome = array('id' => $_POST['idDiplome'],
										 'libelle' => $_POST['intitule']);

					$checkDiplome = $this->Diplome->checkDiplomeLibelle($_POST['intitule']);

					if ((!$checkDiplome) || (!empty($_POST['idDiplome']))) {
						$this->Diplome->save($dataDiplome);

						if(isset($_POST['idDiplome']) && !empty($_POST['idDiplome']))
							$d['v_success'] = "Le diplôme a bien été mis à jour";
						else
							$d['v_success'] = "Le diplôme a bien été créé";
					} else {
						$d['v_errors'] = 'Oops ! Ce diplôme a déjà été créé.';
					}
				}

				$d['diplomes'] = $this->Diplome->getAll();

				$this->set($d);
				$this->render('index');
				
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
    
		function update($id) {
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {	
				
				$this->Diplome->id = $id;
			  
				$d['v_titreHTML'] = 'Diplômes';
				$d['v_menuActive'] = 'diplomes';
				$d['diplome'] = $this->Diplome->getDiplome($id);

				$this->set($d);
				$this->render('update');
			
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
		function delete($id) {
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				$this->Diplome->del($id);
				redirection("diplome", "index");
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
	}
?>