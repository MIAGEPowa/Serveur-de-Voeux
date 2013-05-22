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
    
    function getEnseignementView($id) {
      return $this->query('
				SELECT E.id as id_enseignement, libelle, description, U.id as auteur_id, U.nom as auteur_nom, U.prenom as auteur_prenom, etat
				FROM smed_enseignement E, smed_utilisateur U 
				WHERE E.auteur = U.id 
        AND E.id = '.$id
			);
    }
    
    function checkEnseignementLibelle($libelle) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '"'
			));
		}
    
		function deleteEnseignement($id=null) {
			// delete des keywords associés
			$this->deleteQuery("DELETE FROM smed_keyword WHERE id_enseignement=$id");
			// delete de l'enseignement
			$this->del($id);
		}
	}
?>