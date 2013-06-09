<?php
	class Utilisateur extends Model {

		var $table = 'utilisateur';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		// Teste la connexion avec le couple email/password
		function connexion($email, $password) {
			return $this->find(array(
				'conditions' => 'email = "' . $email . '" AND password = "' . md5(SECRET_KEY.$password) . '" AND actif = 1'
			));
		}
		
		// Teste si l'utilisateur existe
		function existe($email, $password) {
			$utilisateur = $this->find(array(
				'conditions' => 'email = "' . $email . '" AND password = "' . md5(SECRET_KEY.$password) . '"'
			));
			if(count($utilisateur) != 0)
				return true;
			
			return false;
		}
		
		// Retourne tous les utilisateurs actif
		function getUtilisateurs($actif = 1) {
			if($actif) {
				return $this->find(array(
					'conditions' => 'actif = 1'
				));
			}
			else {
				return $this->find();
			}
		}
		
		// Retourne tous les utilisateurs avec leurs rôles
		function getUtilisateursAvecRoles() {
			$arrayUtilisateur = $this->getUtilisateurs(0);
			
			$res = array();
			foreach($arrayUtilisateur as $utilisateur) {
				$arrayRoles = $this->query('
						SELECT * 
						FROM '.DB_PREFIX.'utilisateur_role ur, '.DB_PREFIX.'role r
						WHERE r.id = ur.id_role
						AND ur.id_utilisateur = '.$utilisateur['id']
				);
				$utilisateur['arrayRoles'] = $arrayRoles;
				$res[] = $utilisateur;
			}
			
			return $res;
		}
		
		// Retourne l'utilisateur voulu avec son/ses rôles
		function getUtilisateurAvecRoles($id) {
			$req = $this->query('
						SELECT * 
						FROM '.DB_PREFIX.'utilisateur u, '.DB_PREFIX.'utilisateur_role ur
						WHERE u.id = ur.id_utilisateur 
						AND u.id = '.$id
			);
			return $req;
		}
		
		// Retourne l'utilisateur de l'id passé en param
		function getUtilisateur($id) {
			return $this->find(array(
				'conditions' => 'id = ' . $id
			));
		}
		
		// Retourne le niveau de droits max de l'utilisateur
		function getUtilisateurDroitsMax($id) {
			$req = $this->query('
				SELECT MAX(r.droits) as max_droits
				FROM '.DB_PREFIX.'role r, '.DB_PREFIX.'utilisateur_role ur
				WHERE r.id=ur.id_role
				AND ur.id_utilisateur = '.$id
			);
			
			return $req[0]['max_droits'];
		}
		
		// Retourne l'utilisateur de l'email précisé passé en param
		function getUtilisateurByEmail($email) {
			return $this->find(array(
				'conditions' => 'email = "' . $email . '"'
			));
		}
		
		// Modifie les informations du compte utilisateur
		function editUtilisateur($id, $mdp = null, $email, $biographie, $badge) {
			if($mdp) {
				return $this->save(array(
					'id' => $id,
					'password' => md5(SECRET_KEY.$mdp),
					'email' => $email,
					'biographie' => $biographie,
					'badge' => $badge
				));
			} else {
				return $this->save(array(
					'id' => $id,
					'email' => $email,
					'biographie' => $biographie,
					'badge' => $badge
				));
			}
		}
		
		// Modifie les délégations de l'utilisateur
		function updateDelegationsUtilisateur($id, $description, $heures) {
			return $this->save(array(
				'id' => $id,
				'description_delegation' => $description,
				'nbr_h_delegation' => (int)($heures)
			));
		}
		
		// Retourne un tableau avec les users inactifs depuis 3 ans ou qui n'ont jamais créé de voeu
		function getUtilisateursADesactiver() {
			/* Afin d'obtenir l'année en cours */
			$annee = $this->query('SELECT * FROM '.DB_PREFIX.'config');
			$annee = $d[0]['annee']; 
		
			$req = $this->query('
				SELECT distinct u.*
				FROM '.DB_PREFIX.'filiere_enseignement_enseignant fee, '.DB_PREFIX.'utilisateur u, '.DB_PREFIX.'filiere_enseignement fe
				WHERE (u.id = fee.id_utilisateur
				  AND fee.id_filiere_enseignement = fe.id
				  AND fe.annee < '.($annee-2).')
				OR
				  u.id not in (SELECT fee2.id_utilisateur
							   FROM '.DB_PREFIX.'filiere_enseignement_enseignant fee2
							   WHERE u.id = fee2.id_utilisateur)
			');
			return $req;
		}
		
		// Reset le mot de passe d'un utilisateur
		function resetMotdepasse($id, $email, $nom, $prenom) {
			$mdp = stringGen(12);
			
			// On envoie le mail à l'utilisateur avec le mot de passe
			require_once(ROOT.'tools/swift-mailer/swift_required.php');
			$transport = Swift_MailTransport::newInstance();
			$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance('Nouveau mot de passe')
				->setFrom(array(EMAIL_ADMIN => EMAIL_LABEL))
				->setTo(array($email => $prenom.' '.$nom))
				->setBody('Bonjour '.$prenom.' '.$nom.', <br /><br />Votre nouveau mot de passe pour votre compte '.$email.' : '.$mdp, 'text/html');
			$mailer->send($message);
			
			return $this->save(array(
				'id' => $id,
				'password' => md5(SECRET_KEY.$mdp)
			));
		}
		
		// Alerte par mail l'utilisateur de sa création dans la base
		function mailAjout($id, $email, $nom, $prenom) {
			$mdp = stringGen(12);
			
			// On envoie le mail à l'utilisateur avec le mot de passe
			require_once(ROOT.'tools/swift-mailer/swift_required.php');
			$transport = Swift_MailTransport::newInstance();
			$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance('Création de votre compte')
				->setFrom(array(EMAIL_ADMIN => EMAIL_LABEL))
				->setTo(array($email => $prenom.' '.$nom))
				->setBody('Bonjour '.$prenom.' '.$nom.', <br /><br />Votre compte vient d\'être créé sur l\'application "Serveur de voeux" !<br />'.
						  'Votre compte : <strong>'.$email.'</strong><br />'.
						  'Votre mot de passe : <strong>'.$mdp.'</strong><br /><br />'.
						  'Vous pourrez modifier votre mot de passe dans la configuration de votre compte', 'text/html');
			$mailer->send($message);
			
			return $this->save(array(
				'id' => $id,
				'password' => md5(SECRET_KEY.$mdp)
			));
		}
	}
?>