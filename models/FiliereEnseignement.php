<?php
	class FiliereEnseignement extends Model {

		var $table = 'filiere_enseignement';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
    function getAllFiliereEnseignement() {
      return $this->query('
				SELECT FE.id as id_filiere_enseignement, id_filiere, N.libelle as libelle_niveau, S.libelle as libelle_specialite, apprentissage, E.libelle as libelle_enseignement, annee
				FROM '.DB_PREFIX.'filiere_enseignement FE, '.DB_PREFIX.'filiere F, '.DB_PREFIX.'niveau N, '.DB_PREFIX.'specialite S, '.DB_PREFIX.'enseignement E
				WHERE FE.id_filiere = F.id
				AND F.id_niveau = N.id
				AND F.id_specialite = S.id
				AND FE.id_enseignement = E.id
				ORDER BY N.libelle, S.libelle, apprentissage ASC');
    }
    
		function getAllFiliere($id) {
			return $this->query('
				SELECT id_filiere, N.libelle as libelle_niveau, S.libelle as libelle_specialite, apprentissage
				FROM '.DB_PREFIX.'filiere_enseignement FE, '.DB_PREFIX.'filiere F, '.DB_PREFIX.'niveau N, '.DB_PREFIX.'specialite S
				WHERE FE.id_filiere = F.id
				AND F.id_niveau = N.id
				AND F.id_specialite = S.id
				AND FE.id_enseignement = '.$id.' 
				ORDER BY libelle_niveau ASC');
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
		
	}
?>