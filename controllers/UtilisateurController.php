<?php
	class UtilisateurController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Utilisateur');
		
		// Variables pour les vues
		var $v_JS = array('jquery-1.9.1.min', 'tools');

		function moncompte() {
			// Titre
			$d['v_titreHTML'] = 'Mon compte';
			
			// Traitement du formulaire des informations du compte utilisateur
			if($_POST['utilisateur_form_moncompte']) {
				if(isset($_POST['email']) && !empty($_POST['email'])) {
					
					// On change le mot de passe que si l'utilisateur a insérer des données dans le input password
					if(isset($_POST['password']) && !empty($_POST['password']))
						$changeMDP = 1;
					else
						$changeMDP = 0;
						
					if($changeMDP)
						$this->Utilisateur->editUtilisateur($_SESSION['v_id_utilisateur'], $_POST['password'], $_POST['email'], $_POST['biographie'], $_POST['badge']);
					else
						$this->Utilisateur->editUtilisateur($_SESSION['v_id_utilisateur'], null, $_POST['email'], $_POST['biographie'], $_POST['badge']);
					
					if($_FILES['photo']['tmp_name']) {
						
						$size_max = 100000;
						$extensions = array('.png', '.gif', '.jpg');
						$extension = strrchr($_FILES['photo']['name'], '.');
						if(filesize($_FILES['photo']['tmp_name']) > $size_max || !in_array($extension, $extensions)) {
							$d['v_errors'] = 'Oops ! La photo que vous cherchez à importer est trop lourde ou le format n\'est pas accepté.';
						} else {
							if(move_uploaded_file($_FILES['photo']['tmp_name'], ROOT.'views/img/utilisateurs/'.$_SESSION['v_id_utilisateur'].$extension)) {
								$d['v_success'] = 'La photo a correctement été importé.';
							} else {
								$d['v_errors'] = 'Oops ! La photo n\'a pas été importé correctement.';
							}
						}
						
					}
					
					// Si cv ou photo != null alors les importer
					
					$d['v_success'] .= '<br />Les informations de votre compte ont bien été mis à jour.';
					
				} else {
					$d['v_errors'] = 'Oops ! Le champ email est obligatoire.';
				}
			}
			
			$u = $this->Utilisateur->getUtilisateur($_SESSION['v_id_utilisateur']);
			foreach($u as $utilisateur) {
				$d['email'] = $utilisateur['email'];
				$d['biographie'] = $utilisateur['biographie'];
				$d['badge'] = $utilisateur['badge'];
			}
			
			$this->set($d);
			$this->render('moncompte');
		}

	}
?>