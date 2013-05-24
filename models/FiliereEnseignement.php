<?php
	class FiliereEnseignement extends Model {

		var $table = 'smed_filiere_enseignement';
		
		function getAllFiliere($id) {
			return $this->query('
				SELECT id_filiere, N.libelle as libelle_niveau, S.libelle as libelle_specialite, apprentissage
				FROM smed_filiere_enseignement FE, smed_filiere F, smed_niveau N, smed_specialite S
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