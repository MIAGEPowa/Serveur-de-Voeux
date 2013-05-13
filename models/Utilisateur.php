<?php
	class Utilisateur extends Model {

		var $table = 'smed_utilisateur';
		
		// Teste la connexion avec le couple email/password
		function connexion($email, $password) {
			return $this->find(array(
				'conditions' => 'email = "' . $email . '" AND password = "' . md5(SECRET_KEY.$password) . '" AND actif = 1'
			));
		}
		
		// Retourne tous les utilisateurs actif
		function getUtilisateurs() {
			return $this->find(array(
				'conditions' => 'actif = 1'
			));
		}
		
		// Retourne l'utilisateur de l'id passé en param
		function getUtilisateur($id) {
			return $this->find(array(
				'conditions' => 'id = ' . $id
			));
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
	}
?>