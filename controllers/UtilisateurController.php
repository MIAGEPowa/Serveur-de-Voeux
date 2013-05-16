<?php
	class UtilisateurController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Utilisateur','Keyword');
		
		// Variables pour les vues
		var $v_JS = array('jquery-1.9.1.min', 'tools', 'monCompte');

		function moncompte() {
			// Titre
			$d['v_titreHTML'] = 'Mon compte';
			
			// Traitement du formulaire des informations du compte utilisateur
			if($_POST['utilisateur_form_moncompte']) {
				if(isset($_POST['email']) && !empty($_POST['email'])) {
					
					$importPhoto = 1;
					$importCV = 1;
					$size_max = 1000000;
					
					// Importation de la photo
					if($_FILES['photo']['tmp_name']) {
						$extensions = array('.png', '.gif', '.jpg');
						$extension = strrchr($_FILES['photo']['name'], '.');
						if(filesize($_FILES['photo']['tmp_name']) > $size_max || !in_array($extension, $extensions)) {
							$d['v_errors'] = 'Oops ! La photo que vous cherchez à importer est trop lourde ou le format n\'est pas accepté.';
						} else {
							
							// On supprime la photo de l'utilisateur s'il en possède déjà une 
							if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.png'))
								unlink(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.png');
							if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.jpg'))
								unlink(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.jpg');
							if(file_exists(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.gif'))
								unlink(ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].'.gif');
							
							if(move_uploaded_file($_FILES['photo']['tmp_name'], ROOT.'files/avatar/'.$_SESSION['v_id_utilisateur'].$extension)) {
								$importPhoto = 1;
							} else {
								$importPhoto = 0;
								$d['v_errors'] = 'Oops ! La photo n\'a pas été importée correctement.';
							}
						}
					}
					
					// Importation du CV
					if($_FILES['cv']['tmp_name']) {
						$extensions = array('.pdf');
						$extension = strrchr($_FILES['cv']['name'], '.');
						if(filesize($_FILES['cv']['tmp_name']) > $size_max || !in_array($extension, $extensions)) {
							$d['v_errors'] = 'Oops ! Le CV que vous cherchez à importer est trop lourde ou le format n\'est pas accepté.';
						} else {
							
							// On supprime le cv de l'utilisateur s'il en possède déjà un 
							if(file_exists(ROOT.'files/cv/'.$_SESSION['v_id_utilisateur'].'.pdf'))
								unlink(ROOT.'files/cv/'.$_SESSION['v_id_utilisateur'].'.pdf');
							
							if(move_uploaded_file($_FILES['cv']['tmp_name'], ROOT.'files/cv/'.$_SESSION['v_id_utilisateur'].$extension)) {
								$importCV = 1;
							} else {
								$importCV = 0;
								$d['v_errors'] = 'Oops ! Le CV n\'a pas été importé correctement.';
							}
						}
					}
					
					if($importPhoto && $importCV) {
						// On change le mot de passe que si l'utilisateur a insérer des données dans le input password
						if(isset($_POST['password']) && !empty($_POST['password']))
							$this->Utilisateur->editUtilisateur($_SESSION['v_id_utilisateur'], $_POST['password'], $_POST['email'], $_POST['biographie'], $_POST['badge']);
						else
							$this->Utilisateur->editUtilisateur($_SESSION['v_id_utilisateur'], null, $_POST['email'], $_POST['biographie'], $_POST['badge']);
						$d['v_success'] = 'Les informations de votre compte ont bien été mises à jour.';	
					}
				
					for($i=0; $i<count($_POST['todelete-keyword']); $i++) {
						$keyword = $_POST['todelete-keyword'];
						$dataKeyword = array(	"id_utilisateur" => 0,
												"id_enseignement" => $idEnseignement,
												"pre_requis" => $prerequis,
												"competences_acquises" => $competences,
												"keyword" => $keyword[0] );
						$this->Keyword->save($dataKeyword);
					}
					
				} else {
					$d['v_errors'] = 'Oops ! Le champ email est obligatoire.';
				}
				
				// Keywords
				// Suppressions
				for($i=0; $i<count($_POST['keywordToDelete']); $i++) {
					$this->Keyword->del($_POST['keywordToDelete'][$i]);
				}
				// Ajouts
				for($i=0; $i<count($_POST['keywordToAdd']); $i++) {
					$dataKeyword = array(	"id_utilisateur" => $_SESSION['v_id_utilisateur'],
											"id_enseignement" => 0,
											"pre_requis" => 0,
											"competences_acquises" => 0,
											"keyword" => $_POST['keywordToAdd'][$i] );
					$this->Keyword->save($dataKeyword);
				}
			}
			
			// informations sur l'utilisateur
			$u = $this->Utilisateur->getUtilisateur($_SESSION['v_id_utilisateur']);
			foreach($u as $utilisateur) {
				$d['email'] = $utilisateur['email'];
				$d['biographie'] = $utilisateur['biographie'];
				$d['badge'] = $utilisateur['badge'];
			}
			
			// Les keywords
			$d['arrayKeywords'] = $this->Keyword->find(array('conditions' => 'id_utilisateur = '.$_SESSION['v_id_utilisateur']));
			
			$this->set($d);
			$this->render('moncompte');
		}
		
		function delegations() {
			$d['v_titreHTML'] = 'Délégations';
			$d['v_menuActive'] = 'delegations';
			
			// Traitement du formulaire des délégations
			if($_POST['utilisateur_form_delegations']) {
				if(isset($_POST['description_delegations']) && !empty($_POST['description_delegations']) && isset($_POST['h_delegations']) && !empty($_POST['h_delegations'])) {
					
					if(is_numeric($_POST['h_delegations'])) {
						$this->Utilisateur->updateDelegationsUtilisateur($_SESSION['v_id_utilisateur'], $_POST['description_delegations'], $_POST['h_delegations']);
						$d['v_success'] = 'Vos délégations ont bien été mises à jour.';
					} else {
						$d['v_errors'] = 'Oops ! La somme de vos heures de délégations doit être une valeur entière.';
					}
					
				} else {
					$d['v_errors'] = 'Oops ! Les deux champs sont obligatoires.';
				}
			}
			
			$u = $this->Utilisateur->getUtilisateur($_SESSION['v_id_utilisateur']);
			foreach($u as $utilisateur) {
				$d['nbr_h_delegation'] = $utilisateur['nbr_h_delegation'];
				$d['description_delegation'] = $utilisateur['description_delegation'];
			}
		
			$this->set($d);
			$this->render('delegations');
		}
		
		function importer() {
			$d['v_titreHTML'] = 'Importer des utilisateurs';
			$d['v_menuActive'] = 'utilisateursImporter';
		
			// Traitement du formulaire des délégations
			if($_POST['utilisateur_form_importer']) {
				die(1);
			}
		
			$this->set($d);
			$this->render('importer');
		}
	}
?>