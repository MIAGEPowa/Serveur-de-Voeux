<?php
	class Role extends Model {

		var $table = 'smed_role';
		
		function getRoles() {
			return $this->find(array(
				'order' => 'droits DESC'
			));
		}
		
		function checkRoleLibelle($libelle) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '"'
			));
		}
		
		function checkRoleResponsable($id_filiere, $id_diplome, $adjoint) {
			if($id_filiere) {
				return $this->find(array(
					'conditions' => 'id_filiere = '.$id_filiere.' AND adjoint = '.$adjoint
				));
			} else {
				return $this->find(array(
					'conditions' => 'id_diplome = '.$id_diplome.' AND adjoint = '.$adjoint
				));
			}
		}
		
		function addRole($libelle, $adjoint, $role_enseignant, $quota_h, $droits, $id_filiere, $id_diplome) {
			return $this->save(array(
				'libelle' => $libelle,
				'adjoint' => (int)($adjoint),
				'role_enseignant' => (int)($role_enseignant),
				'quota_h' => (int)($quota_h),
				'droits' => (int)($droits),
				'id_filiere' => (int)($id_filiere),
				'id_diplome' => (int)($id_diplome)				
			));
		}
		
	}
?>