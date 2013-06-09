<?php
	class ConfigurationController extends Controller {

		// Déclaration du modèle rattaché au controlleur
		var $models = array('Configuration', 'FiliereEnseignement', 'Utilisateur', 'Enseignement');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Configuration';
			$d['v_menuActive'] = '';
			$d['v_needRights'] = 4;
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {	
							
				$this->v_JS = array('configuration');
				
				$d['anneeActuelle'] = $this->Configuration->find();
				$id = $d['anneeActuelle'][0]['id'];
				$d['anneeActuelle'] = $d['anneeActuelle'][0]['annee'];
				
				if($_POST['config_annee']) {
					
					// on passe en "abandonné" tous les enseignements en cours qui ne sont pas reliés à une filière
					$alias = 'e';
					$condition = 'etat = 1
								  AND e.id not in (	SELECT fe.id_enseignement
															FROM '.DB_PREFIX.'filiere_enseignement fe
															WHERE e.id = fe.id_enseignement)';
					$arrayEnseignements = $this->Enseignement->find(array(	'alias' => $alias,
																			'conditions' => $condition));
					foreach($arrayEnseignements as $enseignement) {
						$enseignement['etat'] = 2;
						$this->Enseignement->save($enseignement);
					}
					
					// On veut les filières enseignements de cette année mais qui n'existent pas pour l'année n+1
					// afin de les copier pour l'année n+1
					$alias = 'FE';
					$condition = 'annee = "'.$d['anneeActuelle'].
								 '" AND not exists ( SELECT * '.
													'FROM '.DB_PREFIX.'filiere_enseignement FE2 '.
													'WHERE FE2.id_filiere = FE.id_filiere AND FE2.id_enseignement = FE.id_enseignement AND FE2.annee = "'.($d['anneeActuelle']+1).'")';
					$arrayFilieresEnseignements = $this->FiliereEnseignement->find(array('alias' => $alias,
																						 'conditions' => $condition));
					foreach($arrayFilieresEnseignements as $fe) {
						$fe['id'] = '';
						$fe['annee'] = ($d['anneeActuelle']+1);
						$this->FiliereEnseignement->save($fe);
					}
					
					// On rend inactif les utilisateurs qui n'ont pas fait de voeu depuis plus de 3 ans 
					// ou qui n'en n'ont jamais fait
					$arrayUsersADesactiver = $this->Utilisateur->getUtilisateursADesactiver();
					foreach($arrayUsersADesactiver as $user) {
						$user['actif'] = 0;
						$this->Utilisateur->save($user);
					}
					
					// on passe à l'année n+1
					$dataAnnee = array( "id" => $id,
										"annee" => $d['anneeActuelle']+1 );
					$this->Configuration->save($dataAnnee);
					
					$d['v_success'] = "L'année a bien été modifiée !";
				}
				
				$d['anneeActuelle'] = $this->Configuration->find();
				$d['anneeActuelle'] = $d['anneeActuelle'][0]['annee'];
			
				$this->set($d);
				$this->render('index');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
	}
?>