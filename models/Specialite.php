<?php
	class Specialite extends Model {

		var $table = 'smed_specialite';
		
		function getAll() {
			return $this->find(array(
				'order' => 'libelle ASC'
			));
		}
    
    function checkSpecialiteLibelle($libelle) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '"'
			));
		}
    
    function getSpecialite($id) {
			return $this->find(array(
				'conditions' => 'id='.$id
			));
		}
	}
?>