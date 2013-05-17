<?php
	class Enseignement extends Model {

		var $table = 'smed_enseignement';
		
    function getAll() {
      return $this->query('
				SELECT E.id as id_enseignement, libelle, description, U.nom as auteur_nom, U.prenom as auteur_prenom, etat
				FROM smed_enseignement E, smed_utilisateur U 
				WHERE E.auteur = U.id 
				'
			);
    }
    
		function deleteEnseignement($id=null) {
			// delete des keywords associés
			$this->deleteQuery("DELETE FROM smed_keyword WHERE id_enseignement=$id");
			// delete de l'enseignement
			$this->del($id);
		}
	}
?>