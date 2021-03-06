<?php
	class VoeuController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('FiliereEnseignementEnseignant', 'FiliereEnseignement', 'Filiere', 'Niveau', 'Specialite', 'Enseignement');

		function index($id_filiere_enseignement = 0) {
			// Titre
			$d['v_titreHTML'] = 'Voeux';
			$d['v_menuActive'] = 'voeux';
			$this->v_JS = array('voeuIndex');
			$d['v_needRights'] = 2;
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				
				// DELETE
				if ($id_filiere_enseignement != 0) {
					$this->FiliereEnseignementEnseignant->delete($id_filiere_enseignement, $_SESSION['v_id_utilisateur']);
					$d['v_success'] = 'Le voeu a bien été supprimé.';
				}
			
				if($_POST['filiereEnseignement_form_add_voeu']) {

					$id = $_POST['filiereEnseignement'];
					$cours_h_voeu = ($_POST['heuresCours'] * 60) + $_POST['minutesCours'];
					$td_h_voeu = ($_POST['heuresTD'] * 60) + $_POST['minutesTD'];
					$tp_h_voeu = ($_POST['heuresTP'] * 60) + $_POST['minutesTP'];
					
					$dataVoeu = array('id_filiere_enseignement' => $id,
									  'id_utilisateur' => $_SESSION['v_id_utilisateur'],
									  'nbr_h_cours' => $cours_h_voeu,
									  'nbr_h_td' => $td_h_voeu,
									  'nbr_h_tp' => $tp_h_voeu);
					
					$checkVoeu = $this->FiliereEnseignementEnseignant->getFiliereEnseignementEnseignant($id, $_SESSION['v_id_utilisateur']);
					if (!$checkVoeu) {
						// On ajoute le voeu
						if(!empty($_POST['heuresCours']) || !empty($_POST['heuresTD']) || !empty($_POST['heuresTP']) || !empty($_POST['minutesCours']) || !empty($_POST['minutesTD']) || !empty($_POST['minutesTP'])) {
							$this->FiliereEnseignementEnseignant->save($dataVoeu);
							$d['v_success'] = 'Le voeu a bien été ajouté !';
						} else {
							$d['v_errors'] = 'Oops ! Il faut saisir au minimum un nombre d\'heures de cours, de TD ou de TP.';
						}
					} else {
						if(empty($_POST['heuresCours']) && empty($_POST['heuresTD']) && empty($_POST['heuresTP']) && empty($_POST['minutesCours']) && empty($_POST['minutesTD']) && empty($_POST['minutesTP'])) {
							// On supprime le voeu si tout a 0
							$this->FiliereEnseignementEnseignant->delete($id, $_SESSION['v_id_utilisateur']);
							$d['v_success'] = 'Le voeu a bien été supprimé !';
						} else {
							// On modifie le voeu
							$this->FiliereEnseignementEnseignant->update($dataVoeu, 'id_filiere_enseignement', 'id_utilisateur');
							$d['v_success'] = 'Le voeu a bien été modifié !';
						}
					}
				}
			
				$d['fee'] = $this->FiliereEnseignementEnseignant->getFiliereEnseignementByEnseignant($_SESSION['v_id_utilisateur']);
				foreach($d['fee'] as $key => $fee) {
					$d['fee'][$key]['filiere'] = $this->Filiere->getFiliereName($d['fee'][$key]['id_filiere']);
					$d['fee'][$key]['conflits'] = $this->FiliereEnseignementEnseignant->getConflitsByFiliereEnseignement($d['fee'][$key]['id_filiere_enseignement']);
				} 
				
				$arrayFilieresEnseignementsTemp = $this->FiliereEnseignement->getAllFiliereEnseignement();
				$d['arrayFilieresEnseignements'] = array();
				
				$i = 0;
				foreach($arrayFilieresEnseignementsTemp as $fe) {
					$apprentissage = (!$fe['apprentissage']) ? 'initial' : 'apprentissage';
					$d['arrayFilieresEnseignements'][$i]['libelle'] = 	$fe['libelle_niveau'].' '.
																		$fe['libelle_specialite'].' '.
																		$apprentissage.' - '.
																		$fe['libelle_enseignement'].' ';
					$d['arrayFilieresEnseignements'][$i]['id'] = $fe['id_filiere_enseignement'];
					$i++;
				}
				
				$this->set($d);
				$this->render('index');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
			
		}	
	
		function update($id) {
		
			$d['v_titreHTML'] = 'Voeux';
			$d['v_menuActive'] = 'voeux';
			$this->v_JS = array('voeu');
			$d['v_needRights'] = 2;
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {

				if($_POST['voeu_form_update']) {
					if (isset($_POST['heuresCours']) && !empty($_POST['heuresCours'])
					&& isset($_POST['heuresTD']) && !empty($_POST['heuresTD'])) {

						$checkVoeu = $this->FiliereEnseignementEnseignant->getFiliereEnseignementEnseignant($id, $_SESSION['v_id_utilisateur']);

						$dataVoeu = array('id_filiere_enseignement' => $id,
										'id_utilisateur' => $_SESSION['v_id_utilisateur'],
										'nbr_h_cours' => $_POST['heuresCours'],
										'nbr_h_td' => $_POST['heuresTD']);
										  
						if (!$checkVoeu) { // Le voeu n'existe pas encore dans la DB
							// on enregistre le voeu
							if (($_POST['heuresCours'] != 0) && ($_POST['heuresTD'] != 0))
							  $this->FiliereEnseignementEnseignant->save($dataVoeu);
						} else {
							$this->FiliereEnseignementEnseignant->update($dataVoeu, 'id_filiere_enseignement', 'id_utilisateur');
						}

						$d['v_success'] = 'Le voeu a bien été modifié !';
					}
				}

				$d['filiereEnseignement'] = $this->FiliereEnseignement->find(array('conditions' => 'id = '.$id));
				$d['filiereEnseignement'] = $d['filiereEnseignement'][0];

				$filiere = $this->Filiere->find(array('conditions' => 'id = '.$d['filiereEnseignement']['id_filiere']));
				// Niveau
				$niveau = $this->Niveau->find(array('conditions' => 'id = '.$filiere[0]['id_niveau']));
				$niveau = $niveau[0]['libelle'];
				// Spécialité
				$specialite = $this->Specialite->find(array('conditions' => 'id = '.$filiere[0]['id_specialite']));
				$specialite = $specialite[0]['libelle'];
				// Apprentissage
				if($d['filiereEnseignement']['apprentissage'] == 0) {$apprentissage = 'Initial';}
				else {$apprentissage = 'Apprentissage';}
				// Filière
				$d['filiereEnseignement']['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;

				// Enseignement
				$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['filiereEnseignement']['id_enseignement']));
				$d['filiereEnseignement']['enseignement'] = $enseignement[0]['libelle'];

				$d['filiereEnseignement']['date_debut_enseignement'] = dateBDDToNormal($d['filiereEnseignement']['date_debut_enseignement']);

				$d['filiereEnseignement']['voeu'] = $this->FiliereEnseignementEnseignant->getFiliereEnseignementEnseignant($id, $_SESSION['v_id_utilisateur']);

				if (!$d['filiereEnseignement']['voeu']) {
					$d['filiereEnseignement']['nb_heures_cours'] = 0;
					$d['filiereEnseignement']['nb_heures_td'] = 0;
				} else {
					$d['filiereEnseignement']['nb_heures_cours'] = $d['filiereEnseignement']['voeu'][0]['nbr_h_cours'];
					$d['filiereEnseignement']['nb_heures_td'] = $d['filiereEnseignement']['voeu'][0]['nbr_h_td'];
				}
				
				$this->set($d);
				$this->render('update');
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
    
		function delete($id) {
			$d['v_needRights'] = 2;
			
			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				$this->FiliereEnseignementEnseignant->delete($id, $_SESSION['v_id_utilisateur']);
				redirection("voeu", "index");
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
	}
?>