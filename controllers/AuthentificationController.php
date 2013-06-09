<?php
	class AuthentificationController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Utilisateur', 'Configuration');
		
		// Variables pour les vues
		var $v_JS = array('authentification');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Bienvenue sur le serveur de voeux';
			
			// Traitement du formulaire de connexion
			if($_POST['authentification_form_submit']) {
				if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
					
					$connexion = $this->Utilisateur->connexion($_POST['email'], $_POST['password']);
					if($connexion) {
						foreach($connexion as $c) {
							$_SESSION['v_connected'] = 1; 
							$_SESSION['v_id_utilisateur'] = $c['id'];
							$_SESSION['v_nom'] = $c['nom'];
							$_SESSION['v_prenom'] = $c['prenom'];
						}
						
						// Droits max de l'utilisateur
						$droits = $this->Utilisateur->getUtilisateurDroitsMax($c['id']);
						if($droits)
							$_SESSION['v_droits'] = $droits;
						else
							$_SESSION['v_droits'] = 1;
												
						// Rediriger l'utilisateur sur la page d'acceuil du BO
						redirection("tableaudebord", "index");
						
					} else {
						// si le user n'existe mais qu'il est inactif
						$existe = $this->Utilisateur->existe($_POST['email'], $_POST['password']);
						if($existe)
							$d['v_errors'] = 'Oops ! Votre compte est inactif.';
						else
							$d['v_errors'] = 'Oops ! Le couple email et mot de passe est incorrect.';
					}
				} else {
					$d['v_errors'] = 'Oops ! Veuillez remplir tous les champs du formulaire.';
				}
			}
			
			// Traitement du formulaire mot de passe oublié
			if($_POST['authentification_form_motdepasseoublie']) {
				if(isset($_POST['email']) && !empty($_POST['email'])) {
					$utilisateur = $this->Utilisateur->getUtilisateurByEmail($_POST['email']);
					if($utilisateur) {
						foreach($utilisateur as $u) {
							$utilisateur_id = $u['id'];
							$utilisateur_email = $u['email'];
							$utilisateur_nom = $u['nom'];
							$utilisateur_prenom = $u['prenom'];
						}
						
						$this->Utilisateur->resetMotdepasse($utilisateur_id, $utilisateur_email, $utilisateur_nom, $utilisateur_prenom);
						$d['v_success'] = 'Un nouveau mot de passe vous a été envoyé à votre email.';
						
						// print_r($utilisateur);
						// die(1);
					} else {
						$d['v_errors'] = 'Oops ! L\'email ne correspond à aucun compte.';
					}
				} else {
					$d['v_errors'] = 'Oops ! Veuillez remplir tous les champs du formulaire.';
				}
			}
		
			$this->set($d);
			$this->render('index');
		}
		
		function deconnexion() {
			// On détruit la session
			$_SESSION = array();
			session_destroy();
			
			redirection(false, false, 1);
		}
	}
?>