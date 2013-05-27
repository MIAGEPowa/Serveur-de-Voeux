<?php
	class SpecialiteController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Specialite');
		
		// Variables pour les vues
		var $v_JS = array('specialite');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Spécialités';
			$d['v_menuActive'] = 'specialites';
			$d['v_needRights'] = 4;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {

				if(isset($_POST) && count($_POST) != 0) {

					$dataSpecialite = array('id' => $_POST['idSpecialite'],
											'libelle' => $_POST['intitule']);
											
					$checkSpecialite = $this->Specialite->checkSpecialiteLibelle($_POST['intitule']);

					if ((!$checkSpecialite) || (!empty($_POST['idSpecialite']))) {
						$this->Specialite->save($dataSpecialite);

						if(isset($_POST['idSpecialite']) && !empty($_POST['idSpecialite']))
							$d['v_success'] = "La spécialité a bien été mise à jour";
						else
							$d['v_success'] = "La spécialité a bien été créée";
					} else {
						$d['v_errors'] = 'Oops ! Cette spécialité a déjà été créée.';
					}
				}

				$d['specialities'] = $this->Specialite->getAll();

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
			
				$this->Specialite->id = $id;

				$d['v_titreHTML'] = 'Spécialités';
				$d['v_menuActive'] = 'specialites';
				$d['specialite'] = $this->Specialite->getSpecialite($id);

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
			
				$this->Specialite->del($id);
				redirection("specialite", "index");
			
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
	}
?>