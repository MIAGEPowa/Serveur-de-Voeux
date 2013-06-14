<?php
	class Role extends Model {

		var $table = 'role';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
		function getRoles() {
			return $this->find(array(
				'order' => 'droits DESC'
			));
		}
		
		function getRoleLibelle($id_role) {
			return $this->find(array(
				'conditions' => 'id = '.$id_role
			));
		}
		
		function checkRoleLibelle($libelle) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '"'
			));
		}
		
		function checkRoleLibelleId($libelle, $id) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '" AND id != ' . $id
			));
		}
		
		function checkRoleSecretaire($id_filiere) {
			return $this->find(array(
				'conditions' => 'id_filiere = '.$id_filiere.' AND droits = 1'
			));
		}
		
		function checkRoleResponsable($id_filiere, $id_diplome, $adjoint) {
			if($id_filiere) {
				return $this->find(array(
					'conditions' => 'id_filiere = '.$id_filiere.' AND adjoint = '.$adjoint.' AND droits = 3'
				));
			} else {
				return $this->find(array(
					'conditions' => 'id_diplome = '.$id_diplome.' AND adjoint = '.$adjoint.' AND droits = 3'
				));
			}
		}
		
		function addRole($libelle, $adjoint, $role_enseignant, $quota_h, $droits, $id_filiere, $id_diplome, $coeff_cours = 0, $coeff_tp = 0) {
			return $this->save(array(
				'libelle' => $libelle,
				'adjoint' => (int)($adjoint),
				'role_enseignant' => (int)($role_enseignant),
				'quota_h' => (int)($quota_h),
				'droits' => (int)($droits),
				'id_filiere' => (int)($id_filiere),
				'id_diplome' => (int)($id_diplome),
				'coeff_cours' => $coeff_cours,
				'coeff_tp' => $coeff_tp
			));
		}
		
	}
?>