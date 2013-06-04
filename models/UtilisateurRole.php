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
		
		function getFiliereResponsable($id_filiere) {
			return $this->query('
				SELECT U.id as id_utilisateur, civilite, nom, prenom, adjoint, droits
				FROM '.DB_PREFIX.'utilisateur_role UR, '.DB_PREFIX.'role R, '.DB_PREFIX.'utilisateur U 
				WHERE UR.id_role = R.id
				AND UR.id_utilisateur = U.id
				AND R.id_filiere = '.$id_filiere.' 
				AND R.droits > 2 
				ORDER BY R.adjoint ASC '
			);
		}
		
		function getFiliereSecretaire($id_filiere) {
			return $this->query('
				SELECT U.id as id_utilisateur, civilite, nom, prenom, adjoint, droits
				FROM '.DB_PREFIX.'utilisateur_role UR, '.DB_PREFIX.'role R, '.DB_PREFIX.'utilisateur U 
				WHERE UR.id_role = R.id
				AND UR.id_utilisateur = U.id
				AND R.id_filiere = '.$id_filiere.' 
				AND R.droits = 1'
			);
		}
	}
?>