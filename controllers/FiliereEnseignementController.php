<?php
	class FiliereEnseignementController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('FiliereEnseignementEnseignant', 'FiliereEnseignement', 'Filiere', 'Enseignement', 'Specialite', 'Niveau');

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Filières - Enseignements';
			$d['v_menuActive'] = 'filieresEnseignements';
			$this->v_JS = array('filiereEnseignement');
			
			if($_POST['filiereEnseignement_form_add']) {
				if(isset($_POST['dateDebut']) && !empty($_POST['dateDebut'])
				&& isset($_POST['heuresCours']) && !empty($_POST['heuresCours'])
				&& isset($_POST['heuresTD']) && !empty($_POST['heuresTD'])
				&& isset($_POST['groupesCours']) && !empty($_POST['groupesCours'])
				&& isset($_POST['groupesTD']) && !empty($_POST['groupesTD'])) {
					
					// on vérifie si la filière-enseignement existe déjà en base
					$enseignement = $this->FiliereEnseignement->find(array('conditions' => 	'id_enseignement = '.$_POST["enseignement"].
																							' AND '.
																							'id_filiere ='.$_POST["filiere"]));
					if(count($enseignement) == 0) {
						// on enregistre l'association filiere-enseignement
						$dataFiliereEnseignement = array(	'id_enseignement' => $_POST['enseignement'],
															'id_filiere' => $_POST['filiere'],
															'annee' => $_POST['annee'],
															'date_debut_enseignement' => dateNormalToBDD($_POST['dateDebut']),
															'nbr_h_cours' => $_POST['heuresCours'],
															'nbr_h_td' => $_POST['heuresTD'],
															'nbr_groupes_cours' => $_POST['groupesCours'],
															'nbr_groupes_td' => $_POST['groupesTD'],
															'semestre' => $_POST['semestre'],
															'nbr_etudiants_moyen' => $_POST['etudiantsMoyen'],
															'moyenne' => $_POST['moyenne']);
						$this->FiliereEnseignement->save($dataFiliereEnseignement);
						
						$d['v_success'] = 'L\'association "Filiere-Enseignement" a bien été créée !';
					}
					else {
						$d['v_errors'] = 'Oops ! Cette association "Filiere-Enseignement" existe déjà !';
					}
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
			
			$d['arrayAnnees'] = array(date('Y')-1,date('Y'),date('Y')+1);
			$d['arrayFiliereEnseignement'] = $this->FiliereEnseignement->find();
			
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
				// Filière
				$d['arrayFiliereEnseignement'][$i]['filiere'] = $niveau.' '.$specialite.' '.$apprentissage;
				
				// Enseignement
				$enseignement = $this->Enseignement->find(array('conditions' => 'id = '.$d['arrayFiliereEnseignement'][$i]['id_enseignement']));
				$d['arrayFiliereEnseignement'][$i]['enseignement'] = $enseignement[0]['libelle'];
			}
			
			$this->set($d);
			$this->render('index');
		}
		
		function update($id) {
			$d['v_titreHTML'] = 'Filières - Enseignements';
			$d['v_menuActive'] = 'filieresEnseignements';
			$this->v_JS = array('filiereEnseignementUpdate');
			
			if($_POST['filiereEnseignement_form_update']) {
				if(isset($_POST['dateDebut']) && !empty($_POST['dateDebut'])
				&& isset($_POST['heuresCours']) && !empty($_POST['heuresCours'])
				&& isset($_POST['heuresTD']) && !empty($_POST['heuresTD'])
				&& isset($_POST['groupesCours']) && !empty($_POST['groupesCours'])
				&& isset($_POST['groupesTD']) && !empty($_POST['groupesTD'])) {
					// on enregistre l'association filiere-enseignement
					$dataFiliereEnseignement = array(	'id' => $id,
														'date_debut_enseignement' => dateNormalToBDD($_POST['dateDebut']),
														'nbr_h_cours' => $_POST['heuresCours'],
														'nbr_h_td' => $_POST['heuresTD'],
														'nbr_groupes_cours' => $_POST['groupesCours'],
														'nbr_groupes_td' => $_POST['groupesTD'],
														'semestre' => $_POST['semestre'],
														'nbr_etudiants_moyen' => $_POST['etudiantsMoyen'],
														'moyenne' => $_POST['moyenne']);
					$this->FiliereEnseignement->save($dataFiliereEnseignement);
					
					$d['v_success'] = 'L\'association "Filiere-Enseignement" a bien été modifiée !';
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
			
			$this->set($d);
			$this->render('update');
		}
		
		function view($id) {
			$d['v_titreHTML'] = 'Filières - Enseignements';
			$d['v_menuActive'] = 'filieresEnseignements';
			
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
			
      $d['filiereEnseignementEnseignant'] = $this->FiliereEnseignementEnseignant->getAllByFiliereEnseignement($id);
      
      $this->set($d);
			$this->render('view');
		}
	}
?>