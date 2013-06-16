<?php
	class FiliereEnseignementController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('FiliereEnseignementEnseignant', 'FiliereEnseignement', 'Filiere', 'Enseignement', 
							'Specialite', 'Niveau', 'UtilisateurRole', 'Utilisateur', 'Configuration');
							
		function admin($id_filiere_enseignement = 0, $refFiltre = 0 /* filtre appelé à partir du tableau de bord (conflit de ref) */, $anneeFiltre = 0) {
			$d['v_titreHTML'] = 'Filières - Enseignements, administrer';
			$d['v_menuActive'] = 'filieresEnseignements';
			$this->v_JS = array('filiereEnseignement');
			$d['v_needRights'] = 3;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
			
				if ($id_filiere_enseignement != 0) {
					if (!$this->FiliereEnseignementEnseignant->find(array('conditions' => 'id_filiere_enseignement = "' . $id_filiere_enseignement . '"', 'order' => 'id_filiere_enseignement asc'))) {
						$this->FiliereEnseignement->del($id_filiere_enseignement);
						$d['v_success'] = 'Filière - Enseignements supprimée avec succès';
					} else {
						$d['v_errors'] = 'Oops ! La Filière - Enseignements ne peut pas être supprimée car elle est déjà associée à un voeu.';
					}
				}
			
				if($_POST['filiereEnseignement_form_add'] && $_SESSION['v_droits'] >= 3) {
					if(isset($_POST['dateDebut']) && !empty($_POST['dateDebut'])
						&& isset($_POST['enseignement']) && !empty($_POST['enseignement'])
						&& isset($_POST['filiere']) && !empty($_POST['filiere'])
						&& isset($_POST['annee']) && !empty($_POST['annee'])) {
						
						if(!empty($_POST['heuresCours']) || !empty($_POST['heuresTD']) || !empty($_POST['heuresTP'])) {
						
							// On vérifie si la filière-enseignement existe déjà en base
							$enseignement = $this->FiliereEnseignement->find(array('conditions' => 	'id_enseignement = '.$_POST["enseignement"].
																									' AND '.
																									'id_filiere ='.$_POST["filiere"]));
							if(count($enseignement) == 0) {
							
								// On convertit tout en minutes
								$t_minutes_cours = ($_POST['heuresCours'] * 60) + $_POST['minutesCours'];
								$t_minutes_TD = ($_POST['heuresTD'] * 60) + $_POST['minutesTD'];
								$t_minutes_TP = ($_POST['heuresTP'] * 60) + $_POST['minutesTP'];
								
								// Si l'utilisateur a saisit des heures pour cours, TD ou TP et pas de groupe, on met par défaut à 1
								if($t_minutes_cours != 0 && empty($_POST['groupesCours'])) {
									$_POST['groupesCours'] = 1;
								}
								
								if($t_minutes_TD != 0 && empty($_POST['groupesTD'])) {
									$_POST['groupesTD'] = 1;
								}
								
								if($t_minutes_TP != 0 && empty($_POST['groupesTP'])) {
									$_POST['groupesTP'] = 1;
								}
								
								// on enregistre l'association filiere-enseignement
								$dataFiliereEnseignement = array(	'id_enseignement' => $_POST['enseignement'],
																	'id_filiere' => $_POST['filiere'],
																	'annee' => $_POST['annee'],
																	'date_debut_enseignement' => dateNormalToBDD($_POST['dateDebut']),
																	'nbr_h_cours' => $t_minutes_cours,
																	'nbr_h_td' => $t_minutes_TD,
																	'nbr_h_tp' => $t_minutes_TP,
																	'nbr_groupes_cours' => $_POST['groupesCours'],
																	'nbr_groupes_td' => $_POST['groupesTD'],
																	'nbr_groupes_tp' => $_POST['groupesTP'],
																	'semestre' => $_POST['semestre'],
																	'nbr_etudiants_moyen' => $_POST['etudiantsMoyen'],
																	'moyenne' => $_POST['moyenne'],
																	'reference' => $_POST['reference']);
								$this->FiliereEnseignement->save($dataFiliereEnseignement);
								
								// on met l'enseignement dans l'état "en cours"
								$dataEnseignement = array(	'id' => $_POST['enseignement'],
															'etat' => 1);
								$this->Enseignement->save($dataEnseignement);
								
								$d['v_success'] = 'L\'association Filiere-Enseignement a bien été créée !';
							} else {
								$d['v_errors'] = 'Oops ! Cette association Filiere-Enseignement existe déjà !';
							}
							
						} else {
							$d['v_errors'] = 'Oops ! Il faut saisir au minimum un nombre d\'heures de cours, de TD ou de TP.';
						}					
							
					} else {
						$d['v_errors'] = 'Oops ! Il manque une ou plusieurs des informations suivantes : date début, enseignement, filière et année.';
					}
				}
				
				$d['arrayFilieres'] = $this->Filiere->find();
				$d['arrayEnseignements'] = $this->Enseignement->find();
				
				// Dans la liste des filières, on ajoute le nom de la spécialité, du niveau et de l'apprentissage
				for($i=0; $i<count($d['arrayFilieres']); $i++) {
					// Spécialité
					$specialite = $this->Specialite->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_specialite']));
					$d['arrayFilieres'][$i]['specialite'] = $specialite[0]['libelle'];
					// Niveau
					$niveau = $this->Niveau->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_niveau']));
					$d['arrayFilieres'][$i]['niveau'] = $niveau[0]['libelle'];
					// Apprentissage
					if($d['arrayFilieres'][$i]['apprentissage'] == 0) {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Initial';}
					else {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Apprentissage';}
				}
				
				$annee = $this->Configuration->find();
				$annee = $annee[0]['annee'];
				$d['arrayAnnees'] = array($annee-1,$annee,$annee+1);
				
				// Si filtre appelé à partir du tableau de bord (conflit de ref)
				if(!empty($refFiltre)) {
					$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find(array("conditions" => "reference = '".$refFiltre."'"));
				}else{
					if(empty($anneeFiltre)){
						$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find(array("conditions" => "annee = '".$annee."'"));
					}else if($anneeFiltre === 'tout'){
						$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find();
					}else{
						$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find(array("conditions" => "annee = '".$anneeFiltre."'"));
					}
				}
				// Permet de sélectionner l'année dans le select
				if(empty($anneeFiltre)){ 
					$d['selection'] = $annee; 
				}else if($anneeFiltre === 'tout'){ 
					$d['selection'] = 'tout'; 
				}else{ 
					$d['selection'] = $anneeFiltre; 
				}
				
				// Dans la liste des filières-enseignement, on ajoute le nom de la spécialité, du niveau et de l'apprentissage
				for($i=0; $i<count($d['arrayFiliereEnseignement']); $i++) {
					
					$filiere = $this->Filiere->find(array('conditions' => 'id = '.$d['arrayFiliereEnseignement'][$i]['id_filiere']));
					// Niveau
					$niveau = $this->Niveau->find(array('conditions' => 'id = '.$filiere[0]['id_niveau']));
					$niveau = $niveau[0]['libelle'];
					// Spécialité
					$specialite = $this->Specialite->find(array('conditions' => 'id = '.$filiere[0]['id_specialite']));
					$specialite = $specialite[0]['libelle'];
					// Apprentissage
					if($filiere[0]['apprentissage'] == 0) {$apprentissage = 'Initial';}
					else {$apprentissage = 'Apprentissage';}
					// Responsable
					$arrayResponsables = $this->UtilisateurRole->find(array('conditions' => 'id_filiere_enseignement = '.$d['arrayFiliereEnseignement'][$i]['id'],
																			'order' => 'id_filiere_enseignement'));
					if(count($arrayResponsables) != 0) {
						$d['arrayFiliereEnseignement'][$i]['responsable'] = array();
						$j = 0;
						foreach ($arrayResponsables as $responsable) {
							$responsable = $this->Utilisateur->find(array('conditions' => 'id = '.$responsable['id_utilisateur']));
							$civilite = ($responsable[0]['civilite'] == 0) ? "Mme" : "M";
							$d['arrayFiliereEnseignement'][$i]['responsable'][$j]['id'] = $responsable[0]['id'];
							$d['arrayFiliereEnseignement'][$i]['responsable'][$j]['libelle'] = $civilite.' '.$responsable[0]['prenom'].' '.$responsable[0]['nom'];
							$j++;
						}
					}
					// Filière
					$d['arrayFiliereEnseignement'][$i]['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;
					
					// Enseignement
					$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['arrayFiliereEnseignement'][$i]['id_enseignement']));
					$d['arrayFiliereEnseignement'][$i]['enseignement'] = $enseignement[0]['libelle'];
					
					// Conflits
					$d['arrayFiliereEnseignement'][$i]['conflits'] = $this->FiliereEnseignementEnseignant->getConflitsByFiliereEnseignement($d['arrayFiliereEnseignement'][$i]['id']);
				}
			
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
			
			$this->set($d);
			$this->render('admin');
		}

		function index($id_filiere_enseignement = 0, $refFiltre = 0 /* filtre appelé à partir du tableau de bord (conflit de ref) */) {
   
			// Titre
			$d['v_titreHTML'] = 'Filières - Enseignements';
			$d['v_menuActive'] = 'filieresEnseignements';
			$this->v_JS = array('filiereEnseignement');
			$d['v_needRights'] = 1;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				
				$d['arrayFilieres'] = $this->Filiere->find();
				$d['arrayEnseignements'] = $this->Enseignement->find();
				
				// Dans la liste des filières, on ajoute le nom de la spécialité, du niveau et de l'apprentissage
				for($i=0; $i<count($d['arrayFilieres']); $i++) {
					// Spécialité
					$specialite = $this->Specialite->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_specialite']));
					$d['arrayFilieres'][$i]['specialite'] = $specialite[0]['libelle'];
					// Niveau
					$niveau = $this->Niveau->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_niveau']));
					$d['arrayFilieres'][$i]['niveau'] = $niveau[0]['libelle'];
					// Apprentissage
					if($d['arrayFilieres'][$i]['apprentissage'] == 0) {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Initial';}
					else {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Apprentissage';}
				}
				
				$annee = $this->Configuration->find();
				$annee = $annee[0]['annee'];
				$d['arrayAnnees'] = array($annee-1,$annee,$annee+1);
				
				// Si filtre appelé à partir du tableau de bord (conflit de ref)
				if(!empty($refFiltre)) {
					$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find(array("conditions" => "reference = '".$refFiltre."'"));
				}else{
					if(empty($anneeFiltre)){
						$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find(array("conditions" => "annee = '".$annee."'"));
					}else if($anneeFiltre === 'tout'){
						$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find();
					}else{
						$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find(array("conditions" => "annee = '".$anneeFiltre."'"));
					}
				}
				// Permet de sélectionner l'année dans le select
				if(empty($anneeFiltre)){ 
					$d['selection'] = $annee; 
				}else if($anneeFiltre === 'tout'){ 
					$d['selection'] = 'tout'; 
				}else{ 
					$d['selection'] = $anneeFiltre; 
				}
				
				// Dans la liste des filières-enseignement, on ajoute le nom de la spécialité, du niveau et de l'apprentissage
				for($i=0; $i<count($d['arrayFiliereEnseignement']); $i++) {
					
					$filiere = $this->Filiere->find(array('conditions' => 'id = '.$d['arrayFiliereEnseignement'][$i]['id_filiere']));
					// Niveau
					$niveau = $this->Niveau->find(array('conditions' => 'id = '.$filiere[0]['id_niveau']));
					$niveau = $niveau[0]['libelle'];
					// Spécialité
					$specialite = $this->Specialite->find(array('conditions' => 'id = '.$filiere[0]['id_specialite']));
					$specialite = $specialite[0]['libelle'];
					// Apprentissage
					if($filiere[0]['apprentissage'] == 0) {$apprentissage = 'Initial';}
					else {$apprentissage = 'Apprentissage';}
					// Responsable
					$arrayResponsables = $this->UtilisateurRole->find(array('conditions' => 'id_filiere_enseignement = '.$d['arrayFiliereEnseignement'][$i]['id'],
																			'order' => 'id_filiere_enseignement'));
					if(count($arrayResponsables) != 0) {
						$d['arrayFiliereEnseignement'][$i]['responsable'] = array();
						$j = 0;
						foreach ($arrayResponsables as $responsable) {
							$responsable = $this->Utilisateur->find(array('conditions' => 'id = '.$responsable['id_utilisateur']));
							$civilite = ($responsable[0]['civilite'] == 0) ? "Mme" : "M";
							$d['arrayFiliereEnseignement'][$i]['responsable'][$j]['id'] = $responsable[0]['id'];
							$d['arrayFiliereEnseignement'][$i]['responsable'][$j]['libelle'] = $civilite.' '.$responsable[0]['prenom'].' '.$responsable[0]['nom'];
							$j++;
						}
					}
					// Filière
					$d['arrayFiliereEnseignement'][$i]['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;
					
					// Enseignement
					$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['arrayFiliereEnseignement'][$i]['id_enseignement']));
					$d['arrayFiliereEnseignement'][$i]['enseignement'] = $enseignement[0]['libelle'];
					
					// Conflits
					$d['arrayFiliereEnseignement'][$i]['conflits'] = $this->FiliereEnseignementEnseignant->getConflitsByFiliereEnseignement($d['arrayFiliereEnseignement'][$i]['id']);
				}
				
				$this->set($d);
				$this->render('index');
				
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}	
		}
		
		function update($id) {
			$d['v_titreHTML'] = 'Filières - Enseignements';
			$d['v_menuActive'] = 'filieresEnseignements';
			$this->v_JS = array('filiereEnseignementUpdate');
			$d['v_needRights'] = 3;

			if($_SESSION['v_droits'] >= $d['v_needRights']) {
				
				// Traitement du formulaire
				if($_POST['filiereEnseignement_form_update']) {
					if(isset($_POST['dateDebut']) && !empty($_POST['dateDebut'])) {
							
						if(!empty($_POST['heuresCours']) || !empty($_POST['heuresTD']) || !empty($_POST['heuresTP'])) {
						
							// On convertit tout en minutes
							$t_minutes_cours = ($_POST['heuresCours'] * 60) + $_POST['minutesCours'];
							$t_minutes_TD = ($_POST['heuresTD'] * 60) + $_POST['minutesTD'];
							$t_minutes_TP = ($_POST['heuresTP'] * 60) + $_POST['minutesTP'];
							
							// Si l'utilisateur a saisit des heures pour cours, TD ou TP et pas de groupe, on met par défaut à 1
							if($t_minutes_cours != 0 && empty($_POST['groupesCours'])) {
								$_POST['groupesCours'] = 1;
							}
							
							if($t_minutes_TD != 0 && empty($_POST['groupesTD'])) {
								$_POST['groupesTD'] = 1;
							}
							
							if($t_minutes_TP != 0 && empty($_POST['groupesTP'])) {
								$_POST['groupesTP'] = 1;
							}
						
							// on enregistre l'association filiere-enseignement
							$dataFiliereEnseignement = array(	'id' => $id,
																'id_filiere' => $_POST['filiere'],
																'date_debut_enseignement' => dateNormalToBDD($_POST['dateDebut']),
																'nbr_h_cours' => $t_minutes_cours,
																'nbr_h_td' => $t_minutes_TD,
																'nbr_h_tp' => $t_minutes_TP,
																'nbr_groupes_cours' => $_POST['groupesCours'],
																'nbr_groupes_td' => $_POST['groupesTD'],
																'nbr_groupes_tp' => $_POST['groupesTP'],
																'semestre' => $_POST['semestre'],
																'nbr_etudiants_moyen' => $_POST['etudiantsMoyen'],
																'moyenne' => $_POST['moyenne'],
																'reference' => $_POST['reference']);
							$this->FiliereEnseignement->save($dataFiliereEnseignement);
							
							$d['v_success'] = 'L\'association Filiere-Enseignement a bien été modifiée !';
						
						} else {
							$d['v_errors'] = 'Oops ! Il faut saisir au minimum un nombre d\'heures de cours, de TD ou de TP.';
						}					
							
					} else {
						$d['v_errors'] = 'Oops ! Il manque la date de début de l\'enseignement.';
					}
				}
				
				/*====== On récupère toutes les filières ======*/
				
				$d['arrayFilieres'] = $this->Filiere->find();
				$d['arrayEnseignements'] = $this->Enseignement->find();
				
				// Dans la liste des filières, on ajoute le nom de la spécialité, du niveau et de l'apprentissage
				for($i=0; $i<count($d['arrayFilieres']); $i++) {
					// Spécialité
					$specialite = $this->Specialite->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_specialite']));
					$d['arrayFilieres'][$i]['specialite'] = $specialite[0]['libelle'];
					// Niveau
					$niveau = $this->Niveau->find(array('conditions' => 'id = '.$d['arrayFilieres'][$i]['id_niveau']));
					$d['arrayFilieres'][$i]['niveau'] = $niveau[0]['libelle'];
					// Apprentissage
					if($d['arrayFilieres'][$i]['apprentissage'] == 0) {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Initial';}
					else {$d['arrayFilieres'][$i]['apprentissage_lib'] = 'Apprentissage';}
				}
				
				/*====== On sélectionne la filière-enseignement concernée ======*/
				
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
				if($filiere[0]['apprentissage'] == 0) {$apprentissage = 'Initial';}
				else {$apprentissage = 'Apprentissage';}
				// Filière
				$d['filiereEnseignement']['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;
				// Enseignement
				$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['filiereEnseignement']['id_enseignement']));
				$d['filiereEnseignement']['enseignement'] = $enseignement[0]['libelle'];
				
				// Date de début de l'enseignement
				$d['filiereEnseignement']['date_debut_enseignement'] = dateBDDToNormal($d['filiereEnseignement']['date_debut_enseignement']);
				
				// Heures Cours, TD et TP
				$d['filiereEnseignement']['h_cours'] = floor($d['filiereEnseignement']['nbr_h_cours'] / 60);
				$d['filiereEnseignement']['m_cours'] = $d['filiereEnseignement']['nbr_h_cours'] % 60;
				$d['filiereEnseignement']['h_td'] = floor($d['filiereEnseignement']['nbr_h_td'] / 60);
				$d['filiereEnseignement']['m_td'] = $d['filiereEnseignement']['nbr_h_td'] % 60;
				$d['filiereEnseignement']['h_tp'] = floor($d['filiereEnseignement']['nbr_h_tp'] / 60);
				$d['filiereEnseignement']['m_tp'] = $d['filiereEnseignement']['nbr_h_tp'] % 60;
				
				$this->set($d);
				$this->render('update');
				
			} else {
				// Rediriger l'utilisateur sur une page d'erreur
				redirection("notfound", "droits");
			}
		}
		
		function view($id) {
			$d['v_titreHTML'] = 'Filières - Enseignements';
			$d['v_menuActive'] = 'filieresEnseignements';
			$this->v_JS = array('filiereEnseignementView');
			
			// On traite le formulaire d'ajout de voeu
				if($_POST['filiereEnseignement_form_add_voeu']) {
					if($_SESSION['v_droits'] >= 2) {
					
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
					
					} else {
						// Rediriger l'utilisateur sur une page d'erreur
						redirection("notfound", "droits");
					}
				}
			
			/*====== On sélectionne la filière-enseignement concernée ======*/
			
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
			if($filiere[0]['apprentissage'] == 0) {$apprentissage = 'Initial';}
			else {$apprentissage = 'Apprentissage';}
			// Filière
			$d['filiereEnseignement']['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;
			
			// Enseignement
			$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['filiereEnseignement']['id_enseignement']));
			$d['filiereEnseignement']['enseignement'] = $enseignement[0]['libelle'];
			
			// Date de début de l'enseignement
			$d['filiereEnseignement']['date_debut_enseignement'] = dateBDDToNormal($d['filiereEnseignement']['date_debut_enseignement']);
			
			// Voeux
			$d['filiereEnseignementEnseignant'] = $this->FiliereEnseignementEnseignant->getAllByFiliereEnseignement($id);
			
			// Heures Cours, TD et TP
			$d['filiereEnseignement']['h_cours'] = floor($d['filiereEnseignement']['nbr_h_cours'] / 60);
			$d['filiereEnseignement']['m_cours'] = $d['filiereEnseignement']['nbr_h_cours'] % 60;
			$d['filiereEnseignement']['h_cours_d'] = round($d['filiereEnseignement']['nbr_h_cours'] / 60, 2);
			$d['filiereEnseignement']['h_td'] = floor($d['filiereEnseignement']['nbr_h_td'] / 60);
			$d['filiereEnseignement']['m_td'] = $d['filiereEnseignement']['nbr_h_td'] % 60;
			$d['filiereEnseignement']['h_td_d'] = round($d['filiereEnseignement']['nbr_h_td'] / 60, 2);
			$d['filiereEnseignement']['h_tp'] = floor($d['filiereEnseignement']['nbr_h_tp'] / 60);
			$d['filiereEnseignement']['m_tp'] = $d['filiereEnseignement']['nbr_h_tp'] % 60;
			$d['filiereEnseignement']['h_tp_d'] = round($d['filiereEnseignement']['nbr_h_tp'] / 60, 2);
							
			// Responsables
			$arrayResponsables = $this->UtilisateurRole->find(array('conditions' => 'id_filiere_enseignement = '.$id,
																	'order' => 'id_filiere_enseignement'));
			if(count($arrayResponsables) != 0) {
				$d['filiereEnseignement']['responsable'] = array();
				$i = 0;
				foreach ($arrayResponsables as $responsable) {
					$responsable = $this->Utilisateur->find(array('conditions' => 'id = '.$responsable['id_utilisateur']));

					$civilite = ($responsable[0]['civilite'] == 0) ? "Mme" : "M";
					$d['filiereEnseignement']['responsable'][$i]['id'] = $responsable[0]['id'];
					$d['filiereEnseignement']['responsable'][$i]['nom'] = $civilite.' '.$responsable[0]['prenom'].' '.$responsable[0]['nom'];
					$d['filiereEnseignement']['responsable'][$i]['email'] = $responsable[0]['email'];
					$i++;
				}
			}
			
			$this->set($d);
			$this->render('view');
		}
	}
?>