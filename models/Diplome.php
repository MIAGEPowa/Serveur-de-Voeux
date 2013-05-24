<?php
	class Diplome extends Model {

		var $table = 'diplome';
		
		function __construct() {
			$this->table = DB_PREFIX.$this->table;
		}
		
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