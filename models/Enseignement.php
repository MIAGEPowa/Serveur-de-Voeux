<?php
	class Enseignement extends Model {

		var $table = 'enseignement';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		function getEnseignementLibelle($id_enseignement) {
		  $req = $this->find(array(
					'fields' => 'libelle',
					'conditions' => 'id = '.$id_enseignement
				));
		  
		  $libelle = $req[0]['libelle'];
		  
		  return $libelle;
		}
    
		function getEnseignement($id_enseignement) {
			return $this->find(array(
				'conditions' => 'id = '.$id_enseignement
			));
		}
		
		function getAll() {
			return $this->query('
				SELECT E.id as id_enseignement, libelle, description, U.civilite as auteur_civilite, U.nom as auteur_nom, U.prenom as auteur_prenom, etat
				FROM '.DB_PREFIX.'enseignement E, '.DB_PREFIX.'utilisateur U 
				WHERE E.auteur = U.id'
			);
		}
		
		function getEnseignementView($id) {
			return $this->query('
				SELECT E.id as id_enseignement, libelle, description, U.id as auteur_id, U.civilite as auteur_civilite, U.nom as auteur_nom, U.prenom as auteur_prenom, etat
				FROM '.DB_PREFIX.'enseignement E, '.DB_PREFIX.'utilisateur U 
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
			$this->deleteQuery("DELETE FROM ".DB_PREFIX."keyword WHERE id_enseignement=$id");
			// delete de l'enseignement
			$this->del($id);
		}
	}
?>