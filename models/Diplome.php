<?php
	class Diplome extends Model {

		var $table = 'smed_diplome';
		
		function getAll() {
			return $this->find(array(
				'order' => 'libelle ASC'
			));
		}
    
    function checkDiplomeLibelle($libelle) {
			return $this->find(array(
				'conditions' => 'libelle = "' . $libelle . '"'
			));
		}
    
		function getDiplome($id) {
			return $this->find(array(
				'conditions' => 'id='.$id
			));
		}
	}
?>