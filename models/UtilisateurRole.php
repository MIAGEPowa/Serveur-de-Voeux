<?php
	class UtilisateurRole extends Model {

		var $table = 'utilisateur_role';
	
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
	
		function getRoleUtilisateur($id_utilisateur) {
			return $this->find(array(
				'conditions' => 'id_utilisateur = '.$id_utilisateur,
				'order' => 'id_role ASC'
			));
		}
		
    function existRole($id_role) {
      return $this->find(array(
				'conditions' => 'id_role = '.$id_role,
        'order' => 'id_role ASC'
			));
    }
    
		function deleteRoleUtilisateur($id_utilisateur, $id_role, $id_filiere_enseignement) {
			if($id_filiere_enseignement)
				$this->deleteQuery('DELETE FROM '.DB_PREFIX.'utilisateur_role WHERE id_utilisateur = '.$id_utilisateur.' AND id_role = '.$id_role.' AND id_filiere_enseignement = '.$id_filiere_enseignement);
			else
				$this->deleteQuery('DELETE FROM '.DB_PREFIX.'utilisateur_role WHERE id_utilisateur = '.$id_utilisateur.' AND id_role = '.$id_role);
		}
	
		function checkRoleUtilisateur($id_utilisateur, $id_role, $id_filiere_enseignement) {
			if(!$id_filiere_enseignement) {
				return $this->find(array(
					'conditions' => 'id_utilisateur = '.$id_utilisateur.' AND id_role = '.$id_role,
					'order' => 'id_role ASC'
				));
			} else {
				return $this->find(array(
					'conditions' => 'id_utilisateur = '.$id_utilisateur.' AND id_role = '.$id_role.' AND id_filiere_enseignement = '.$id_filiere_enseignement,
					'order' => 'id_role ASC'
				));
			}
		}
	
		function addRoleUtilisateur($id_utilisateur, $id_role, $id_filiere_enseignement) {
			if(!$id_filiere_enseignement) {
				return $this->save(array(
					'id_utilisateur' => (int)($id_utilisateur),
					'id_role' => (int)($id_role),
					'id_filiere_enseignement' => 0			
				));
			} else {
				return $this->save(array(
					'id_utilisateur' => (int)($id_utilisateur),
					'id_role' => (int)($id_role),
					'id_filiere_enseignement' => (int)($id_filiere_enseignement)			
				));
			}
		}
		
		function getNumberUtilisateurRole($id_role) {
			return $this->find(array(
				'conditions' => 'id_role = '.$id_role,
				'order' => 'id_utilisateur ASC'
			));
		}
		
	}
?>