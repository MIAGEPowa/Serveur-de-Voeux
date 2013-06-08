<?php
	class TableaudebordController extends Controller {
	
		// Déclaration du modèle rattaché au controlleur
		var $models = array('Filiere', 'Enseignement', 'FiliereEnseignement', 'FiliereEnseignementEnseignant', 'Configuration', 'UtilisateurRole');
		
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
			// }
			
			$this->set($d);
			$this->render('index');
		}

	}
?>