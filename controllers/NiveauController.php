<?php
	class NiveauController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Niveau', 'Diplome');
		
		// Variables pour les vues
		var $v_JS = array('niveau');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Niveaux';
			$d['v_menuActive'] = 'niveaux';
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
			
				if(isset($_POST) && count($_POST) != 0) {
					
					$dataNiveau = array('id' => $_POST['idNiveau'],
										'libelle' => $_POST['intitule'],
										'id_diplome' => $_POST['diplome']);

					$checkNiveau = $this->Niveau->checkNiveauLibelle($_POST['intitule']);

					if ((!$checkNiveau) || (!empty($_POST['idNiveau']))) {
						$this->Niveau->save($dataNiveau);

						if(isset($_POST['idNiveau']) && !empty($_POST['idNiveau']))
							$d['v_success'] = "Le niveau a bien été mis à jour";
						else
							$d['v_success'] = "Le niveau a bien été créé";

					} else {
						$d['v_errors'] = 'Oops ! Ce niveau a déjà été créé.';
					}
				}
				
				$d['niveaux'] = $this->Niveau->getAll();
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
				$this->Niveau->id = $id;

				$d['v_titreHTML'] = 'Niveaux';
				$d['v_menuActive'] = 'niveaux';
				$d['niveau'] = $this->Niveau->getNiveau($id);
				$d['degrees'] = $this->Diplome->getAll();

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
				$this->Niveau->del($id);
				redirection("niveau", "index");
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
	}
?>