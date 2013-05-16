<?php
	class Specialite extends Model {

		var $table = 'smed_specialite';
		
		function getAll() {
			return $this->find(array(
				'order' => 'libelle ASC'
			));
		}
    
    function getSpeciality($id) {
			return $this->find(array(
				'conditions' => 'id='.$id
			));
		}
	}
?>