<?php
	class TableaudebordController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Filiere', 'Enseignement', 'FiliereEnseignement', 'FiliereEnseignementEnseignant', 
							'Configuration', 'UtilisateurRole', 'Utilisateur', 'Role');
		
		// Variables pour les vues
		var $v_JS = array();

		function index() {
			// Titre
			$d['v_titreHTML'] = 'Tableau de bord';
			$d['v_menuActive'] = 'tableaudebord';
			
			// pour la secrétaire :
			// - on regarde les filières - enseignements qui ont la meme ref
			// - on affiche les conflits pour chaque filières - enseignements
			// if($_SESSION['v_droits'] == 1) {
			$annee = $this->Configuration->find();
			$annee = $annee[0]['annee'];
			
			$d['arrayFilieresEnseignementsSameRef'] = $this->FiliereEnseignement->getSameRef($annee);
        
			$arrayFiliereEnseignement = $this->FiliereEnseignement->find();
			for ($i = 0; $i < count($arrayFiliereEnseignement); $i++) {
				$conflits = $this->FiliereEnseignementEnseignant->getConflitsByFiliereEnseignement($arrayFiliereEnseignement[$i]['id']);
				if (count($conflits) > 0) {
					for ($j = 0; $j < count($conflits); $j++) {
						// Conflits
						$d['arrayConflits'][$i + $j] = $conflits[$j];    
						// Id
						$d['arrayConflits'][$i + $j]['id'] = $arrayFiliereEnseignement[$i]['id'];            
						// Filiere
						$d['arrayConflits'][$i + $j]['filiere'] = $this->Filiere->getFiliereName($arrayFiliereEnseignement[$i]['id_filiere']);
						// Enseignement
						$d['arrayConflits'][$i + $j]['enseignement'] = $this->Enseignement->getEnseignementLibelle($arrayFiliereEnseignement[$i]['id_enseignement']);
						// Cours / TD / TP /
						$d['arrayConflits'][$i + $j]['nbr_h_cours'] = $arrayFiliereEnseignement[$i]['nbr_h_cours'];
						$d['arrayConflits'][$i + $j]['nbr_h_td'] = $arrayFiliereEnseignement[$i]['nbr_h_td'];
						$d['arrayConflits'][$i + $j]['nbr_h_tp'] = $arrayFiliereEnseignement[$i]['nbr_h_tp'];
						$d['arrayConflits'][$i + $j]['nbr_groupes_cours'] = $arrayFiliereEnseignement[$i]['nbr_groupes_cours'];
						$d['arrayConflits'][$i + $j]['nbr_groupes_td'] = $arrayFiliereEnseignement[$i]['nbr_groupes_td'];
						$d['arrayConflits'][$i + $j]['nbr_groupes_tp'] = $arrayFiliereEnseignement[$i]['nbr_groupes_tp'];
					}
				}
			}

			$d['arrayFilieres'] = $this->Filiere->find();
			foreach($d['arrayFilieres'] as $keyF => $f) {
				$d['arrayFilieres'][$keyF]['name'] = $this->Filiere->getFiliereName($f['id']);
				$d['arrayFilieres'][$keyF]['responsable'] = $this->UtilisateurRole->getFiliereResponsable($f['id']);
				$d['arrayFilieres'][$keyF]['secretaire'] = $this->UtilisateurRole->getFiliereSecretaire($f['id']);
			}	
			
			$d['utilisateur'] = $this->Utilisateur->getUtilisateur($_SESSION['v_id_utilisateur']);
			$d['utilisateur'] = $d['utilisateur'][0];
      
			$d['roles_utilisateur'] = $this->UtilisateurRole->getRoleUtilisateur($_SESSION['v_id_utilisateur']);

			for($i=0; $i<count($d['roles_utilisateur']); $i++) {
				$role = $this->Role->find(array('conditions' => 'id = '.$d['roles_utilisateur'][$i]['id_role'], 'order' => 'id'));
				$d['roles_utilisateur'][$i]['libelle'] = $role[0]['libelle'];
				if($role[0]['droits'] == 2) {
					$d['coeff_cours'] = $role[0]['coeff_cours'];
					$d['coeff_tp'] = $role[0]['coeff_tp'];
					$d['quota_h'] = $role[0]['quota_h'];
				}				
			}
      
			$d['arrayVoeux'] = $this->FiliereEnseignementEnseignant->getAllByUser($_SESSION['v_id_utilisateur']);
			
			$total = 0;
			foreach($d['arrayVoeux'] as $voeu) {
				$d['heuresEffectuees'] += round($voeu['fee_nbr_h_cours'] / 60, 2) * $d['coeff_cours'];
				$d['heuresEffectuees'] += round($voeu['fee_nbr_h_tp'] / 60, 2) * $d['coeff_tp'];
				$d['heuresEffectuees'] += round($voeu['fee_nbr_h_td'] / 60, 2);
			}
			$d['total'] = $d['heuresEffectuees'] + $d['utilisateur']['nbr_h_delegation'];
			
			$this->set($d);
			$this->render('index');
		}

	}
?>