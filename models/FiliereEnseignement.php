<?php
	class FiliereEnseignement extends Model {

		var $table = 'filiere_enseignement';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		function getAllFiliereEnseignement($otherCondition="") {
			return $this->query('
					SELECT FE.id_enseignement, FE.id as id_filiere_enseignement, id_filiere, N.libelle as libelle_niveau, S.libelle as libelle_specialite, apprentissage, E.libelle as libelle_enseignement, annee
					FROM '.DB_PREFIX.'filiere_enseignement FE, '.DB_PREFIX.'filiere F, '.DB_PREFIX.'niveau N, '.DB_PREFIX.'specialite S, '.DB_PREFIX.'enseignement E
					WHERE FE.id_filiere = F.id
					AND F.id_niveau = N.id
					AND F.id_specialite = S.id
					AND FE.id_enseignement = E.id '.
					$otherCondition.' 
					ORDER BY N.libelle, S.libelle, apprentissage ASC');
		}
    
		function getAllFiliere($id) {
			return $this->query('
				SELECT FE.id, id_filiere, N.libelle as libelle_niveau, S.libelle as libelle_specialite, apprentissage, annee
				FROM '.DB_PREFIX.'filiere_enseignement FE, '.DB_PREFIX.'filiere F, '.DB_PREFIX.'niveau N, '.DB_PREFIX.'specialite S
				WHERE FE.id_filiere = F.id
				AND F.id_niveau = N.id
				AND F.id_specialite = S.id
				AND FE.id_enseignement = '.$id.' 
				ORDER BY annee ASC');
		}
		
		function getFiliereEnseignementYear($year) {
			return $this->find(array(
				'conditions' => 'annee = '.$year,
				'order' => 'id_filiere ASC'
			));
		}
		
		function getFiliereEnseignement($id_filiere_enseignement) {
			return $this->find(array(
				'conditions' => 'id = '.$id_filiere_enseignement
			));
		}
		
		// Récupére les filières enseignements avec la même ref
		function getSameRef($year) {
			// On récupère toutes les références qui sont en doublons
			$arraySameRef = $this->find(array(
				'fields' => 'reference, COUNT( * )',
				'typeOrder' => 'GROUP',
				'order' => 'reference',
				'other' => 'HAVING COUNT( * ) > 1'
			));
			
			// Tableau qui sera sous la forme suivante :
			// $arrayFilieresEnseignement[ref1][0] = filiereEnseignement1 avec ref1
			// $arrayFilieresEnseignement[ref1][0] = filiereEnseignement2 avec ref1
			// $arrayFilieresEnseignement[ref2][0] = filiereEnseignement5 avec ref2
			// $arrayFilieresEnseignement[ref2][1] = filiereEnseignement6 avec ref2
			$arrayFilieresEnseignement = array();
			
			foreach($arraySameRef as $ref) {
				$condition = 'AND reference = "'.$ref['reference'].'" AND annee = "'.$year.'"';
				$res = $this->getAllFiliereEnseignement($condition);
				if(count($res) > 1)
					$arrayFilieresEnseignement[$ref['reference']] = $res;
			}
			
			return $arrayFilieresEnseignement;
		}
		
	}
?>